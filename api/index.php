<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once dirname(__FILE__)."\dao\AccountDao.class.php";

echo("Hello from API test screen <br>");




echo("Enter your information!");

 ?>

 <br>
 <form action="index.php" method="post">
   Nickname: <input type="text" name="nickname">
   <br>
   Password: <input type="password" name="password">
   <br>
   Account type:
  <input type="text" name="option">
   <br>
   <input type="submit">
 </form>
<?php

$nickname=$_POST["nickname"];
$password=$_POST["password"];
$accounttype=$_POST["option"];

$user1= [


  "Nickname"=>$nickname,
  "Password"=>$password,
  "AccountType"=>$accounttype
];

$function=new AccountDao();

$user=$function->add_account($user1);
 ?>
