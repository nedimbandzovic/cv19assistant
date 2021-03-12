<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class AccountDao extends BaseDao{


  function add_account ($account){

    $sql="INSERT INTO accounts (Nickname,Password,AccountType) VALUES (:Nickname,:Password,:AccountType)";
    $stmp=$this->connection->prepare($sql);
    $stmp->execute($account);
    }
  function get_account_by_ID($name){

      return $this->query_unique("SELECT * FROM accounts WHERE Account_ID=:Account_ID", ["Account_ID"=>$name]);

    }

  function get_account_by_nickname($name){

      return $this->query_unique("SELECT * FROM accounts WHERE Nickname=:Nickname", ["Nickname"=>$name]);
}

function update_account ($id, $user){

  $sql="UPDATE accounts SET Nickname=:Nickname,Password=:Password,AccountType=:AccountType WHERE Account_ID=:Account_ID";
  $stmp=$this->connection->prepare($sql);
  $user['Account_ID'] = $id;
  $stmp->execute($user);
}


}


?>
