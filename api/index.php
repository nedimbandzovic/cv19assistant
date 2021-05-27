
<?php
use \Firebase\JWT\JWT;

header('Content-Type: application/json');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once dirname(__FILE__)."\dao\AccountDao.class.php";
require_once dirname(__FILE__)."\dao\UserDao.class.php";
require_once dirname(__FILE__)."\dao\DoctorsDao.class.php";
require_once dirname(__FILE__)."\dao\PatientDao.class.php";



require dirname (__FILE__). '/../vendor/autoload.php';
require_once dirname(__FILE__)."/routes/accounts.php";

Flight::route('GET /swagger', function(){
  $openapi = @\OpenApi\scan(dirname(__FILE__)."/routes");
  header('Content-Type: application/json');
  echo $openapi->toJson();
});

Flight::route('GET /', function(){
  Flight::redirect('/docs');
});
/*
Flight::map('error', function(Exception $ex){
    // Handle error
    header("Content-Type: application/json");
    Flight::halt($ex->getCode(),json_encode(["message"=>$ex->getMessage()],$ex->getCode()?$ex->getCode():500));

});
*/
Flight::map('header', function($name){
  $headers = getallheaders();
  return @$headers[$name];
});





Flight::map('query', function($name, $default_value=NULL){
  $requests=Flight::request();
  $query_param=@$requests->query->getData()[$name];
  $query_param= $query_param ? $query_param:0;
  return $query_param;

});

Flight::register('accountService', 'AccountService');
Flight::register('userService', 'UserService');
Flight::register('doctorService','DoctorService');
Flight::register('patientService','PatientService');




require_once dirname(__FILE__)."/routes/middleware.php";
require_once dirname(__FILE__)."/routes/users.php";


require_once dirname(__FILE__)."/services/AccountService.class.php";
require_once dirname(__FILE__)."/services/UserService.class.php";
require_once dirname(__FILE__)."/services/PatientService.class.php";
require_once dirname(__FILE__)."/services/DoctorService.class.php";






Flight::start();







?>
