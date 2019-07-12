<?php
	class DataBase {
		private static $conexion=null;
		private function __construct(){}

		public static function conectar(){
		//	$pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
			self::$conexion=new PDO('mysql:host=localhost;dbname=mundo_mascotas','admin','3678698o');
			return self::$conexion;
		}
	}
?>
