<?php
require_once dirname(__FILE__)."/../config.php";
class BaseDao{


  protected $connection;



  function __construct(){
    try{

      $this->connection= new PDO("mysql:host=".Config::DB_HOST.";dbname=".Config::DB_SCHEME,Config::DB_USERNAME,Config::DB_PASSWORD);
      $this->connection-> setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e){
      throw $e;
    }

  }

  function insert($table, $entity){

    $query="INSERT INTO ${table} (";
      foreach($entity as $column=>$value){
      $query.=$column.",";
      }
    $query=substr($query,0,-1);
    $query.=")VALUES(";
      foreach($entity as $column=>$value){
      $query.=":".$column.",";
      }
    $query=substr($query,0,-1);
    $query.=")";

    $stmt=$this->connection->prepare($query);
    $stmt->execute($entity);
    $entity['id']=$this-> connection -> lastInsertId();
    return $entity;


  }

  function query($query, $parameter){

    $stmt=$this->connection->prepare("$query");
    $stmt->execute($parameter);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);



  }

  function query_unique($query, $parameter){
    $results = $this -> query($query,$parameter);
    return reset($results);


  }



}

 ?>
