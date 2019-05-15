<?php


session_start();

if (isset($_GET['value'])){
  if($_GET['value']=="Reiniciar"){
    $_SESSION["contador"] = 0;
  } elseif ($_GET['value'] =="Incrementar") {
   $_SESSION['contador']++;
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Modificar</title>
  </head>
  <body>

    <p><?= $_SESSION['contador'] ?></p>

    <a href="?value=Reiniciar">Reiniciar</a>
    <br>
    <a href="?value=Incrementar">Incrementar</a>





  </body>
</html>
