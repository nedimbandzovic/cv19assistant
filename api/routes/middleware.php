<?php

Flight::route('/user/*', function(){
  try {
    $user = (array)\Firebase\JWT\JWT::decode(Flight::header("Authorization"), Config::JWT_SECRET, ["HS256"]);
    if (Flight::request()->method != "GET" && $user["r"] == "USER_READ_ONLY"){
      throw new Exception("Read only user can't change anything.", 403);
    }
    Flight::set('user', $user);
    return TRUE;
  } catch (\Exception $e) {
    Flight::json(["message" => $e->getMessage()], 401);
    die;
  }
});

Flight::route('/admin/*', function(){
  try {
    $user = (array)\Firebase\JWT\JWT::decode(Flight::header("Authorization"), Config::JWT_SECRET, ["HS256"]);
    if ($user['r'] != "ADMIN"){
      throw new Exception("Admin access required", 403);
    }
    Flight::set('user', $user);
    return TRUE;
  } catch (\Exception $e) {
    Flight::json(["message" => $e->getMessage()], 401);
    die;
  }
});

Flight::route('/doctors/*', function(){
  try {
    $user = (array)\Firebase\JWT\JWT::decode(Flight::header("Authorization"), Config::JWT_SECRET, ["HS256"]);
    if ($user['r'] != "DOCTOR"){
      throw new Exception("Doctor access required", 403);
    }
    Flight::set('user', $user);
    return TRUE;
  } catch (\Exception $e) {
    Flight::json(["message" => $e->getMessage()], 401);
    die;
  }
});
Flight::route('/patients/*', function(){
  try {
    $user = (array)\Firebase\JWT\JWT::decode(Flight::header("Authorization"), Config::JWT_SECRET, ["HS256"]);
    if ($user['r'] != "PATIENT"){
      throw new Exception("Patient access required", 403);
    }
    Flight::set('user', $user);
    return TRUE;
  } catch (\Exception $e) {
    Flight::json(["message" => $e->getMessage()], 401);
    die;
  }
});


 ?>
