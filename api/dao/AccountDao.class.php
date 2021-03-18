<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class AccountDao extends BaseDao{


  function add_account ($user){

  return $this->insert("accounts",$user);

    }
  function get_account_by_ID($name){

      return $this->query_unique("SELECT * FROM accounts WHERE Account_ID=:Account_ID", ["Account_ID"=>$name]);

    }

  function get_account_by_nickname($name){

      return $this->query_unique("SELECT * FROM accounts WHERE Nickname=:Nickname", ["Nickname"=>$name]);
}

function update_account ($id, $user){

  $query="UPDATE accounts SET";
    foreach ($user as $nickname=>$value){
      $query.=$nickname."=:".$nickname.",";

    }
    $query=substr($query,0,-2);
    $query.="WHERE id=:id";

    $sql="UPDATE accounts SET Nickname=:Nickname,Password=:Password,AccountType=:AccountType WHERE id=:id";
    $stmp=$this->connection->prepare($sql);
    $user['id'] = $id;
    $stmp->execute($user);
}

}







?>
