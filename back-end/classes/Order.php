<?php

class Order
{

    public $id;
    public $utente_id;
    public $date_order;
    public $shipping_address;
    public $country;
    public $province;
    public $city;
    public $zip;


    public function __construct($id, $utente_id, $date_order, $shipping_address, $country, $province, $city, $zip)
    {
        $this->id = (int) $id;
        $this->utente_id = $utente_id;
        $this->date_order = $date_order;
        $this->shipping_address = $shipping_address;
        $this->country = $country;
        $this->province = $province;
        $this->city = $city;
        $this->zip = $zip;
    }
}

class OrderManager extends DBManager
{

    public function __construct()
    {
        parent::__construct();
        $this->columns = ['id', 'user_id', 'date_order', 'shipping_address', 'country', 'province', 'city', 'zip'];
        $this->tableName = 'sale_order';
    }

    public function get_last_order($userId) {
        $sale_order = $this->db->query("SELECT * FROM sale_order WHERE user_id = $userId ORDER BY id DESC LIMIT 1");
        return $sale_order[0]['id'];
    }

    public function get_orders($userId){
        $results = $this->db->query("SELECT * FROM sale_order WHERE user_id = $userId");
        $objects = array();
        foreach($results as $result) {
          array_push($objects, (object)$result);
        }
        return $objects;
    }
}

class OrderItemManager extends DBManager{

    public function __construct()
    {
        parent::__construct();
        $this->columns = ['id', 'order_id', 'product_id', 'quantity'];
        $this->tableName = 'order_item';
    }

    public function get_orders_item($order_id){
        $results = $this->db->query("SELECT * FROM order_item WHERE order_id = $order_id");
        $objects = array();
        foreach($results as $result) {
          array_push($objects, (object)$result);
        }
        return $objects;
    }

}
?>