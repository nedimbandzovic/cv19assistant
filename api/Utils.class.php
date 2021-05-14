<?php
class Utils{


  public static function random_pwd($n=10){

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
    return $randomString;



  }

  public static function getVaccine(){

    $arrX = array("Sinopharm-BBIpV", "Pfizer-BioNTech","SinoVAC", "AstraZeneca-CoviShield", "Johnson&Johnson", "Sputnik V");

    $k = array_rand($arrX);

    return $arrX[$k];


  }

  public static function getVaccinationPlace(){

    $arrX = array("Zetra Olympic Hall", "Mirza Delibašić Sports Hall","Novo Sarajevo Sports Hall");

    $k = array_rand($arrX);

    return $arrX[$k];


  }

  public static function getVaccinationDate(){

    $int= mt_rand(1262055681,1262055681);
    $string = date("Y-m-d H:i:s",$int);
    return $string;




  }

}

 ?>
