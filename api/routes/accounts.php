<?php


/* Swagger documentation */
/**
 * @OA\Info(title="Coronavirus Assistant API", version="0.1")
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
 * @OA\Get(path="/accounts/{id}", tags={ "account"},
 *     @OA\Parameter(type="integer", in="path", name="id", default=1, description="Id of account"),
 *     @OA\Response(response="200", description="Fetch individual account")
 * )
 */
Flight::route('GET /accounts/@id', function($id){
  Flight::json(Flight::accountService()->get_by_id($id));
});

/**
 * @OA\Put(path="/accounts/{id}", tags={"account"},
 *   @OA\Parameter(@OA\Schema(type="integer"), in="path", name="id", default=1),
 *   @OA\RequestBody(description="Basic account info that is going to be updated", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="Nickname", required="true", type="string", example="john.doe",	description="Nickname of the account" ),
*               @OA\Property(property="Name", required="true", type="string", example="My Test Account",	description="Name of the account" ),
 *    				 @OA\Property(property="Status", type="string", example="ACTIVE",	description="Account status" )
 *          )
 *       )
 *     ),
 *     @OA\Response(response="200", description="Update account based on id")
 * )
 */
Flight::route('PUT /accounts/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::accountService()->update($id, $data));
});


 ?>
