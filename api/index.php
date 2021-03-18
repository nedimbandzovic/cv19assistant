<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once dirname(__FILE__)."\dao\AccountDao.class.php";


$account_dao= new AccountDao();

$user=[
  "Nickname"=>"mahmut.besirevic",
  "Password"=>"makaaicsgo",
  "AccountType"=>"COVID-19 patient"
];



$user=$account_dao->update_account(70,$user);

 ?>
