<?php


/* Swagger documentation */
/**
 * @OA\Info(title="Autoresponder BizNet API", version="0.1")
 * @OA\OpenApi(
 *    @OA\Server(url="http://localhost/cv19assistant/api/", description="Development Environment" ),
 * ),
 */

/**
 * @OA\Get(
 *     path="/accounts",tags={"account"},
 *        @OA\Parameter(type="integer", in="query", name="offset", default=0, description="Offset for pagination"),
 *     @OA\Parameter(type="integer", in="query", name="limit", default=25, description="Limit for pagination"),
 *     @OA\Parameter(type="string", in="query", name="search", description="Search string for accounts. Case insensitive search."),
 *     @OA\Parameter(type="string", in="query", name="order", default="-id", description="Sorting for return elements. -column_name ascending order by column_name or +column_name descending order by column_name"),
 *     @OA\Response(response="200", description="List accounts from database")
 * )
 */
Flight::route('GET /accounts', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', "-id");

  Flight::json(Flight::accountService()->get_accounts($search, $offset, $limit, $order));
});

/**
 * @OA\Get(path="/admin/accounts/{id}",
 *     @OA\Parameter(type="integer", in="path", name="id", example=1, description="Id of account"),
 *     @OA\Response(response="200", description="Fetch individual account")
 * )
 */

Flight::route('GET /accounts/@id', function($id){

    Flight::json(Flight::accountService()->get_by_id($id));
});
/**
 * @OA\Post(path="/admin/accounts",
 *     @OA\Parameter(type="integer", in="path", name="id", example=1, description="Id of account"),
 *     @OA\Response(response="200", description="Add new account")
 * )
 */
Flight::route('POST /accounts', function(){
    $data=Flight::request()->data->getData();
    Flight::json(Flight::accountService()->add($data));


});
/**
 * @OA\Put(path="/admin/accounts",
 *     @OA\Parameter(type="integer", in="path", name="id", example=1, description="Id of account"),
 *     @OA\Response(response="200", description="Update account via ID")
 * )
 */
Flight::route('PUT /accounts/@id', function($id){


    $data=Flight::request()->data->getData();


    Flight::json(Flight::accountService()->update($id,$data));

});



 ?>
