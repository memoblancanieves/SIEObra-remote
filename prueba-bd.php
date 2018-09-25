<?php
	include 'conexion.php';

	$resultado=mysqli_query($con,"INSERT INTO usuarios (Nombre, A_Paterno, A_Materno) VALUES ('prueba','prueba','prueba')");

	echo "Resultado: ".$resultado;
?>