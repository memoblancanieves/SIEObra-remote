<?php
	include"conexion.php";
	$id     = $_GET['id'];
	$nombre = $_GET['nombre'];

	$resultado=mysqli_query($con,"UPDATE t_obra SET nombre='$nombre' WHERE id=$id");

	echo $resultado;
?>