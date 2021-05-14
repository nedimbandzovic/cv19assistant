<?php
header('Content-Type: application/json');

use \Firebase\JWT\JWT;

require_once dirname(__FILE__)."/../dao/AccountDao.class.php";
require_once dirname(__FILE__)."/../dao/UserDao.class.php";

require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../Utils.class.php';

require_once dirname(__FILE__).'/../clients/SMTPClient.class.php';



class PatientService extends BaseService{

  private $SMTPClient;
  public function __construct(){
    $this->dao=new PatientDao();
    $this->SMTPClient=new SMTPClient();
  }

  public function register ($user){


try {
  $this->dao->beginTransaction();
    $user=$this->dao->add([

      "Name"=>$user['Name'],
      "Surname"=>$user['Surname'],
      "DateOfBirth"=>$user['DateOfBirth'],
      "Name"=>$user['Name'],
      "PhoneNumber"=>$user['PhoneNumber'],
      "City"=>$user['City'],
      "Address"=>$user['Address'],
      "Country"=>$user['Country'],
      "JMBG"=>$user['JMBG'],
      "MedicalInsuranceNO"=>$user['MedicalInsuranceNO'],
      "NumberOfDoses"=>2,
      "Vaccine"=>Utils::getVaccine(),
      "VaccinationPlace"=>Utils::getVaccinationPlace(),
      "VaccinationDate"=>Utils::getVaccinationDate()
]);

    $this->dao->commit();






} catch (\Exception $e){
  $this->dao->rollBack();
  if (str_contains($e->getMessage(),'patients.uniquename')){
    throw new Exception ("Account already exists", 400, $e);
  }
  else{
    throw $e;
  }


}

}


}







?>
