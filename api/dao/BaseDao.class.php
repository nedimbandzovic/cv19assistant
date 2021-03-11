<?php
require_once dirname(__FILE__)."/../config.php";

class BaseDao{
  private $connection;

  function __construct(){
    $connection=new PDO("mysql:host=".Config::DB_HOST.";dbname=".Config::DB_SCHEME, DB_USERNAME, DB_PASSWORD);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo("Connected succesful");
  }
  catch (PDOException $e){
    echo("Connection failed : " . $e->getMessage();
  }


  }
  function insert(){

  }
  function query(){

  }
  function query_unique(){

  }
  function update(){

  }



}

 ?>
