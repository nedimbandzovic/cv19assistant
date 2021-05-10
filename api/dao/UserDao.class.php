<?php
header('Content-Type: application/json');

require_once dirname(__FILE__)."/BaseDao.class.php";
class UserDao extends BaseDao{
public function __construct(){
    parent::__construct("users");
}


public function get_user_by_token ($token){

  return $this->query_unique("SELECT * FROM users WHERE token=:token", ["token"=>$token]);
}

public function get_user_by_email($email){
   return $this->query_unique("SELECT * FROM users WHERE Email = :Email", ["Email" => $email]);
 }
}

 ?>
