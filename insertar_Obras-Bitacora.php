<?php
	/*
		Para dar de alta una nueva obra se tiene que insertar en la tabla "altas_obras_bitacora" ya se tiene el id de la tabla de alta_obras

		Ultima Autolizacion 20/septiembre/2018
	*/

	include'conexion.php';

	$id_alta     =$_POST['id_altas'];
	$id_bitacora =$_POST['id_bitacora'];

	//Eliminar si es que tiene un dato ya.
	$resultado=mysqli_query($con, "DELETE FROM altas_obras_bitacora WHERE ID_alta=".$id_alta);
	$jsondata['eliminacion_altas_obras_bitacora']=$resultado;

	/* Se agreo una validacion para saber si el usuario ingreso algo tipo de recurso si no ingreso ninguno 
	   se deja vacio la lista de recursos
	*/
	if($_POST['id_bitacora']>0)
	{
		$resultado=mysqli_query($con,"INSERT INTO altas_obras_bitacora(ID_alta, ID_bitacora) VALUES($id_alta,$id_bitacora)");
		$jsondata['insertar_altas_obras_bitacora']=$resultado;

	}
	else
	{
		$jsondata['insertar_altas_obras_bitacora']="No se selecciono ningun tipo de Bitacora";
	}
	

	echo json_encode($jsondata);
	exit();

?>