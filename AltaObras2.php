<?php
	include'conexion.php';
	$t_obra = $_GET['nombre'];

	$resultado=mysqli_query($con,"INSERT INTO t_obra(nombre) VALUES('$t_obra');");

	echo $t_obra;
?>