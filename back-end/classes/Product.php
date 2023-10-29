<?php

class Product
{

  public $id;
  public $name;
  public $price;
  public $description;
  public $supplier_id;
  public $category_id;
  public $image;

  public function __construct($id, $name, $price, $description, $supplier_id, $category_id, $image)
  {
    $this->id = (int) $id;
    $this->name = $name;
    $this->price = (float) $price;
    $this->description = $description;
    $this->supplier_id = (int) $supplier_id;
    $this->category_id = (int) $category_id;
    $this->image = $image;
  }
}

class ProductManager extends DBManager
{

  public function __construct()
  {
    parent::__construct();
    $this->columns = ['id', 'name', 'price', 'description', 'supplier_id', 'category_id', 'image'];
    $this->tableName = 'product';
  }

  public function get_product_like_search($string_search)
  {
    $products = $this->db->query("SELECT * FROM product WHERE name like '%$string_search%'");
    $objects = array();
    foreach($products as $product) {
      array_push($objects, (object)$product);
    }
    return $objects;
  }
}

class ProductTypeManager extends DBManager
{

  public function __construct()
  {
    parent::__construct();
    $this->columns = ['id', 'name'];
    $this->tableName = 'product_type';
  }
}
?>