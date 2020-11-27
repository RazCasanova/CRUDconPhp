<?php 
	require_once "../clases/conexion.php";
	require_once "../clases/crud.php";

	$obj = new crud();

	$datos = array(
		$_POST['idcelular'],
		$_POST['nombreU'],
		$_POST['anioU'],
		$_POST['empresaU']
	);

	echo $obj->actualizarDatos($datos);
?>