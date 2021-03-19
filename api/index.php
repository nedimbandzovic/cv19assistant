<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once dirname(__FILE__)."\dao\AccountDao.class.php";
require_once dirname(__FILE__)."\dao\BaseDao.class.php";




$account_dao= new AccountDao();

$user=[
  "Nickname"=>"mahmut.besirevic",
  "Password"=>"makaaicsgo",
  "AccountType"=>"COVID-19 patient"
];

$user1=[
  "Nickname"=>"adi.besirevic",
  "Password"=>"adada",
  "AccountType"=>"COVID-19 patient"
];

$user21=[
  "Nickname"=>"aaa.besirevic",
  "Password"=>"xxx",
  "AccountType"=>"COVID-19 patient"
];

$dao=new AccountDao();

$userx= [

  "Nickname" => "nedim.bandzovic",
  "Password"=>"12345",
  "AccountType"=>"COVID-19 patient"
];

$dao->add($userx);


$user=$dao->get_all_accounts();
print_r($user);


//$user=$account_dao->update_account(50, $user21);
?>
