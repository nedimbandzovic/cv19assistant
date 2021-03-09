<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
<?php
echo ("<h1>Mini Calculator</h1>");
echo ("<p> Addition </p>");
?>

<form action="index.php" method="get">
  <input type="number" name="num1">
  <br>
  <input type="number" name="num2">
  <br>
  <input type="submit">
</form>

SUM: <?php
$number1= $_GET["num1"];
$number2= $_GET["num2"];
$number3=$number1+$number2;
echo("$number3");

 ?>

 <hr>

 <?php echo ("<p>Subtraction</p>"); ?>


 <form action="index.php" method="get">
   <input type="number" name="num3">
   <br>
   <input type="number" name="num4">
   <br>
   <input type="submit">
</form>

SUBTRACTION: <?php
$number4=$_GET["num3"];
$number5=$_GET["num4"];
$number6=$number4-$number5;

echo("$number6");
 ?>

<hr>

<?php echo ("<p> Multiplication </p>"); ?>

<form action="index.php" method="get">
  <input type="number" name="br1">
  <br>
  <input type="number" name="br2">
  <br>
  <input type="submit">
</form>

MULTIPLICATION: <?php

$broj1=$_GET["br1"];
$broj2=$_GET["br2"];
$broj3=$broj1*$broj2;
echo ("$broj3");



 ?>
 <hr>

<?php echo ("<p> Division </p>"); ?>

<form action="index.php" method="get">
  <input type="number" name="brO1">
  <br>
  <input type="number" name="brO2">
  <br>
  <input type="submit">
</form>

DIVISION: <?php
$bre1=$_GET["brO1"];
$bre2=$_GET["brO2"];
$bre3=$bre1/$bre2;
echo ("$bre3");
?>


  </body>
</html>
