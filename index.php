<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Coronavirus Assistant - BiH</title>
  </head>
  <body>

<form action="index.php" method="post">
  <input type="text" name="student">
  <br>
  <input type="submit">
</form>
 <?php

 $grades= array ("Jim"=>"A+", "Pam"=>"B-", "Oscar"=>"C+");
 echo $grades[$_POST["student"]];

  ?>
  

  </body>
</html>
