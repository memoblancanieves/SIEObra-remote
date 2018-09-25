<?php
	/*
		Para dar de alta una nueva obra se tiene que insertar en la tabla "altas_obrast_recurso" ya se tiene el id de la tabla de alta_obras

		Ultima Autolizacion 20/septiembre/2018
	*/
	include'conexion.php';

	$id_alta              = $_POST['id_altas'];
	$jsondata['recurso']  = $_POST['tipo_r'];
	$jsondata    = array();
	

	//TIPO DE RECURSO

	//Eliminamos por si ya se tubiera algun dato	
	$resultado=mysqli_query($con, "DELETE FROM altas_obrast_recurso WHERE ID_alta=$id_alta");
	$jsondata['eliminar_altas_obrast_recurso']=$resultado;


	/* Se agreo una validacion para saber si el usuario ingreso algo tipo de recurso si no ingreso ninguno 
	   se deja vacio la lista de recursos
	*/

	if($_POST['tipo_r']>0)
	{
		for($i=0; $i < count($_POST['tipo_r']); $i++)
		{
			$valor2=$_POST['tipo_r'][$i];
			$resultado=mysqli_query($con, "INSERT INTO altas_obrast_recurso(ID_alta, ID_Recursos) VALUES($id_alta,$valor2)");	
		} 
		$jsondata['altas_obrast_recurso']=$resultado;
	}
	else
	{
		$jsondata['altas_obrast_recurso']="No se selecciono ningun tipo de recurso";
	}

	

	echo json_encode($jsondata);
?>