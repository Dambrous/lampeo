<?php

class UserManager extends DBManager{
    public function __construct() {
        parent::__construct();
        $this->columns = ['id','name','surname','email','password','user_type_id','created_at'];
        $this->tableName = 'res_user';
    }

    public function login($email, $password) {
        $result = $this->db->query("SELECT * 
        from res_user 
        WHERE email = '$email' 
        AND password = '$password'");
        if (count($result) > 0) {
            $this->_set_user($result);
            return true;
        }
        return false;
        }
    private function _set_user($result) {
        $user = (object) $result[0];
        $user = (object) [
            'id' => $user->id,
            'email' => $user->email,
            'name' => $user->name,
            'surname' => $user->surname,
            'is_admin' => $user->user_type_id == 2,
            'created_at' => $user->created_at,
            ];
        $_SESSION['user'] = $user;
    }

    public function check_user_exists_by_email($email) {
        $result = $this->db->query("SELECT * from res_user WHERE email = '$email'");
        if (count($result) > 0) {
            return true;
        }
        return false;
    }
}
?>