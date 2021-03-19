<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once dirname(__FILE__)."/BaseDao.class.php";

class DoctorsDao extends BaseDao{

  public function __construct(){
    parent::__construct("doctors");
  }

function get_doctor_by_name($name){

  return $this->query_unique("SELECT * FROM doctors WHERE Name=:Name", ["Name"=>$name]);

}

function get_doctors_by_institution($institution){
  return $this->query_unique("SELECT * FROM doctors WHERE InstitutionName=:InstitutionName", ["InstitutionName"=>$institution]);
}


}

 ?>
