<?php

class SupplierManager extends DBManager{
    public function __construct() {
        parent::__construct();
        $this->columns = ['id','name','website'];
        $this->tableName = 'supplier';
    }
}
?>