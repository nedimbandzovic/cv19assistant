<?php
require_once dirname(__FILE__)."/../dao/DoctorsDao.class.php";
require_once dirname(__FILE__).'/BaseService.class.php';


class DoctorService extends BaseService{



  public function __construct(){
    $this-> dao=new DoctorDao();
  }



  public function get_accounts($search, $offset, $limit, $order){
      if ($search){
        return $this->dao->get_accounts($search, $offset, $limit, $order);
      }else{
        return $this->dao->get_all($offset, $limit, $order);
      }
    }


  public function add ($account){

    if (!isset($account["Nickname"])) throw new Exception ("Nickname wasnt defined");
    return parent::add($account);
  }
