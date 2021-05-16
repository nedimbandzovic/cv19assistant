

<?php



Flight::route('/admin/*', function(){
  try {
    $user = (array)\Firebase\JWT\JWT::decode(Flight::header("Authorization"), Config::JWP_SECRET, ["HS256"]);
    if ($user['role'] != "ADMIN"){
      throw new Exception("Admin access required", 403);
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
    $user = (array)\Firebase\JWT\JWT::decode(Flight::header("Authorization"), Config::JWP_SECRET, ["HS256"]);
    if ($user['role'] != "PATIENT"){
      throw new Exception("Patient access required", 403);
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
    $user = (array)\Firebase\JWT\JWT::decode(Flight::header("Authorization"), Config::JWP_SECRET, ["HS256"]);
    if ($user['role'] != "DOCTOR"){
      throw new Exception("Doctor access required", 403);
    }
    Flight::set('user', $user);
    return TRUE;
  } catch (\Exception $e) {
    Flight::json(["message" => $e->getMessage()], 401);
    die;
  }
});
?>
