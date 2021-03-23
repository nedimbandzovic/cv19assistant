<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class AccountDao extends BaseDao{

  public function __construct(){
    parent::__construct("accounts");
  }

  public function get_accounts ($search, $offset, $limit){
    return $this-> query("SELECT * FROM accounts WHERE LOWER(Nickname) LIKE CONCAT('%',:Nickname,'%') LIMIT ${limit} OFFSET ${offset} ", ["Nickname"=> strtolower($search)]);
  }




}









?>
