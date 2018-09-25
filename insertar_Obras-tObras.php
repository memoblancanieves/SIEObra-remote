<?php
	/*
		Para dar de alta una nueva obra se tiene que insertar en la tabla "altas_obrast_obras" ya se tiene el id de la tabla de alta_obras

		Ultima Autolizacion 23/agosto/2018
	*/

	include'conexion.php';

	$id_alta           = $_POST['id_altas'];
	$jsondata['obra']  = $_POST['tipo_o'];
	$jsondata    = array();

	
	//TIPO DE OBRA
	//Se Elimina por si ya se tubiera algun dato
	$resultado=mysqli_query($con, "DELETE FROM altas_obrast_obras WHERE ID_alta=$id_alta");
	$jsondata['eliminacion_altas_obrast_obras']=$resultado;

	/* Se agreo una validacion para saber si el usuario ingreso algo tipo de recurso si no ingreso ninguno 
	   se deja vacio la lista de recursos
	*/
	
	if($_POST['tipo_o']>0)
	{
		for($i=0; $i < count($_POST['tipo_o']); $i++)
		{
			$valor=$_POST['tipo_o'][$i];
			$resultado=mysqli_query($con, "INSERT INTO altas_obrast_obras(ID_alta, ID_Obras) VALUES($id_alta,$valor)");	
		}
		$jsondata['insertar_altas_obrast_obras']=$resultado; 
	}
	else
	{
		$jsondata['insertar_altas_obrast_obras']="No se selecciono ningun Tipo de obra"; 
	}
	

	echo json_encode($jsondata);
?>