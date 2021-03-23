<?php





Flight::route('GET /accounts', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 10);

  $search = Flight::query('search');

  if ($search){
    Flight::json(Flight::accountDao()->get_accounts($search, $offset, $limit));
  }else{
    Flight::json(Flight::accountDao()->get_all($offset,$limit));
  }

  
});

Flight::route('GET /accounts', function(){


  $offset=Flight::query('offset',0);
  $limit=Flight::query('limit',10);
  Flight::json(Flight::accountDao()->get_all($offset,$limit));

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

 ?>
