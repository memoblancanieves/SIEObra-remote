<?php
	include'conexion.php';
	sleep(2);

	//Eliminar caracteres especiales
	$nombre    =  mysqli_real_escape_string($con, $_POST['beneficiado']);
	$direccion =  mysqli_real_escape_string($con, $_POST['direccion']);
	$jsondata    = array();

	//Eliminamos las comillas simples (')
	$nombre = str_replace("\'","",$nombre);
	$direccion = str_replace("\'","",$direccion);

	//Eliminamos las comillas dobles ("")
	$nombre = str_replace('\"',"",$nombre);
	$direccion = str_replace('\"',"",$direccion);


	$resultado=mysqli_query($con,"INSERT INTO espaciobeneficiado(Nombre, Direccion) VALUES('$nombre', '$direccion')");


	$jsondata['nombre']     = $nombre;
	
	
	echo json_encode($jsondata);
	exit();
?>