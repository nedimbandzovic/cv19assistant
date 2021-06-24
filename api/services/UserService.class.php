<?php
header('Content-Type: application/json');
use \Firebase\JWT\JWT;

require_once dirname(__FILE__)."/../dao/AccountDao.class.php";
require_once dirname(__FILE__)."/../dao/UserDao.class.php";

require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../Utils.class.php';

require_once dirname(__FILE__).'/../clients/SMTPClient.class.php';
require_once dirname(__FILE__).'/../dao/PatientDao.class.php';
require_once dirname(__FILE__).'/../dao/DoctorsDao.class.php';






class UserService extends BaseService{

  private $accountDao;
  private $SMTPClient;
  public function __construct(){
    $this->dao=new UserDao();
    $this->accountDao=new AccountDao();
    $this->SMTPClient=new SMTPClient();
    $this->patientsDao=new PatientDao();
    $this->doctorsDao=new DoctorsDao();


  }


    public function get_accounts($search, $offset, $limit, $order){
        if ($search){
          return $this->dao->get_accounts($search, $offset, $limit, $order);
        }else{
          return $this->dao->get_all($offset, $limit, $order);
        }
      }

  public function register ($user){



    if(!isset($user['Email'])) throw new Exception("Check your email");
try {
  $this->dao->beginTransaction();
    $account=$this->accountDao->add([

      "Name"=>$user['Name'],
      "Password"=>Utils::random_pwd(),
      "Email"=>$user['Email'],
      "Status"=>"PENDING"


      ]);

      $x=$account['id'];


      $user=$this->patientsDao->add([


        "Name"=>$user['Name'],
        "accounts_id"=>$x,
        "DateOfBirth"=>$user['DateOfBirth'],
        "PhoneNumber"=>$user['PhoneNumber'],
        "Email"=>$user['Email'],
        "City"=>$user['City'],
        "Address"=>$user['Address'],
        "Country"=>$user['Country'],
        "JMBG"=>$user['JMBG'],
        "MedicalInsuranceNO"=>$user['MedicalInsuranceNO'],
        "Vaccine"=>$user['Vaccine'],
        "VaccinationPlace"=>$user['VaccinationPlace'],
        "VaccinationDate"=>Utils::getVaccinationDate()
      ]);






      $user=parent::add([

        "account_id"=>$account["id"],
        "name"=>$account["Name"],
        "Email"=>$account["Email"],

        "password"=>$account["Password"],
        "status"=>"PENDING",
        "role"=>"PATIENT",
        "token"=>md5(random_bytes(16))

      ]);







      $this->SMTPClient->send_register_user_token($user);




$this->dao->commit();






} catch (\Exception $e){
  $this->dao->rollBack();
  if (str_contains($e->getMessage(),'accounts.uniquename')){
    throw new Exception ("Account with same mail exists in database", 400, $e);
  }
  else{
    throw $e;
  }


}

}



public function confirm($token){
    $user = $this->dao->get_user_by_token($token);

    if (!isset($user['id'])) throw Exception("Invalid token");

    $this->dao->update($user['id'], ["status" => "ACTIVE", "token"=>NULL]);
    $this->accountDao->update($user['account_id'], ["Status" => "ACTIVE"]);

    echo "Account confirmation successful";







    //TODO send email to customer
  }

  public function login($user){
    $db_user = $this->dao->get_user_by_email($user['Email']);

    if (!isset($db_user['id'])) throw new Exception("User doesn't exists", 400);

    if ($db_user['status'] != 'ACTIVE') throw new Exception("Account not active", 400);

    $account = $this->accountDao->get_by_id($db_user['account_id']);
    if (!isset($account['id']) || $account['Status'] != 'ACTIVE') throw new Exception("Account not active", 400);

    if ($db_user['password'] != $user['password']) throw new Exception("Invalid password", 400);

    $jwt=JWT::encode(["exp"=>(time()+Config::JWT_TOKEN_TIME),"id"=>$db_user["id"],"account_id"=> $db_user["account_id"],"role"=>$db_user["role"]],Config::JWP_SECRET);


    return ["token"=>$jwt];
  }

  public function forgot($user){

    $db_user=$this->dao->get_user_by_email($user['Email']);

    if (!isset($db_user['id'])) throw new Exception ("User does not exist",400);
    if (strtotime(date(Config::DATE_FORMAT)) - strtotime($db_user['token_creation']) < 360) throw new Exception ("Be patient, multiple tokens cannot be generated at once",400);




    $db_user=$this->update($db_user['id'],['token'=>md5(random_bytes(16)),'token_creation'=>date(Config::DATE_FORMAT)]);

    $this->SMTPClient->send_user_recovery_token($db_user);


  }






  public function reset($user){
      $db_user = $this->dao->get_user_by_token($user['token']);

      if (!isset($db_user['id'])) throw new Exception("Invalid token", 400);

      if (strtotime(date(Config::DATE_FORMAT)) - strtotime($db_user['token_creation']) >60) throw new Exception ("Token expired",400);


      $this->dao->update($db_user['id'], ['password' => $user['password'], 'token' => NULL]);
      $this->accountDao->update($db_user['account_id'], ['Password'=>$user['password']]);
      return $db_user;
    }

    public function registerDoctor ($user){


      if(!isset($user['account'])) throw new Exception("Account field is needed");
  try {
    $this->dao->beginTransaction();
      $account=$this->accountDao->add([

        "Nickname"=>$user['account'],
        "Name"=>$user['Name'],
        "Password"=>Utils::random_pwd(),
        "Email"=>$user['Email'],
        "Status"=>"PENDING"


        ]);

        $x=$account['id'];

        $user=$this->doctorsDao->add([


          "Name"=>$user['Name'],
          "Account_ID"=>$x,
          "InstitutionName"=>$user['InstitutionName'],
          "PhoneNumber"=>$user['PhoneNumber'],
          "Address"=>$user['Address'],
          "JMBG"=>$user['JMBG'],
          "InstitutionPosition"=>$user['InstitutionPosition']

        ]);






        $user=parent::add([

          "account_id"=>$account["id"],
          "nickname"=>$account["Nickname"],
          "name"=>$account["Name"],
          "Email"=>$account["Email"],

          "password"=>$account["Password"],
          "status"=>"PENDING",
          "role"=>"DOCTOR",
          "token"=>md5(random_bytes(16))

        ]);







        $this->SMTPClient->send_register_user_token($user);




  $this->dao->commit();






  } catch (\Exception $e){
    $this->dao->rollBack();
    if (str_contains($e->getMessage(),'accounts.uniquename')){
      throw new Exception ("Account with same mail exists in database", 400, $e);
    }
    else{
      throw $e;
    }


  }

  }






}







?>
