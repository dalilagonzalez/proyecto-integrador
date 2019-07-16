<?php

require_once('src/Entities/AccessUser.php');
require_once('src/Entities/conexion.php');
require_once('src/Entities/User.php');

$user = new AccUser;
$user -> obtenerUsuario('jose@admin.com', '123456');



echo $user->getEmail();





 ?>
