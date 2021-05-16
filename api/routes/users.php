<?php


/* Swagger documentation */
/**
 * @OA\Info(title="Coronavirus Assistant API", version="0.1")
 * @OA\OpenApi(
 *    @OA\Server(url="http://localhost/cv19assistant/api/", description="Development Environment" ),
 * ),
 */

/**
  * @OA\Post(path="/register", tags={ "Users"},
  *   @OA\RequestBody(description="Basic account info", required=true,
  *       @OA\MediaType(mediaType="application/json",
  *    			@OA\Schema(
  *    				 @OA\Property(property="account", required="true", type="string", example="My Test Account",	description="Name of the account" ),
  *    				 @OA\Property(property="Name", required="true", type="string", example="My Test Account",	description="Name of the account" ),
  *    				 @OA\Property(property="Email", required="true", type="string", example="Any kind of email",	description="Email of the account" ),
 *    				 @OA\Property(property="DateOfBirth", required="true", type="string", example="Any kind of email",	description="Email of the account" ),
 *    				 @OA\Property(property="PhoneNumber", required="true", type="string", example="Any kind of email",	description="Email of the account" ),

 *    				 @OA\Property(property="City", required="true", type="string", example="Any kind of email",	description="Email of the account" ),
 *    				 @OA\Property(property="Address", required="true", type="string", example="Any kind of email",	description="Email of the account" ),
 *    				 @OA\Property(property="Country", required="true", type="string", example="Any kind of email",	description="Email of the account" ),
 *    				 @OA\Property(property="JMBG", required="true", type="string", example="Any kind of email",	description="Email of the account" ),
 *    				 @OA\Property(property="MedicalInsuranceNO", required="true", type="int", example="Any kind of email",	description="Email of the account" ),

  *          )
  *       )
  *     ),
  *  @OA\Response(response="200", description="Account that has been added into database with ID assigned.")
  * )
  */
 Flight::route('POST /register ', function(){
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

Flight::route('GET /confirm/@token', function($token){
  Flight::userService()->confirm($token);

  Flight::json(["message" => "Your account has been activated"]);
});

/**
 * @OA\Post(path="/login", tags={"Users"}, description="Login user",
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
Flight::route('POST /login', function(){


  $data=Flight::request()->data->getData();
  Flight::json(Flight::userService()->login($data));

  Flight::json(["message"=>"Login process successful"]);
});

/**
 * @OA\Post(path="/forgot", tags={"Users"},description="Send recovery URL",
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
Flight::route('POST /forgot', function(){
  $data=Flight::request()->data->getData();
  Flight::userService()->forgot($data);
  Flight::json(["message"=>"Recovery link has been sent to you"]);


});
/**
 * @OA\Post(path="/reset", tags={"Users"},description="Reset password",
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
Flight::route('POST /reset', function(){
  $data=Flight::request()->data->getData();
  Flight::userService()->reset($data);
  Flight::json(["message"=>"Password changed"]);


});

/**
  * @OA\Post(path="/registerDoctor", tags={ "Users"},
  *   @OA\RequestBody(description="Basic account info", required=true,
  *       @OA\MediaType(mediaType="application/json",
  *    			@OA\Schema(
  *    				 @OA\Property(property="account", required="true", type="string", example="My Test Account",	description="Name of the account" ),
  *    				 @OA\Property(property="Name", required="true", type="string", example="My Test Account",	description="Name of the account" ),
  *    				 @OA\Property(property="Email", required="true", type="string", example="Any kind of email",	description="Email of the account" ),
 *    				 @OA\Property(property="InstitutionName", required="true", type="string", example="Any kind of email",	description="Email of the account" ),

 *    				 @OA\Property(property="PhoneNumber", required="true", type="string", example="Any kind of email",	description="Email of the account" ),
 *    				 @OA\Property(property="Address", required="true", type="string", example="Any kind of email",	description="Email of the account" ),
 *    				 @OA\Property(property="JMBG", required="true", type="string", example="Any kind of email",	description="Email of the account" ),
 *    				 @OA\Property(property="InstitutionPosition", required="true", type="int", example="Any kind of email",	description="Email of the account" ),

  *          )
  *       )
  *     ),
  *  @OA\Response(response="200", description="Account that has been added into database with ID assigned.")
  * )
  */
 Flight::route('POST /registerDoctor ', function(){
     $data=Flight::request()->data->getData();
     Flight::json(Flight::userService()->registerDoctor($data));

     Flight::json(["message"=>"Check your email for confirmation link"]);


 });

 /**
  * @OA\Put(path="/admin/users/{id}", tags={ "Admin"}, security={{"ApiKeyAuth": {}}},
  *   @OA\Parameter(@OA\Schema(type="integer"), in="path", name="id", default=1),
  *   @OA\RequestBody(description="Basic account info that is going to be updated", required=true,
  *       @OA\MediaType(mediaType="application/json",
  *    			@OA\Schema(
  *    				 @OA\Property(property="role", required="true", type="string", example="My Test Account",	description="Name of the account" ),
  *          )
  *       )
  *     ),
  *     @OA\Response(response="200", description="Update account based on id")
  * )
  */
 Flight::route('PUT /admin/users/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::userService()->update($id, $data));
 });
 /**
  * @OA\Put(path="/admin/patients/{id}", tags={ "Admin"}, security={{"ApiKeyAuth": {}}},
  *   @OA\Parameter(@OA\Schema(type="integer"), in="path", name="id", default=1),
  *   @OA\RequestBody(description="Update the vaccine", required=true,
  *       @OA\MediaType(mediaType="application/json",
  *    			@OA\Schema(
  *    				 @OA\Property(property="Vaccine", required="true", type="string", example="Sputnik V",	description="Enter the new vaccine" ),
  *          )
  *       )
  *     ),
  *     @OA\Response(response="200", description="Update account based on id")
  * )
  */
 Flight::route('PUT /admin/patients/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::patientService()->update($id, $data));
 });
