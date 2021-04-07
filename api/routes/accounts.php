<?php


/**
 * @OA\Info(title="Coronavirus Assistant API", version="0.1")
 */

/**
 * @OA\Get(
 *     path="/accounts",
 *     @OA\Response(response="200", description="Get registered accounts from DB")
 * )
 */


Flight::route('GET /accounts', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 10);

  $search = Flight::query('search');

  $order = Flight::query('order',"-id");


  Flight::json(Flight::accountService()->get_accounts($search, $offset, $limit,$order));


});

/**
 * @OA\Get(path="/admin/accounts/{id}",
 *     @OA\Parameter(type="integer", in="path", name="id", default=1, description="Id of account"),
 *     @OA\Response(response="200", description="Fetch individual account")
 * )
 */

Flight::route('GET /accounts/@id', function($id){

    Flight::json(Flight::accountService()->get_by_id($id));
});
/**
 * @OA\Post(path="/admin/accounts",
 *     
 *     @OA\Response(response="200", description="Add new account")
 * )
 */
Flight::route('POST /accounts', function(){
    $data=Flight::request()->data->getData();
    Flight::json(Flight::accountService()->add($data));


});
/**
 * @OA\Put(path="/admin/accounts",
 *     @OA\Parameter(type="integer", in="path", name="id", default=1, description="Id of account"),
 *     @OA\Response(response="200", description="Update account via ID")
 * )
 */
Flight::route('PUT /accounts/@id', function($id){


    $data=Flight::request()->data->getData();


    Flight::json(Flight::accountService()->update($id,$data));

});



 ?>
