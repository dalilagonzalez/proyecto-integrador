<?php
require ('dondeVivo.php');
require ('function.php');
require ('src/entities/User.php');
$errors = [];
$value = '';
$msn = '';
$recordDB ='';
define('MSJ', 'Registro fallido:');
$fechaActual = date('d-m-y');
$path = '/var/www/html/proyecto/upload/';
//error_reporting(0);
//var_dump($_POST);
//var_dump($_FILES);

  if (!empty($_POST)){
    if (!validaRequerido($_POST['name'])) {
      $errors ['name'] [] = 'Debe ingresar un nombre';
    }
    if (is_numeric($_POST['name'])) {
      $errors ['name'] [] = 'No se permite ingresar valores numericos para el nombre';
    }
    if (!validaRequerido($_POST['lastName'])) {
      $errors ['lastName'] [] = 'Debe ingresar un apellido';
    }
    if (is_numeric($_POST['lastName'])) {
      $errors ['lastName'] [] = 'No se permite ingresar valores numericos para el apellido';
    }
    if (!is_email($_POST['email'])) {
      $errors ['email'] [] = 'Debe ingresar un e-mail válido';
    }
    if (!validaRequerido($_POST['dni'])) {
      $errors ['dni'] [] = 'Debe ingresar numero de DNI';
    }
    if (!is_numeric($_POST['dni'])) {
      $errors ['dni'] [] = 'Ingrese solo valores numéricos para el DNI';
    }
    if (!validaRequerido($_POST['passwd'])) {
      $errors ['passwd'] [] = 'Debe ingresar y confirmar una contraseña';
    }
    if (strlen($_POST['passwd']) > 1 && strlen($_POST['passwd']) < 6) {
      $errors ['passwd'] [] = 'La contraseña debe tener al menos 6 caracteres';
    }
    if (!validaRequerido($_POST['confirmPass'])) {
      $errors ['passwd'] [] = 'Debe ingresar y confirmar la contraseña';
    }
    if ($_POST['confirmPass'] != $_POST['passwd'] ) {
      $errors ['passwd'] [] = 'Las contraseñas deben coincidir"';
    }
    if (!validaRequerido($_POST['address'])) {
      $errors ['address'] [] = 'Debe introducir un domicilio';
    }
    if (!validaRequerido($_POST['barrio'])) {
      $errors ['barrio'] [] = 'Debe seleccionar el barrio donde vive';
    }
    if($_FILES['avatar']['error'] != 0){
      $errors ['avatar'] [] = 'Hubo un error al cargar la imagen';
    }
    $ext= pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    if ($ext != 'jpg' && $ext != 'jpeg' && $ext != 'png'){
      $errors ['avatar'] [] = 'La imagen debe ser jpg, jpeg o png';
    }

    else {
      if (empty($errors)) {

      $name = $_POST['name'];
      $lastName = $_POST['lastName'];
      $email = $_POST['email'];
      $dni = $_POST['dni'];
      $passwd = password_hash($_POST['passwd'], PASSWORD_DEFAULT);
      $address = $_POST['address'];
      $barrio = $_POST['barrio'];
      $phone = $_POST['phone'];

    $fichero = 'avatar';
    subir_fichero($path, $fichero);
    $hashedName = md5(($_FILES['avatar']['name'])). '.' . $ext;
    $final_path = $path . $hashedName;

  //  error_reporting(0);
    $mysqli = new mysqli("localhost","admin","3678698o","mundo_mascotas");

    if ($mysqli->connect_errno) {
    // Se podría contactar con uno mismo (¿email?), registrar el error, mostrar una bonita página, etc.
    echo "Lo sentimos, este sitio web está experimentando problemas.";
      // de todas formas, es imprimir información relacionada con errores de MySQL -- se podría registrar
    echo "Error: Fallo al conectarse a MySQL debido a: \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";
    // Podría ser conveniente mostrar algo interesante, aunque nosotros simplemente saldremos
    exit;
    }
// Realizar una consulta SQL
$sql = "SELECT * FROM users WHERE email = '$email'";
if (!$resultado = $mysqli->query($sql)) {
    // ¡Oh, no! La consulta falló.
    echo "Lo sentimos, este sitio web está experimentando problemas.";

    // De nuevo, no hacer esto en un sitio público, aunque nosotros mostraremos
    // cómo obtener información del error
    echo "Error: La ejecución de la consulta falló debido a: \n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}

if ($resultado->num_rows != 0) {
    $errors['duplicado'][] = "Lo sentimos. $email ya se encuentra registrado. Inténtelo de nuevo con una dirección de correo diferente.";

   }

   $sql = "SELECT * FROM users WHERE dni = '$dni'";
   if (!$resultado = $mysqli->query($sql)) {

       echo "Lo sentimos, este sitio web está experimentando problemas.";
       echo "Error: La ejecución de la consulta falló debido a: \n";
       echo "Query: " . $sql . "\n";
       echo "Errno: " . $mysqli->errno . "\n";
       echo "Error: " . $mysqli->error . "\n";
       exit;
   }

   if ($resultado->num_rows != 0) {
       $errors['duplicado'][] = "Lo sentimos el DNI $dni ya se encuentra registrado. Inténtelo de nuevo con otro número de DNI.";
      }

    $sql = "SELECT * FROM users WHERE phone = '$phone'";
    if (!$resultado = $mysqli->query($sql)) {

        echo "Lo sentimos, este sitio web está experimentando problemas.";
        echo "Error: La ejecución de la consulta falló debido a: \n";
        echo "Query: " . $sql . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        exit;
    }

    if ($resultado->num_rows != 0) {
        $errors['duplicado'][] = "Lo sentimos el número de teléfono $phone ya se encuentra registrado. Inténtelo de nuevo con un número de teléfono diferente.";
       }
   $resultado->free();
   $mysqli->close();

    try {
  //  $pdo = get_connection();
  $user = new User;
  $user->setName($_POST['name']);
  $user->setLastName($_POST['lastName']);
  $user->setEmail($_POST['email']);
  $user->setDni($_POST['dni']);
  $user->setPassword($_POST['passwd']);
  $user->setAddress($_POST['address']);
  $user->setBarrio($_POST['barrio']);
  $user->setPhone($_POST['phone']);

  $pdo = new PDO('mysql:host=localhost;dbname=mundo_mascotas','admin','3678698o');

  if ($pdo){

      $sql = "INSERT INTO users (id,  name, lastname, email, dni, passwd, address, barrio, image, phone, created_at)
      VALUES (null, :name, :lastname, :email, :dni, :passwd, :address, :barrio, :image, :phone, NOW())";

      $stmt = $pdo->prepare($sql);


      $stmt->bindValue(':name',$name);
      $stmt->bindValue(':lastname', $lastName);
      $stmt->bindValue(':email', $email);
      $stmt->bindValue(':dni',$dni);
      $stmt->bindValue(':passwd', $passwd);
      $stmt->bindValue(':address', $address);
      $stmt->bindValue(':barrio',$barrio);
      $stmt->bindValue(':image', $final_path);
      $stmt->bindValue(':phone', $phone);

      if ($stmt->execute()){
         $recordDB = 'Registro Exitoso';
      } else {
        $errors['registro'][] = 'El registro no pudo ser guardado.';
      }
     //$data = $stmt->fetch(PDO::FETCH_ASSOC);
      }

      } catch (Exception $e){
        die('No hay conexión con la base de datos');
        echo $e->getMessage();
      }

    }
   }
  }
//  var_dump($record);
//  var_dump($errors);//header ("location:datRegistro.php");exit;
  ?>

  <?php
//  var_dump($errors);
    muestraErrores($errors);
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

        <title>Registro</title>

  </head>
    <body class="">
      <?php
        include ("header.php");
      ?>

      <div class="container">
    <div class="py-5 text-center">

      <h2>Formulario de Registro</h2>
      <p class="lead">Complete por favor todos los campos para realizar su registro.</p>
         <p class="err"><?=$errors['registro'][0] ?? ''?></p>
         <p class="err"><?=$errors['duplicado'][0] ?? $recordDB ?></p>
    </div>


      <div class="col-md-12 order-md-1">
        <h4 class="mb-3">Datos Personales</h4>
        <form class="needs-validation" action="registro.php" method="post" enctype="multipart/form-data">

          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="firstName">Nombre</label>
              <input type="text" name="name" class="form-control" id="firstName" value="<?= $_POST['name'] ?? ''?>">
                 <p class="err"><?=$errors['name'][0] ?? '' ?></p>

            </div>
              <div class="col-md-4 mb-3">
              <label for="lastName">Apellido</label>
              <input type="text" name="lastName" class="form-control" id="lastName" placeholder="" value="<?= $_POST['lastName'] ?? ''?>">
                 <p class="err"><?=$errors['lastName'][0] ?? '' ?></p>
            </div>

              <div class="col-md-4 mb-3">
              <label for="dni">DNI</label>
              <input type="text" name="dni" class="form-control" id="dni" placeholder="" value="<?= $_POST['dni'] ?? ''?>">
                <p class="err"><?=$errors['dni'][0] ?? '' ?></p>
              </div>
          </div>

            <div class="row">
             <div class="col-md-4 mb-3">
            <label for="email">Correo Electrónico </label>
            <input type="text" name="email" class="form-control" id="email" placeholder="" value="<?= $_POST['email'] ?? ''?>">
                <p class="err"><?=$errors['email'][0] ?? '' ?></p>
            </div>

            <div class="col-md-4 mb-3">
            <label for="password">Contraseña</label>
              <input type="password" name="passwd" class="form-control" id="password" placeholder="" value="">
               <p class="err"><?=$errors['passwd'][0] ?? '' ?></p>
            </div>

            <div class="col-md-4 mb-3">
            <label for="confirmPass">Confirme la contraseña</label>
              <input type="password" name="confirmPass" class="form-control" id="passwordC" placeholder="" value="">
                   <p class="err"><?=$errors['passwd'][0] ?? '' ?></p>
              </div>
            </div>

          <div class="row">
            <div class="col -md-4 mb-3">
             <label for="address">Dirección</label>
              <input type="text" name="address" class="form-control" id="address" placeholder="" value="<?= $_POST['address'] ?? ''?>">
                  <p class="err"><?=$errors['address'][0] ?? '' ?></p>
            </div>

            <div class="col-md-4 mb-3">
              <label for="sector">Barrio</label>
              <?php if (isset($barrios)): ?>
              <select class="custom-select d-block w-100" id="sector" name="barrio">
                <option value="">Seleccione...</option>
                <?php
                    foreach ($barrios as $caba) {
                      echo '<option>' . $caba . '</option>';
                      }
                    ?>
                    </select>
                <?php endif; ?>
                <p class="err"><?=$errors['barrio'][0] ?? '' ?></p>
            </div>

            <div class="col-md-4 mb-4">
              <label for="avatar">Imagen de Perfil</label>
             <input type="file" name="avatar" value="">
               <p class="err"><?=$errors['avatar'][0] ?? '' ?></p>
            </div>
          </div>

               <div class="row">
               <div class="col-md-4 mb-3">
               <label for="tlf">Teléfono(opcional)</label>
                <input type="tel" name="phone" class="form-control" id="tlf" placeholder="" value="<?= $_POST['phone'] ?? ''?>">
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
