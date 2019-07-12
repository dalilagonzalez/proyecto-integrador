<?php
require_once('src/Entities/User.php');
require_once('src/Entities/AccessUser.php');
require_once('src/Entities/conexion.php');

session_start();

	$user=new User();
//	$user->setEmail($_POST['email']);
	$access=new AccUser();

var_dump($_POST);

if(!empty($_POST)){
  if (isset($_POST['entrar'])) {
  $user=$access->obtenerUsuario($_POST['email'],$_POST['passwd']);
  // si el id del objeto retornado no es null, quiere decir que encontro un registro en la base

  if ($user = ) {
    $_SESSION['user']=$user; //si el usuario se encuentra, crea la sesión de usuario
    header('Location: cuenta.php'); //envia a la página que simula la cuenta
  }else{
    header('Location: error.php?mensaje=Tus nombre de usuario o clave son incorrectos'); // cuando los datos son incorrectos envia a la página de error
  }
}elseif(isset($_POST['salir'])){ // cuando presiona el botòn salir
  header('Location: index.php');
  unset($_SESSION['user']); //destruye la sesión
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
    <div class="containerLogin">
    <div class=formi>
       <div class="avatar"></div>
  <form class="needs-validation" action="login.php" method="post"

		  <div class=cont-group>
			<div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter email">
      <p><?= $errorArray['email'] ?? '' ?></p>
    </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Contraseña</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="passwd" placeholder="Password">
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Recuerdame</label>
  </div>
  <button type="submit" class="btn btn-info btn-block login" name="entrar" >Enviar</button>
</div>
</div>
</form>
</div>
    <?php
      include ("footer.php");
    ?>
  </body>
</html>
