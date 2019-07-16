<?php
	class DataBase {
		private static $conexion=null;
		private function __construct(){}


		public static function conectar(){
			$pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
			self::$conexion=new PDO(
			'mysql:host=127.0.0.1;dbname=mundo_mascotas;port=3306',
			'admin',
			'3678698o'
			);

			return self::$conexion;
		}
	}
?>
