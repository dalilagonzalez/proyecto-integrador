<?php

session_start();

// creo el array de errores vacio
$errorArray=[];

if(!empty($_POST)){
  // si no esta vacio el campo email Y si no esta vacio el campo password
  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $dataJson = file_get_contents("usuarios.json");

    $arrayUsuarios = json_decode($dataJson,true);

    foreach($arrayUsuarios as $usuarios){
          if($usuarios["email"]===$_POST["email"] && password_verify($_POST["password"], $usuarios["password"])) {
            $_SESSION["email"] = $usuario["email"];
            setcookie("login_usuario",$usuario["email"],time()+60*60*24);
            header('location:index.php');
            }
          }
    }
  }
?>

<!DOCTYPE html>
<html lang="sp" dir="ltr">
<head>
  <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" href="css/login.css">
      <title>pLogin</title>

</head>
  <body>
    <?php
      include ("header.php");
    ?>
      <div class="container col-10 col-md-6 col-lg-4">
          <form method="POST" action="login.php">
            <div class="form-group">
              <label class="exampleInput" for="exampleInputEmail1">Dirección Email</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" >
              <p><?= $errorArray['email'] ?? '' ?></p>
            </div>
            <div class="form-group">
              <label class="exampleInput" for="exampleInputPassword1">Contraseña</label>
              <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <button type="submit" class="btn btn-sm btn-primary">Enviar</button>
          </form>
      </div>
      <div class="not-login">
          <div class="container-buttons">
            <button type="submit" class="btn btn-sm btn-secondary">Registrate</button>
            <button type="submit" class="btn btn-sm btn-secondary">olvidé mi contraseña</button>
        </div>
      </div>
    <?php
      include ("footer.php");
    ?>
  </body>
</html>
