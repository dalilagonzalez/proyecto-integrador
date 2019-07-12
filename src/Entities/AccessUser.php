<?php
	require_once('conexion.php');
	require_once('User.php');

	class AccUser{

		public function __construct(){}

		//inserta los datos del usuario
		//public function insertar($usuario){
			//$db=DB::conectar();
			//$insert=$db->prepare('INSERT INTO USUARIOS VALUES(NULL,:nombre, :clave)');
			//$insert->bindValue('nombre',$usuario->getNombre());
			//encripta la clave
			//$pass=password_hash($usuario->getClave(),PASSWORD_DEFAULT);
			//$insert->bindValue('clave',$pass);
			//$insert->execute();
		//}

		//obtiene el usuario para el login
		public function obtenerUsuario($email, $passwd){
			$db=DataBase::conectar();
			$select=$db->prepare('SELECT * FROM users WHERE email=:email');//AND clave=:clave
			$select->bindValue(':email',$email);
			$select->execute();
			$register=$select->fetch();

			$user=new User();
			//verifica si la clave es conrrecta
			if (password_verify($passwd, $register['passwd'])) {
				//si es correcta, asigna los valores que trae desde la base de datos
			  $user->setId($register['id']);
				$user->setEmail($register['email']);
				$user->setPasswd($register['passwd']);
			}
			return $email;
		}

		//busca el nombre del usuario si existe
		/*public function buscarUsuario($nombre){
			$db=Db::conectar();
			$select=$db->prepare('SELECT * FROM USUARIOS WHERE nombre=:nombre');
			$select->bindValue('nombre',$nombre);
			$select->execute();
			$registro=$select->fetch();
			if($registro['Id']!=NULL){
				$usado=False;
			}else{
				$usado=True;
			}
			return $usado;
		}*/
	}
?>
