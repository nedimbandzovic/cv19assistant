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

  $this->update("accounts",$id,$user);
}
function update_account_by_nickname($Nickname,$user){

  return $this->update("accounts",$Nickname,$user,"Nickname");
}

}









?>
