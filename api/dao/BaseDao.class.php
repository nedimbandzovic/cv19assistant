<?php
require_once dirname(__FILE__)."/../config.php";

ini_set('display errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

class BaseDao{
  private $connection;

  function __construct(){

    try {

      $this->connection = new PDO("mysql:host=".Config::DB_HOST.";dbname=".Config::DB_SCHEME, Config::DB_USERNAME, Config::DB_PASSWORD);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo("Successful");
    }
    catch(PDOException $e){
      echo("Connection failed " . $e->getMessage());
    }



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





 ?>
