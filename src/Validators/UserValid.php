<?php

class UserValidator
{
      //LO que voy a validar
      private $user;
      private $errors = [];
      private $archive;

      public function __construct(array $data)
      {
        $this->user = $data;
      }

      public function validate()
      {
        if (trim($this->user['name']) == '') {
           $this->errors ['name'] [] = 'Debe ingresar un nombre';
             }
        if (is_numeric($this->user['name'])) {
           $this->errors ['name'] [] = 'No se permite ingresar valores numericos para el nombre';
             }
        if (trim($this->user['lastName']) == '') {
            $this->errors ['lastName'] [] = 'Debe ingresar un apellido';
             }
        if (is_numeric($this->user['lastName'])) {
            $this->errors ['lastName'] [] = 'No se permite ingresar valores numericos para el apellido';
             }
        if (!filter_var($this->user['email'], FILTER_VALIDATE_EMAIL)){
            $this->errors ['email'] [] = 'Debe ingresar un e-mail válido';
             }
        if (trim($this->user['dni'])== '') {
            $this->errors ['dni'] [] = 'Debe ingresar numero de DNI';
             }
        if (!is_numeric($this->user['dni'])) {
            $this->errors ['dni'] [] = 'Ingrese solo valores numéricos para el DNI';
             }
        if (trim($this->user['passwd']) == '') {
            $this->errors ['passwd'] [] = 'Debe ingresar y confirmar una contraseña';
             }
        if (strlen($this->user['passwd']) > 1 && strlen($this->user['passwd']) < 6) {
            $this->errors ['passwd'] [] = 'La contraseña debe tener al menos 6 caracteres';
             }
        if (trim($this->user['confirmPass']) == '') {
            $this->errors ['passwd'] [] = 'Debe ingresar y confirmar la contraseña';
             }
        if ($this->user['confirmPass'] != $this->user['passwd'] ) {
            $this->errors ['passwd'] [] = 'Las contraseñas deben coincidir"';
             }
        if (trim($this->user['address']) == '') {
            $this->errors ['address'] [] = 'Debe introducir un domicilio';
             }
        if (trim($this->user['barrio']) == '') {
               $this->errors ['barrio'] [] = 'Debe seleccionar el barrio donde vive';
             }
        /*  if($_FILES['avatar']['error'] != 0){
               $errors ['avatar'] [] = 'Hubo un error al cargar la imagen';
             }
             $ext= pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
             if ($ext != 'jpg' && $ext != 'jpeg' && $ext != 'png'){
               $errors ['avatar'] [] = 'La imagen debe ser jpg, jpeg o png';
             } */
        }


      public function getErrors()
      {
        return $this->errors;
      }

      public function getError($field)
      {
        return $this->errors[$field][0] ?? '';
      }

      public function isValid()
      {
        return empty($this->errors);
      }
}




 ?>
