<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once dirname(__FILE__)."/BaseDao.class.php";

class DoctorsDao extends BaseDao{

  public function __construct(){
    parent::__construct("doctors");
  }

  public function get_doctor_by_AID ($id){

      return $this->query_unique("SELECT * FROM doctors WHERE Account_ID=:Account_ID", ["Account_ID"=>$id]);
    }



}

 ?>
