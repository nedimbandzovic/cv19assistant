<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Coronavirus Assistant - BiH</title>
  </head>
  <body>
<?php
echo ("<h1>Dummy program</h1> <br>");
echo("Enter your password");
 ?>
 <br>
 <form action="index.php" method="post">
  Password: <input type="password" name="password">
   <br>
   <input type="submit">


<?php

echo $_POST("password"); ?>

  </body>
</html>
