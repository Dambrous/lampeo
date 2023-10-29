<?php

class CountryManager extends DBManager {
    public function __construct()
    {
        parent::__construct();
        $this->columns = ['id', 'name', 'code'];
        $this->tableName = 'res_country';
    }
}
?>
