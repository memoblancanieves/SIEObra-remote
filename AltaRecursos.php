<?php
	include'conexion.php';
	$t_recurso = $_GET['nombre'];

	$resultado=mysqli_query($con,"INSERT INTO t_recursos(nombre) VALUES('$t_recurso');");

	echo $t_recurso;
?>