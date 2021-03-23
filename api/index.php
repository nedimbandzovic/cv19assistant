
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once dirname(__FILE__)."\dao\AccountDao.class.php";

require dirname (__FILE__). '/../vendor/autoload.php';
require_once dirname(__FILE__)."/routes/accounts.php";
require_once dirname(__FILE__)."/services/AccountService.class.php";

Flight::map('query', function($name, $default_value=NULL){
  $requests=Flight::request();
  $query_param=@$requests->query->getData()[$name];
  $query_param= $query_param ? $query_param:0;
  return $query_param;

});
Flight::register('accountDao','AccountDao');
Flight::register('accountService', 'AccountService');



Flight::start();







?>
