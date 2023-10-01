<?php

class ProvinceManager extends DBManager {
    public function __construct()
    {
        parent::__construct();
        $this->columns = ['id', 'name', 'code', 'country_id'];
        $this->tableName = 'res_province';
    }

    public function get_all_province_of_specific_country($country_id) {
        $province_ids = $this->db->query("SELECT * FROM res_province WHERE country_id = $country_id");
        $objects = array();
        foreach($province_ids as $province_id) {
        array_push($objects, (object)$province_id);
        }
        return $objects;
    }
}
?>