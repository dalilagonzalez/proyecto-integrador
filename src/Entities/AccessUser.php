<?php
	require_once('src/Entities/conexion.php');
	require_once('src/Entities/User.php');

	class AccUser extends User{


		public function __construct(){}

		//obtiene el usuario a validar
		public function obtenerUsuario($email, $passwd){
			$db = DataBase::conectar();
			$select = $db->prepare('SELECT email , passwd FROM users WHERE email = $email');
			$select->execute();
			$login = $select->fetch();

			var_dump($login);
			exit;


			if(empty($register->email)){


			}


			// $user=new User();
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
