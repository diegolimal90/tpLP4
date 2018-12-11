<?php
namespace api\login;

use lib\Model;
use object\login\Login;

class ApiLogin extends Model{
    
    public function get(Login $obj){
        $query = $this->select("SELECT * FROM users WHERE user = '{$obj->user}' AND password = '{$obj->password}'");
        return $this->setObject($obj, $query);
    }

    public function logout(Login $obj){
        
    }
}