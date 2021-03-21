
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once dirname(__FILE__)."\dao\AccountDao.class.php";
require_once dirname(__FILE__)."\dao\BaseDao.class.php";
require_once dirname(__FILE__)."\dao\DoctorsDao.class.php";
require_once dirname (__FILE__)."\dao\HealthStatus.class.php";
require_once dirname (__FILE__)."\dao\OrdersDao.class.php";
require_once dirname (__FILE__)."\dao\PatientDao.class.php";
require_once dirname (__FILE__)."\dao\PaymentsDao.class.php";
require_once dirname (__FILE__)."\dao\PoliceOfficer.class.php";
require_once dirname (__FILE__)."\dao\QuarantineStatusDao.class.php";
require_once dirname (__FILE__)."\dao\SuperMarketChainDao.class.php";
require dirname (__FILE__). '/../vendor/autoload.php';


Flight::register('accountDao','AccountDao');
Flight::route('/', function(){
    echo 'hello world!';
});
Flight::route('GET /accounts', function(){

    $accounts=Flight::accountDao()->get_all(0,10);
    Flight::json($accounts);
});
Flight::route('GET /accounts/@id', function($id){

    $accounts=Flight::accountDao()->get_by_id($id);
    Flight::json($accounts);
});

Flight::route('POST /accounts', function(){
    $requests=Flight::request();
    $data=$requests->data->getData();
    $account=Flight::accountDao()->add($data);
    Flight::json($account);


});

Flight::route('PUT /accounts/@id', function($id){


    $requests=Flight::request();
    $data=$requests->data->getData();

    Flight::accountDao()->update($id,$data);

    $accounts=Flight::accountDao()->get_by_id($id);
    Flight::json($accounts);





});

Flight::route('/hello3', function(){
    echo 'hello world3!';
});
Flight::route('/hello4', function(){
    echo 'hello world4!';
});
Flight::route('/hello5', function(){
    echo 'hello world5!';
});
Flight::start();







?>
