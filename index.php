<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Calculator</title>
  </head>
  <body>

    <?php echo ("<h1>Calculator</h1>"); ?>
    <br>
    <form action="index.php" method="post">
      First Number: <input type="number" name="num1">
      <br>
      Operator: <input type="text" name="operator">
      <br>
      Second Number: <input type="number" name = "num2">
      <br>
      <input type="submit">
    </form>



    <?php

    function Addition ($broj1, $broj2){
      return $broj1+$broj2;


    }

    function Subtraction ($broj5, $broj6){
      return $broj5-$broj6;
    }

    function Multiplication ($m1, $m2){
      return $m1*$m2;
    }

    function Division ($d1,$d2){
      return $d1/$d2;
    }


     ?>


     <?php

     echo ("RESULT: ");

     if ($_POST["operator"]=="+"){
       $broj1=$_POST["num1"];
       $broj2=$_POST["num2"];
       echo Addition ($broj1, $broj2);
     }
     elseif ($_POST["operator"]=="-"){
       $broj3=$_POST["num1"];
       $broj4=$_POST["num2"];
       echo Subtraction ($broj3, $broj4);
     }
     elseif ($_POST["operator"]=="*"){
       $broj5=$_POST["num1"];
       $broj6=$_POST["num2"];
       echo Multiplication ($broj5, $broj6);
     }
     elseif ($_POST["operator"]=="/"){
       $broj7=$_POST["num1"];
       $broj8=$_POST["num2"];
       echo Division ($broj7, $broj8);
     }



      ?>


  </body>
</html>
