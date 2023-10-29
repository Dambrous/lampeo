<?php

class CategoryManager extends DBManager{
    public function __construct() {
        parent::__construct();
        $this->columns = ['id','name'];
        $this->tableName = 'category';
    }

}
?>