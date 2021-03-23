<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class AccountDao extends BaseDao{

  public function __construct(){
    parent::__construct("accounts");
  }

  public function get_accounts ($search, $offset, $limit,$order="-id"){

    switch (substr($order,0,1)){

      case "-": $order_direction="ASC"; break;

      case "+": $order_direction="DESC"; break;

      default: throw new Exception ("Invalid order format. First character should be either - or +"); break;
    };

    $order_column=substr($order,1);
    return $this-> query("SELECT * FROM accounts WHERE LOWER(Nickname) LIKE CONCAT('%',:Nickname,'%')
    ORDER BY: ${order_column} ${order_direction}
    LIMIT ${limit} OFFSET ${offset} ", ["Nickname"=> strtolower($search)]);
  }




}









?>
