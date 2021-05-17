<?php
require_once dirname(__FILE__)."/../dao/AccountDao.class.php";
require_once dirname(__FILE__)."/../dao/UserDao.class.php";
require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../Utils.class.php';

require_once dirname(__FILE__).'/../clients/SMTPClient.class.php';
require_once dirname(__FILE__).'/../dao/PatientDao.class.php';
require_once dirname(__FILE__).'/../dao/DoctorsDao.class.php';
require_once dirname(__FILE__).'/../clients/SMTPClient.class.php';



class PatientService extends BaseService{

  public function __construct(){
    $this->dao=new PatientDao();
  }

    public function get_accounts($search, $offset, $limit, $order){
        if ($search){
          return $this->dao->get_accounts($search, $offset, $limit, $order);
        }else{
          return $this->dao->get_all($offset, $limit, $order);
        }
      }




}
 ?>