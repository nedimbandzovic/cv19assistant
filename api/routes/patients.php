<?php


/* Swagger documentation */
/**
 * @OA\Info(title="Coronavirus Assistant API", version="0.1")
 * @OA\OpenApi(
 *    @OA\Server(url="http://localhost/cv19assistant/api/", description="Development Environment" ),
 * ),

 * @OA\SecurityScheme(

 * securityScheme="ApiKeyAuth",
 * in="header",
 *name="Authorization",
 *type="apiKey",
 *scheme="Bearer",
 *bearerFormat="JWT",
 *),
 */

 /**
  * @OA\Post(path="/patients/register", tags={ "Patients"},security={{"ApiKeyAuth":{}}},
  *   @OA\RequestBody(description="Basic account info", required=true,
  *       @OA\MediaType(mediaType="application/json",
  *    			@OA\Schema(
  *    				 @OA\Property(property="Name", required="true", type="string", example="My Test Account",	description="Name of the account" ),
  *    				 @OA\Property(property="Surname", required="true", type="string", example="Any kind of email",	description="Email of the account" ),
  *             @OA\Property(property="DateOfBirth", required="true", type="string", example="My Test Account",	description="Name of the account" ),
  *    				 @OA\Property(property="PhoneNumber", required="true", type="string", example="Any kind of email",	description="Email of the account" ),
  *             @OA\Property(property="City", required="true", type="string", example="My Test Account",	description="Name of the account" ),
  *    				 @OA\Property(property="Address", required="true", type="string", example="Any kind of email",	description="Email of the account" ),
  *           @OA\Property(property="Country", required="true", type="string", example="My Test Account",	description="Name of the account" ),
  *    				 @OA\Property(property="JMBG", required="true", type="string", example="Any kind of email",	description="Email of the account" ),
  *     @OA\Property(property="MedicalInsuranceNO", required="true", type="string", example="My Test Account",	description="Name of the account" ),
  *          )
  *       )
  *     ),
  *  @OA\Response(response="200", description="Account that has been added into database with ID assigned.")
  * )
  */
 Flight::route('POST /patients/register', function(){
     $data=Flight::request()->data->getData();
     Flight::json(Flight::patientService()->register($data));



 });


?>
