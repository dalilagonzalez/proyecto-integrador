

<?php
require ('dondeVivo.php');
require ('function.php');
require ('src/Entities/User.php');
//require ('src/Entities/ImgUpload.php');
require ('src/Validators/UserValid.php');
$errors = [];
$value = '';
$msn = '';
$recordDB ='';
$xPath = '/var/www/html/proyecto/upload/';
$dsn='mysql:host=localhost;dbname=mundo_mascotas';
$userdb='admin';
$passdb='3678698o';

if (!empty($_POST)){
$validator = new UserValidator($_POST);
$validator->validate();

if ($validator->isValid()){

    try {

      $ext= pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
      $hashedName = md5(($_FILES['avatar']['name'])). '.' . $ext;
      $final_path = $xPath . $hashedName;
      move_uploaded_file($_FILES['avatar']['tmp_name'],$final_path);
  //  $pdo = get_connection();
  $user = new User;
  $user->setName($_POST['name']);
  $user->setLastName($_POST['lastName']);
  $user->setEmail($_POST['email']);
  $user->setDni($_POST['dni']);
  $user->setPassword($_POST['passwd']);
  $user->setAddress($_POST['address']);
  $user->setBarrio($_POST['barrio']);
  $user->setImage($final_path);
  $user->setPhone($_POST['phone']);
  $user->registrationDate();



  $pdo = new PDO($dsn,$userdb,$passdb);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if ($pdo){

    $email=$_POST['email'];
    $query = "SELECT COUNT(*) FROM users WHERE  email = '$email'";
    $resultado = $pdo->query($query);
    if ($resultado->fetchColumn() > 0) {
    $errors['duplicado'][] = "Lo sentimos. $email ya se encuentra registrado. Inténtelo de nuevo con una dirección de correo diferente.";
    }
    $dni=$_POST['dni'];
    $query = "SELECT COUNT(*) FROM users WHERE  dni = '$dni'";
    $resultado = $pdo->query($query);
    if ($resultado->fetchColumn() > 0) {
    $errors['duplicado'][] = "Lo sentimos. El DNI número $dni ya se encuentra registrado. Inténtelo de nuevo con una dirección de correo diferente.";
    }
    $phone=$_POST['phone'];
    $query = "SELECT COUNT(*) FROM users WHERE phone = '$phone'";
    $resultado = $pdo->query($query);
    if ($resultado->fetchColumn() > 0) {
    $errors['duplicado'][] = "Lo sentimos. El número de teléfono $phone ya se encuentra registrado. Inténtelo de nuevo con una dirección de correo diferente.";
    }
    else {

      $sql = "INSERT INTO users (id, name, lastname, email, dni, passwd, address, barrio, image, phone, created_at)
      VALUES (null, :name, :lastname, :email, :dni, :passwd, :address, :barrio, :image, :phone, :created_at)";

      $stmt = $pdo->prepare($sql);
    //  $stmt->bindValue(':id',$user->getId());
      $stmt->bindValue(':name',$user->getName());
      $stmt->bindValue(':lastname',$user->getLastName());
      $stmt->bindValue(':email',$user->getEmail());
      $stmt->bindValue(':dni',$user->getDni());
      $stmt->bindValue(':passwd',$user->getPassword());
      $stmt->bindValue(':address', $user->getAddress());
      $stmt->bindValue(':barrio',$user->getBarrio());
      $stmt->bindValue(':image', $user->getImage());
      $stmt->bindValue(':phone', $user->getPhone());
      $stmt->bindValue(':created_at',$user->registrationDate());
    // var_dump($user);
     //var_dump($stmt->bindValue(':name',$user->getName()));

      if ($stmt->execute()){
         $recordDB = 'Registro Exitoso';
      } else {
        $errors['registro'][] = 'El registro no pudo ser guardado.';
      }
      }

      }

      } catch (Exception $e){
        die('No hay conexión con la base de datos');
        echo $e->getMessage();
      }

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
              <p class="err"><?php if (isset($validator)){echo $validator->getError('name'); }?></p>

            </div>
              <div class="col-md-4 mb-3">
              <label for="lastName">Apellido</label>
              <input type="text" name="lastName" class="form-control" id="lastName" placeholder="" value="<?= $_POST['lastName'] ?? ''?>">
                 <p class="err"><?php if (isset($validator)){echo $validator->getError('lastName'); }?></p>
            </div>

              <div class="col-md-4 mb-3">
              <label for="dni">DNI</label>
              <input type="text" name="dni" class="form-control" id="dni" placeholder="" value="<?= $_POST['dni'] ?? ''?>">
                <p class="err"><?php if (isset($validator)){echo $validator->getError('dni'); }?></p>
              </div>
          </div>

            <div class="row">
             <div class="col-md-4 mb-3">
            <label for="email">Correo Electrónico </label>
            <input type="text" name="email" class="form-control" id="email" placeholder="" value="<?= $_POST['email'] ?? ''?>">
                <p class="err"><?php if (isset($validator)){echo $validator->getError('email'); }?></p>
            </div>

            <div class="col-md-4 mb-3">
            <label for="password">Contraseña</label>
              <input type="password" name="passwd" class="form-control" id="password" placeholder="" value="">
               <p class="err"><?php if (isset($validator)){echo $validator->getError('passwd'); }?></p>
            </div>

            <div class="col-md-4 mb-3">
            <label for="confirmPass">Confirme la contraseña</label>
              <input type="password" name="confirmPass" class="form-control" id="passwordC" placeholder="" value="">
                   <p class="err"><?php if (isset($validator)){echo $validator->getError('passwd'); }?></p>
              </div>
            </div>

          <div class="row">
            <div class="col -md-4 mb-3">
             <label for="address">Dirección</label>
              <input type="text" name="address" class="form-control" id="address" placeholder="" value="<?= $_POST['address'] ?? ''?>">
                  <p class="err"><?php if (isset($validator)){echo $validator->getError('address'); }?></p>
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
                <p class="err"><?php if (isset($validator)){echo $validator->getError('barrio'); }?></p>
            </div>

            <div class="col-md-4 mb-4">
              <label for="avatar">Imagen de Perfil</label>
             <input type="file" name="avatar" value="">
               <p class="err"><?php if (isset($validator)){echo $validator->getError('avatar'); }?></p>
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
