<?php

Flight::before('start',function(&$params,&$output){
  if (Flight::request()->url=='/swagger') return TRUE;

  if (str_starts_with(Flight::request()->url,'/users')) return TRUE;
  $header=getallheaders();
  $token=@$header['Authorization'];

  try {
    $decoded = (array)\Firebase\JWT\JWT::decode($token,"JWT_SECRET",["HS256"]);
    Flight::set('user',$decoded);

      return TRUE;


  } catch (\Exception $e){
    Flight::json(["message"=>$e->getMessage()],401);
  die;
  }




});



/* ROUTE BASED MIDDLEWARE */
/*Flight::route('*', function(){
    if (Flight::request()->url=='/swagger') return TRUE;
  if (str_starts_with(Flight::request()->url,'/users')) return TRUE;
  $header=getallheaders();
  $token=@$header['Authorization'];

  try {
    $decoded = (array)\Firebase\JWT\JWT::decode($token,"JWT_SECRET",["HS256"]);
    Flight::set('user',$decoded);

      return TRUE;


  } catch (\Exception $e){
    Flight::json(["message"=>$e->getMessage()],401);
  die;
  }




  });

*/

 ?>
