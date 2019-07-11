<?php

function get_connection() {
//  try {
    $pdo = new PDO('mysql:host=localhost;dbname=mundo_mascotas','admin','3678698o');

  //}catch(Exception $e){
    //return false;
  //}

}

   function validaRequerido($valor){
     if(trim($valor) == ''){
     return false;
     }else{
      return true;
      }
    }


    function is_email($txt){
      return filter_var($txt, FILTER_VALIDATE_EMAIL);
    }

    Function muestraErrores($err){
      foreach ($err as $error):
    foreach($error as $value):

    endforeach;
     endforeach;
    }

    function subir_fichero($directorio_destino, $nombre_fichero){

          $ext= pathinfo($_FILES[$nombre_fichero]['name'], PATHINFO_EXTENSION);
          $hashedName = md5(($_FILES[$nombre_fichero]['name'])). '.' . $ext;

          $final_path = $directorio_destino . $hashedName;

          move_uploaded_file($_FILES[$nombre_fichero]['tmp_name'],$final_path);

        }






 ?>
