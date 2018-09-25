<?php
	include'conexion.php';

	$id_alta     = $_POST['id_alta'];
	$id_bitacora = $_POST['id_bitacora'];

	$resultado=mysqli_query($con,"INSERT INTO altas_obras_bitacora VALUES($id_alta,$id_bitacora)");

	echo "id_alta: ".$id_alta." id_bitacora: ".$id_bitacora;
?>