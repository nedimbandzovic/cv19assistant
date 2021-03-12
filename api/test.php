<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once dirname (__FILE__)."/dao/DoctorsDao.class.php";
require_once dirname (__FILE__)."/dao/BaseDao.class.php";

$doctors_dao= new DoctorsDao();

$doctor=$doctors_dao->get_doctor_by_id(1);



print_r($doctor);
 ?>
