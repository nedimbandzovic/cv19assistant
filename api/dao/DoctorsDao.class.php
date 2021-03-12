<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once dirname(__FILE__)."/BaseDao.class.php";

class DoctorsDao extends BaseDao{

function get_doctor_by_name($name){

  return $this->query_unique("SELECT * FROM doctors WHERE Name=:Name", ["Name"=>$name]);

}

function  get_doctor_by_ID($id){
  return $this->query_unique("SELECT * FROM doctors WHERE DoctorID=:DoctorID", ["DoctorID"=>$id]);
}

function add_doctor($user){

  $insert= "";
  $sql = "INSERT INTO doctors (Name, Surname, InstitutionName, PhoneNumber, Address, JMBG, InstitutionPosition, PatientEnrollmentDate, Account_ID) VALUES (:Name, :Surname, :InstitutionName, :PhoneNumber, :Address, :JMBG, :InstitutionPosition, :PatientEnrollmentDate, :Account_ID)";
  $stmt= $this->connection->prepare($sql);
  $stmt->execute($user);


}

function update_doctor ($id, $user){
  $insert= "";
  $sql = "UPDATE doctors SET Name=:Name, Surname=:Surname,InstitutionName=:InstitutionName, PhoneNumber=:PhoneNumber, Address=:Address, JMBG=:JMBG, InstitutionPosition=:InstitutionPosition, PatientEnrollmentDate=:PatientEnrollmentDate, Account_ID=:Account_ID WHERE DoctorID=:DoctorID ";
  $stmt= $this->connection->prepare($sql);
  $user['DoctorID']=$id;
  $stmt->execute($user);


}
}

 ?>
