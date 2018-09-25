<?php
	include'conexion.php';
	$id=26;
	$NoReporte=1;
	$resultado=mysqli_query($con,"SELECT * FROM reportes WHERE  IdObra={$id} AND NoReporte = {$NoReporte}");

	print_r($resultado);
?>