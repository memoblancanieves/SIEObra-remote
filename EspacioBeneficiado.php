<?php
	include'conexion.php';

	//OBTENEMOS LOS DATOS DEL FORMULARIO
	$nombre   =  $_POST['nombre'];
	$grado    =  $_POST['grado'];

	//INSERTAMOS LOS DATOS AL FORMULARIO
	$resultado=mysqli_query($con,"INSERT INTO EspacioBeneficiado(Nombre, Grado) VALUES('$nombre', '$grado')");

	echo $resultado;
?>