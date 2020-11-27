<?php 
	class crud{
		public function agregar($datos){
			$obj = new conectar();
			$conexion = $obj->conexion();

			$sql="INSERT INTO t_celulares(nombre,anio,empresa) VALUES('$datos[0]','$datos[1]','$datos[2]')";

			return mysqli_query($conexion,$sql);
		}

		public function obtenerDatos($idcelular){
			$obj = new conectar();
			$conexion = $obj->conexion();

			$sql="SELECT * FROM t_celulares WHERE id_celular='$idcelular'";
			$result = mysqli_query($conexion,$sql);
			$ver = mysqli_fetch_row($result);
			$datos= array('id_celular' =>$ver[0],
						  'nombre' =>$ver[1],
						  'anio' =>$ver[2],
						  'empresa' =>$ver[3]);
			return $datos;
		}

		public function actualizarDatos($datos){
			$obj = new conectar();
			$conexion = $obj->conexion();

			$sql ="UPDATE t_celulares SET 
			nombre='$datos[1]',
			anio='$datos[2]',
			empresa='$datos[3]'
			WHERE id_celular ='$datos[0]' ";

			return mysqli_query($conexion,$sql);
		}

		public function eliminarDatos($idcelular){
			$obj = new conectar();
			$conexion = $obj->conexion();
			
			$sql = "DELETE FROM t_celulares WHERE id_celular='$idcelular'";
			return mysqli_query($conexion,$sql);	
		}
	}
?>