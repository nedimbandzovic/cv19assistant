<?php

require_once dirname(__FILE__)."/BaseDao.class.php";
class PatientDao extends BaseDao{
public function __construct(){
  parent::__construct("patients");
}

public function get_user_by_phonenumber ($num){

    return $this->query_unique("SELECT * FROM patients WHERE PhoneNumber=:PhoneNumber", ["PhoneNumber"=>$num]);
  }


  public function get_user_by_accounts_id ($id){

      return $this->query_unique("SELECT * FROM patients WHERE accounts_id=:accounts_id", ["accounts_id"=>$id]);
    }


    public function get_accounts($search, $offset, $limit, $order){
        list($order_column, $order_direction) = self::parse_order($order);

        return $this->query("SELECT *
                             FROM patients
                             WHERE LOWER(name) LIKE CONCAT('%', :name, '%')
                             ORDER BY ${order_column} ${order_direction}
                             LIMIT ${limit} OFFSET ${offset}",
                             ["name" => strtolower($search)]);
      }








    }





 ?>
