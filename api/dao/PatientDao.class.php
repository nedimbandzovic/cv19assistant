<?php

require_once dirname(__FILE__)."/BaseDao.class.php";
class PatientDao extends BaseDao{
public function __construct(){
  parent::__construct("patients");
}

public function get_user_by_phonenumber ($num){

    return $this->query_unique("SELECT * FROM patients WHERE PhoneNumber=:PhoneNumber", ["PhoneNumber"=>$num]);
  }
}




 ?>
