<?php



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


 ?>
