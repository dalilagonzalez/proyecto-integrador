

<?php
require ('dondeVivo.php');
require ('claseAnimal.php');
$errors = [];
$value = '';
define('MSJ', 'Registro fallido:');
$fechaActual = date('d-m-y');
 //var_dump($_POST);
 //var_dump($provincia);

  if (!empty($_POST)){
    if (empty($_POST['name'])) {
      $errors ['name'] [] = MSJ . ' ' . 'Debe ingresar un nombre';
    }
    if (is_numeric($_POST['name'])) {
      $errors ['name'] [] = MSJ . ' ' . 'No se permite ingresar valores numericos para el nombre';
    }
    if (empty($_POST['apellido'])) {
      $errors ['apellido'] [] = MSJ . ' ' . 'Debe ingresar un apellido';
    }
    if (is_numeric($_POST['apellido'])) {
      $errors ['apellido'] [] = MSJ . ' ' . 'No se permite ingresar valores numericos para el apellido';
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $errors ['email'] [] = MSJ . ' ' . 'Debe ingresar un e-mail válido';
    }
    if (empty($_POST['usuario'])) {
      $errors ['usuario'] [] = MSJ . ' ' . 'Debe ingresar un usuario';
    }
    if (empty($_POST['contrasenia'])) {
      $errors ['contrasenia'] [] = MSJ . ' ' . 'Debe ingresar una contraseña';
    }
    if (strlen($_POST['contrasenia']) < 6) {
      $errors ['contrasenia'] [] = MSJ . ' ' . 'La contraseña debe tener al menos 6 caracteres';
    }
    if (empty($_POST['contrasenia'])) {
      $errors ['contrasenia'] [] = MSJ . ' ' . 'Debe confirmar la contraseña';
    }
    if ($_POST['contraseñaC'] != $_POST['contrasenia'] ) {
      $errors ['contrasenia'] [] = MSJ . ' ' . 'La contraseña confirmada no corresponde a la definida en el cuadro "Contraseña"';
    }
    if (empty($_POST['direccion'])) {
      $errors ['direccion'] [] = MSJ . ' ' . 'Debe introducir un domicilio';
    }
    if (empty($_POST['provincia'])) {
      $errors ['provincia'] [] = MSJ . ' ' . 'Debe elegir alguna opción de la  lista';
    }
    if (empty($_POST['barrio'])) {
      $errors ['barrio'] [] = MSJ . ' ' . 'Debe elegir alguna opción de la lista';
    }
    if (empty($_POST['zip'])) {
      $errors ['zip'] [] = MSJ . ' ' . 'Debe introducir un código postal';
    }
    if (!is_numeric($_POST['zip'])) {
      $errors ['zip'] [] = MSJ . ' ' . 'Debe introducir un código postal válido conformado solo por 4 números';
    }
    if (strlen($_POST['zip']) != 4) {
      $errors ['zip'] [] = MSJ . ' ' . 'El código postal debe estar conformado por 4 números';
    }
    if (!isset($_POST['sexo'])){
      $errors['sexo'] [] = MSJ . ' ' . 'Debe indicar el sexo de su mascota';
    }
    if (empty($_POST['nombrePet'])) {
      $errors ['nombrePet'] [] = MSJ . ' ' . 'Debe ingresar nombre de su mascota';
    }
    if (is_numeric($_POST['nombrePet'])) {
      $errors ['nombrePet'] [] = MSJ . ' ' . 'No se permite ingresar valores numericos para el nombre de su mascota';
    }
    if (empty($_POST['clasePet'])) {
      $errors ['clasePet'] [] = MSJ . ' ' . 'Debe elegir alguna opción de la lista';
    }
    if (empty($_POST['nacimiento'])) {
      $errors ['nacimiento'] [] = MSJ . ' ' . 'Debe suministrar la fecha de nacimiento de su mascota';
    }
    else {
      if (empty($errors)) {
    $usuario = [
    'name' => $_POST['name'],
    'apellido' => $_POST['apellido'],
    'email' => $_POST['email'],
    'usuario' => $_POST['usuario'],
    'contrasenia' => password_hash($_POST['contrasenia'], PASSWORD_DEFAULT),
    'direccion' => $_POST['direccion'],
    'provincia' => $_POST['provincia'],
    'barrio' => $_POST['barrio'],
    'zip' => $_POST['zip'],
    'sexo' => $_POST['sexo'],
    'nombrePet' => $_POST['nombrePet'],
    'clasePet' => $_POST['clasePet'],
    'nacimiento' => $_POST['nacimiento'],
    ];
    //$json = json_encode([$usuario], JSON_PRETTY_PRINT);
 //var_dump($json);

    if (file_exists('usuarios.json')) {
    $data = file_get_contents('usuarios.json');
    $array = json_decode($data, true);

    $array[] = $usuario;

    $json = json_encode($array, JSON_PRETTY_PRINT);

    //var_dump($json);
      file_put_contents('usuarios.json', $json);

    }

    //file_put_contents('usuarios.json', $json);
  }
   }
    }
    //var_dump($errors);//header ("location:datRegistro.php");exit;

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

      <!-- Mostramos errores por HTML -->
        <?php if (!empty($errors)): ?>
          <div class="alert alert-warning alert-dismissible fade show posic" role="alert">
    <strong>Alerta!</strong> Revise los errores a continuación.
            <br>
            <ul class="errores">
            <?php
                foreach ($errors as $error) {
                  foreach ($error as $value) {
                  echo '<li>' . $value . '</li>';
                }
              }
            ?>
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <?php endif; ?>


      <div class="container">
    <div class="py-5 text-center">

      <h2>Formulario de Registro</h2>
      <p class="lead">Complete por favor todos los campos para realizar su registro.</p>
    </div>


      <div class="col-md-12 order-md-1">
        <h4 class="mb-3">Datos Personales</h4>
        <form class="needs-validation" action="registro.php" method="post" enctype="multipart/form-data">

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="firstName">Nombre</label>
              <input type="text" name="name" class="form-control" id="firstName" value="<?= $_POST['name'] ?? ''?>">
              <p></p>
            </div>
              <div class="col-md-6 mb-3">
              <label for="lastName">Apellido</label>
              <input type="text" name="apellido" class="form-control" id="lastName" placeholder="" value="<?= $_POST['apellido'] ?? ''?>">
              <p></p>
            </div>
          </div>

            <div class="row">
             <div class="col-md-6 mb-3">
            <label for="email">Correo Electrónico </label>
            <input type="text" name="email" class="form-control" id="email" placeholder="" value="<?= $_POST['email'] ?? ''?>">
            </div>

          <div class="col-md-6 mb-3">
            <label for="username">Nombre de Usuario</label>
              <input type="text" name="usuario" class="form-control" id="username" placeholder="" value="<?= $_POST['usuario'] ?? ''?>">
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
            <label for="password">Contraseña</label>
              <input type="password" name="contrasenia" class="form-control" id="password" placeholder="" value="">
            </div>

            <div class="col-md-6 mb-3">
            <label for="passwordC">Confirme la contraseña</label>
              <input type="password" name="contraseñaC" class="form-control" id="passwordC" placeholder="" value="">
              </div>
            </div>

          <div class="mb-3">
            <label for="address">Dirección</label>
            <input type="text" name="direccion" class="form-control" id="address" placeholder="" value="<?= $_POST['direccion'] ?? ''?>">
            </div>

          <div class="row">
            <div class="col-md-5 mb-3">
              <label for="prov">Provincia</label>
              <?php if (isset($provincia)): ?>
              <select class="custom-select d-block w-100" id="prov" name="provincia">
                <option value="">Seleccione...</option>
                <?php
                    foreach ($provincia as $valor) {
                    echo '<option>' . $valor . '</option>';
                      }
                    ?>
                    </select>
                <?php endif; ?>
             </div>
            <div class="col-md-4 mb-3">
              <label for="sector">Barrio</label>
              <?php if (isset($barrio)): ?>
              <select class="custom-select d-block w-100" id="sector" name="barrio">
                <option value="">Seleccione...</option>
                <?php
                    foreach ($barrio as $caba) {
                      echo '<option>' . $caba . '</option>';
                      }
                    ?>
                    </select>
                <?php endif; ?>
            </div>
            <div class="col-md-3 mb-3">
              <label for="zip">Cod. Postal</label>
              <input type="text" class="form-control" name="zip" id="zip" placeholder="" value="<?= $_POST['zip'] ?? ''?>">
              <div class="invalid-feedback">
                Zip requerido.
              </div>
            </div>
          </div>

          <div id="avatarregistro" class="col-md-3 mb-3">
            <label for="avatar">Avatar</label>
            <input type="file" name="avatar" value="">

          </div>


           <br>
          <h4 class="mb-3">Datos de su mascota</h4>
            <p class="lead">Sexo.</p>
          <div class="d-block my-3">
            <div class="custom-control custom-radio">
              <input id="sex" name="sexo" type="radio" value="femenino" class="custom-control-input">
              <label class="custom-control-label" for="sex">Hembra</label>
            </div>
            <div class="custom-control custom-radio">
              <input id="sexm" name="sexo" type="radio" value="masculino" class="custom-control-input">
              <label class="custom-control-label" for="sexm">Macho</label>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="a-name">Nombre</label>
              <input type="text" class="form-control" name="nombrePet" id="a-name" placeholder="">

            </div>
            <div class="col-md-4 mb-3">
              <label for="a-name">Clase</label>
                <?php if (isset($clase)): ?>
              <select class="custom-select d-block w-100" name="clasePet" id="a-name">
                <option value="">Seleccione...</option>
                <?php
                    foreach ($clase as $tipo) {
                      echo '<option>' . $tipo . '</option>';
                      }
                    ?>
                    </select>
                <?php endif; ?>

              </div>
              <div class="col-md-4 mb-3">
              <label for="dateB">Fecha de Nacimiento</label>
              <input type="date" class="form-control" name="nacimiento" id="dateB" placeholder="">
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
