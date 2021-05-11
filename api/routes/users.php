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
  *    				 @OA\Property(property="Email", required="true", type="string", example="Any kind of email",	description="Email of the account" ),

  *          )
  *       )
  *     ),
  *  @OA\Response(response="200", description="Account that has been added into database with ID assigned.")
  * )
  */
 Flight::route('POST /users/register ', function(){
     $data=Flight::request()->data->getData();
     Flight::json(Flight::userService()->register($data));

     Flight::json(["message"=>"Check your email for confirmation link"]);


 });

 /**
  * @OA\Get(
  *     path="/users/confirm",tags={"Users"},
  *        @OA\Parameter(type="string", in="query", name="token", default=123, description="Token for account activation"),
  *
  *     @OA\Response(response="200", description="Message upon successful activation")
  * )
  */

Flight::route('GET /users/confirm/@token', function($token){
  Flight::userService()->confirm($token);
  Flight::json(["message" => "Your account has been activated"]);
});

/**
 * @OA\Post(path="/users/login", tags={"Users"}, description="Login user",
 *  @OA\RequestBody(description="Basic account info", required=true,
 *       @OA\MediaType( mediaType="application/json",
 *        @OA\Schema(
 *         @OA\Property(property="Email",type="string", required=true, example="example@gmail.com", description="email of user"),
 *         @OA\Property(property="password",type="string", required=true, example="123", description="password of user")
 *      )
 *    )
 *  ),
 *  @OA\Response(response="200", description="Login user")
 * )
 */
Flight::route('POST /users/login', function(){


  $data=Flight::request()->data->getData();
  Flight::json(Flight::userService()->login($data));

  Flight::json(["message"=>"Login process successful"]);
});

/**
 * @OA\Post(path="/users/forgot", tags={"Users"},description="Send recovery URL",
 *   @OA\RequestBody(description="Basic user info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="Email", required="true", type="string", example="myemail@gmail.com",	description="User's email address" ),
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="Message that recovery link has been sent")
 * )
 */
Flight::route('POST /users/forgot', function(){
  $data=Flight::request()->data->getData();
  Flight::userService()->forgot($data);
  Flight::json(["message"=>"Recovery link has been sent to you"]);


});
/**
 * @OA\Post(path="/users/reset", tags={"Users"},description="Reset password",
 *   @OA\RequestBody(description="Basic user info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="token", required="true", type="string", example="myemail@gmail.com",	description="User's email address" ),
 *    				 @OA\Property(property="password", required="true", type="string", example="myemail@gmail.com",	description="User's email address" ),

 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="Password reseted")
 * )
 */
Flight::route('POST /users/reset', function(){
  $data=Flight::request()->data->getData();
  Flight::userService()->reset($data);
  Flight::json(["message"=>"Password changed"]);


});

 ?>
