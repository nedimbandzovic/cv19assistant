<?php


/* Swagger documentation */
/**
 * @OA\Info(title="Coronavirus Assistant API", version="0.1")
 * @OA\OpenApi(
 *    @OA\Server(url="http://localhost/cv19assistant/api/", description="Development Environment" ),
 * ),
 */

/**
  * @OA\Post(path="/users/register", tags={ "Users"},
  *   @OA\RequestBody(description="Basic account info", required=true,
  *       @OA\MediaType(mediaType="application/json",
  *    			@OA\Schema(
  *    				 @OA\Property(property="account", required="true", type="string", example="My Test Account",	description="Name of the account" ),
  *    				 @OA\Property(property="Name", required="true", type="string", example="My Test Account",	description="Name of the account" ),

  *          )
  *       )
  *     ),
  *  @OA\Response(response="200", description="Account that has been added into database with ID assigned.")
  * )
  */
 Flight::route('POST /users/register ', function(){
     $data=Flight::request()->data->getData();
     Flight::json(Flight::userService()->register($data));


 });



Flight::route('GET /users/confirm/@token', function($token){
  Flight::userService()->confirm($token);
  Flight::json(["message" => "Your account has been activated"]);
});
 ?>
