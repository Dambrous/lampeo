<?php

class CartManager extends DBManager
{

    private $client_id;
    public function __construct()
    {
        parent::__construct();
        $this->columns = ['id', 'client_id'];
        $this->tableName = 'cart';

        $this->_inizializeclientsession();
    }

    public function add_to_cart($product_id, $cart_id)
    {
        $quantity = 0;
        $result = $this->db->query("SELECT quantity FROM cart_item WHERE cart_id = $cart_id and product_id = $product_id");
        if (count($result) > 0) {
            $quantity = $result[0]['quantity'];
            $quantity++;
            $result = $this->db->query("UPDATE cart_item SET quantity = $quantity WHERE cart_id = $cart_id and product_id = $product_id ");
        } else {
            $cartItemMgr = new CartItemManager();
            $newcartitem = $cartItemMgr->create([
                'cart_id' => $cart_id,
                'product_id' => $product_id,
                'quantity' => 1,
            ]);
        }

    }
    public function decrement_one($product_id, $cart_id, $quantityInCart)
    {
        $quantityInCart--;
        $this->db->query("UPDATE cart_item SET quantity = $quantityInCart WHERE cart_id = '$cart_id' AND product_id = '$product_id'");
    }

    public function remove_item($product_id, $cart_id)
    {
        return $this->db->query("DELETE FROM cart_item WHERE cart_id = '$cart_id' AND product_id = '$product_id'");
    }

    public function remove_from_cart($product_id, $cart_id)
    {
        $quantityInCart = $this->db->query("SELECT quantity FROM cart_item WHERE cart_id = $cart_id and product_id = $product_id");

        if ($quantityInCart > 1) {
            $this->decrement_one($product_id, $cart_id, $quantityInCart);
        } else {
            $this->remove_item($product_id, $cart_id);
        }
    }

    public function update_quantity($cartitemid, $operand)
    {
        $this->db->query("UPDATE cart_item SET quantity = quantity $operand 1 WHERE id = $cartitemid");
        $result = $this->db->query("SELECT quantity FROM cart_item WHERE id = $cartitemid");
        if ($result[0]['quantity'] == 0) {
            $this->db->query("DELETE FROM cart_item WHERE id = $cartitemid");
        }
    }

    public function get_current_cart_id()
    {
        $cart_id = 0;
        if (assert($this->client_id)) {
            $result = $this->db->query("SELECT * FROM cart WHERE client_id = '$this->client_id'");
        }
        if (count($result) > 0) {
            $cart_id = $result[0]['id'];
        } else {
            $cart_id = $this->create(['client_id' => $this->client_id]);
        }

        return $cart_id;
    }
    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }
    public function _inizializeclientsession()
    {
        //leggere la sessione e se esiste la variabile client_id nella sessione allora questa
        // conterrà il valore di client_id
        if (isset($_SESSION['client_id'])) {
            $this->client_id = ($_SESSION['client_id']);
        } else {
            //generare una stringa casuale e settare client_id con questa stringa
            $str = $this->generateRandomString();
            $_SESSION['client_id'] = $str;
            $this->client_id = $str;
        }
    }

    public function get_cart_total($cart_id)
    {
        return $this->db->query("SELECT * FROM cart WHERE id = $cart_id");
    }

    public function get_cart_items($cart_id)
    {
        return $this->db->query("SELECT * FROM cart_item WHERE cart_id = $cart_id");
    }

    public function delete_cart($cart_id) {
        $this->db->query("DELETE FROM cart_item WHERE cart_id = $cart_id");
    }
}

class CartItemManager extends DBManager {
    public function __construct()
    {
        parent::__construct();
        $this->columns = ['id', 'cart_id', 'product_id', 'quantity'];
        $this->tableName = 'cart_item';
    }
}
?>