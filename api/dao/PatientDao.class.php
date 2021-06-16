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


  /*  public function get_accounts($search, $offset, $limit, $order, $total=FALSE){
        list($order_column, $order_direction) = self::parse_order($order);


        return $this->query("SELECT *
                             FROM patients
                             WHERE LOWER(name) LIKE CONCAT('%', :name, '%')
                             ORDER BY ${order_column} ${order_direction}
                             LIMIT ${limit} OFFSET ${offset}",
                             ["name" => strtolower($search)]);


      }

*/

public function get_email_templates($account_id, $offset, $limit, $search, $order, $total=FALSE){
  list($order_column, $order_direction) = self::parse_order($order);
  $params = [];
  if ($total){
    $query = "SELECT COUNT(*) AS total ";
  }else{
    $query = "SELECT * ";
  }
  $query .= "FROM patients
             WHERE 1 = 1 ";

  if ($account_id){
    $params["accounts_id"] = $account_id;
    $query .= "AND accounts_id = :account_id ";
  }

  if (isset($search)){
    $query .= "AND ( LOWER(Name) LIKE CONCAT('%', :search, '%') OR LOWER(Email) LIKE CONCAT('%', :search, '%'))";
    $params['search'] = strtolower($search);
  }

  if ($total){
    return $this->query_unique($query, $params);
  }else{
    $query .="ORDER BY ${order_column} ${order_direction} ";
    $query .="LIMIT ${limit} OFFSET ${offset}";

    return $this->query($query, $params);
  }

}






    }





 ?>
