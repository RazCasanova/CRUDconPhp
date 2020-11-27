<?php 
	
	class conectar{
		public function conexion(){
			$servidor="localhost";
		 	$usuario = "root";
		 	$password ="";
		 	$bd = "celulares";

			$conexion=mysqli_connect($servidor,
									 $usuario,
									 $password,
									 $bd);
			$conexion->set_charset('utf8');
			return $conexion;
		}
	}

?>