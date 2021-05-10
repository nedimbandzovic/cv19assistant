<?php
require_once dirname(__FILE__)."/../dao/AccountDao.class.php";
require_once dirname(__FILE__)."/../dao/UserDao.class.php";

require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../clients/SMTPClient.class.php';



class UserService extends BaseService{

  private $accountDao;
  private $SMTPClient;
  public function __construct(){
    $this->dao=new UserDao();
    $this->accountDao=new AccountDao();
    $this->SMTPClient=new SMTPClient();
  }

  public function register ($user){

    $n=10;

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
    $pass=$randomString;


    if(!isset($user['account'])) throw new Exception("Account field is needed");
try {
  $this->dao->beginTransaction();
    $account=$this->accountDao->add([

      "Nickname"=>$user['account'],
      "Name"=>$user['Name'],
      "Password"=>$pass,
      "Email"=>$user['Email'],
      "Status"=>"PENDING"
      ]);
      $user=parent::add([

        "account_id"=>$account["id"],
        "nickname"=>$account["Nickname"],
        "name"=>$account["Name"],
        "Email"=>$account["Email"],

        "password"=>$account["Password"],
        "status"=>"PENDING",
        "role"=>"USER",
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

    $this->dao->update($user['id'], ["status" => "ACTIVE"]);
    $this->accountDao->update($user['account_id'], ["Status" => "ACTIVE"]);

    //TODO send email to customer
  }

}







?>
