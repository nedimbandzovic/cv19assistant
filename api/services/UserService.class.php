<?php
require_once dirname(__FILE__)."/../dao/AccountDao.class.php";
require_once dirname(__FILE__)."/../dao/UserDao.class.php";

require_once dirname(__FILE__).'/BaseService.class.php';


class UserService extends BaseService{

  private $accountDao;

  public function __construct(){
    $this->dao=new UserDao();
    $this->accountDao=new AccountDao();
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
    $account=$this->accountDao->add([

      "Nickname"=>$user['account'],
      "Name"=>$user['Name'],
      "Password"=>$pass,
      "Status"=>"PENDING"
      ]);
      $user=parent::add([

        "account_id"=>$account["id"],
        "nickname"=>$account["Nickname"],
        "name"=>$account["Name"],
        "password"=>$account["Password"],
        "status"=>"PENDING",
        "role"=>"USER",
        "token"=>md5(random_bytes(16))
      ]);




    return $user;






} catch (\Exception $e){
  throw $e;
}

}

}







?>
