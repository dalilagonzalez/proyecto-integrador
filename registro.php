<?php
$errors = [];
//$value = '';
 var_dump($_POST);
 var_dump($errors);

  if (!empty($_POST)){
    if (empty($_POST['nombre'])) {
      $errors ['nombre'] = ['Debe ingresar un nombre'] ;
    }
    
    else {
    $usuario = [
    'nombre' => $_POST['nombre'],
    'apellido' => $_POST['apellido'],
    'email' => $_POST['email'],
    ];
    $json = json_encode([$usuario], JSON_PRETTY_PRINT);
 //var_dump($json);

    if (file_exists('usuarios.json')) {
    $data = file_get_contents('usuarios.json');

    $json = json_decode($data, true);

    $json[] = $usuario;

    $json = json_encode($usuario, JSON_PRETTY_PRINT);
    }

    file_put_contents('usuarios.json', $json);
    }

      //header ("location:datRegistro.php");exit;
}
?>

<?php foreach ($errors as $error) {
  foreach ($error as $value) {
}
}
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
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
          <link rel="stylesheet" href="css/normalize.css?<?= rand(99999999,9999)?>">
      <link rel="stylesheet" href="css/registro.css?<?= rand(99999999,9999)?>">

        <title>pRegistro</title>

  </head>
    <body class="">
      <?php
        include ("header.php");
      ?>

      <div class="container">
    <div class="py-5 text-center">

      <h2>Formulario de Registro</h2>
      <p class="lead">Complete por favor todos los campos para realizar su registro.</p>
    </div>


      <div class="col-md-12 order-md-1">
        <h4 class="mb-3">Datos Personales</h4>
        <form class="needs-validation" action="registro.php" method="post">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="firstName">Nombre</label>
              <input type="text" name="nombre" class="form-control" id="firstName" placeholder="Nombre" value="">
              <p><?=$value?></p>

            </div>
            <div class="col-md-6 mb-3">
              <label for="lastName">Apellido</label>
              <input type="text" name="apellido" class="form-control" id="lastName" placeholder="Apellido" value="">
              <div class="invalid-feedback">
                <p><?=$value?></p>
                Este campo es oblgatorio.
              </div>
            </div>
          </div>

            <div class="row">
             <div class="col-md-6 mb-3">
            <label for="email">Correo Electrónico </label>
            <input type="text" name="email" class="form-control" id="email" placeholder="tumail@tudominio.com">
            <div class="invalid-feedback">
              Por favor ingrese una dirección de correo válida.
            </div>
          </div>

          <div class="col-md-6 mb-3">
            <label for="username">Nombre de Usuario</label>
              <input type="text" name="usuario" class="form-control" id="username" placeholder="Usuario" value="">
              <div class="invalid-feedback" style="">
                Debe asignar un nombre de usuario.
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
            <label for="password">Contraseña</label>
              <input type="text" name="contraseña" class="form-control" id="password" placeholder="" value="">
              <div class="invalid-feedback" style="">
                  Debe asignar una contraseña.
                </div>
              </div>

            <div class="col-md-6 mb-3">
            <label for="passwordC">Confirme la contraseña</label>
              <input type="text" name="contraseñaC" class="form-control" id="passwordC" placeholder="" value="">
              <div class="invalid-feedback" style="">
                  Debe confirmar la contraseña.
                  </div>
                </div>
            </div>

          <div class="mb-3">
            <label for="address">Dirección</label>
            <input type="text" name="direccion" class="form-control" id="address" placeholder="Mi calle 1234">
            <div class="invalid-feedback">
              Por favor ingrese una dirección válida.
            </div>
          </div>

          <div class="row">
            <div class="col-md-5 mb-3">
              <label for="prov">Provincia</label>
              <select class="custom-select d-block w-100" id="prov" name="provincia">
                <option value="">Seleccione...</option>
                <option>C.A.B.A.</option>
                <option>Provincia de Buenos Aires</option>
                <option>Santa Fe</option>
              </select>
              <div class="invalid-feedback">
                Por favor seleccione una provincia.
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <label for="sector">Barrio</label>
              <select class="custom-select d-block w-100" id="sector" name="barrio">
                <option value="">Seleccione...</option>
                <option>Palermo</option>
                <option>Almagro</option>
                <option>Caballito</option>
              </select>
              <div class="invalid-feedback">
                Por favor seleccione un barrio.
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="zip">Cod. Postal</label>
              <input type="text" class="form-control" name="zip" id="zip" placeholder="">
              <div class="invalid-feedback">
                Zip requerido.
              </div>
            </div>
          </div>


           <br>
          <h4 class="mb-3">Datos de su mascota</h4>
            <p class="lead">Sexo.</p>
          <div class="d-block my-3">
            <div class="custom-control custom-radio">
              <input id="sex" name="sexo" type="radio" class="custom-control-input">
              <label class="custom-control-label" for="sex">Hembra</label>
            </div>
            <div class="custom-control custom-radio">
              <input id="sexm" name="sexo" type="radio" class="custom-control-input">
              <label class="custom-control-label" for="sexm">Macho</label>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="a-name">Nombre</label>
              <input type="text" class="form-control" name="nombrePet" id="a-name" placeholder="">

              <div class="invalid-feedback">
                Debe ingresar un nombre
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="a-name">Clase</label>
              <select class="custom-select d-block w-100" name="clasePet" id="a-name">
                <option value="">Seleccione...</option>
                <option>Perro</option>
                <option>Gato</option>
                <option>Conejo</option>
              </select>

              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="dateB">Fecha de Nacimiento</label>
              <input type="date" class="form-control" name="nacimiento" id="dateB" placeholder="">
              <div class="invalid-feedback">
                Elija una fecha valida
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="age">Edad</label>
              <input type="text" class="form-control" name="edadPet" id="age" placeholder="">
              <div class="invalid-feedback">
                Seleccione un valor válido
              </div>
            </div>
          </div>

          <hr class="mb-4">
          <button class="btn btn-primary btn-lg btn-block" type="submit">REGISTRARSE</button>
        </form>
      </div>
    </div>
  <?php
  include ("footer.php");
  ?>

  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
          <script src="form-validation.js"></script></body>
  </html>
