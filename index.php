<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Mad Libs Game</title>
  </head>
  <body>

    <?php echo ("<h1> Mad Libs Game </h1>"); ?>



    <form action="index.php" method="get">
      Color: <input type="text" name="color">
      <br>
      Plural noun: <input type="text" name="pluralnoun">
      <br>
      Celebrity: <input type="text" name="celebrity">
      <br>
      <input type="submit">
    </form>
    <br>


<?php
$color=$_GET["color"];
$pluralnoun=$_GET["pluralnoun"];
$celebrity=$_GET["celebrity"];

echo ("Roses are $color <br>");
echo ("$pluralnoun are blue <br>");
echo ("I love you $celebrity <br>");
 ?>

  </body>
</html>
