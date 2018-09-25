<?php
	include'conexion.php';

	$id_alta     =$_GET['id_altas'];
	$id_bitacora =$_GET['id_bitacora'];
	$jsondata    = array();

	$jsondata['success']  = true;
    $jsondata['obra']     = $_GET['tipo_o'];
    $jsondata['recurso']  = $_GET['tipo_r'];

	//INSERTAMOS EN LA TABLA altas_obras_bitacora
	$resultado=mysqli_query($con, "DELETE FROM altas_obras_bitacora WHERE ID_alta=$id_alta");
	$jsondata['eliminacion_altas_obras_bitacora']=$resultado;

	$resultado=mysqli_query($con,"INSERT INTO altas_obras_bitacora(ID_alta, ID_bitacora) VALUES($id_alta,$id_bitacora)");
	$jsondata['insertar_altas_obras_bitacora']=$resultado;

	//TIPO DE OBRA
	//INSERTAMOS EN LA TABLA altas_obrast_obras
	$resultado=mysqli_query($con, "DELETE FROM altas_obrast_obras WHERE ID_alta=$id_alta");
	$jsondata['eliminacion_altas_obrast_obras']=$resultado;
	for($i=0; $i < count($_GET['tipo_o']); $i++)
	{
		$valor=$_GET['tipo_o'][$i];
		$resultado=mysqli_query($con, "INSERT INTO altas_obrast_obras(ID_alta, ID_Obras) VALUES($id_alta,$valor)");	
	}
	$jsondata['insertar_altas_obrast_obras']=$resultado; 


	//TIPO DE RECURSO
	//INSERTAMOS EN LA TABLA altas_obrast_recurso	
	$resultado=mysqli_query($con, "DELETE FROM altas_obrast_recurso WHERE ID_alta=$id_alta");
	$jsondata['eliminar_altas_obrast_recurso']=$resultado;
	for($i=0; $i < count($_GET['tipo_r']); $i++)
	{
		$valor2=$_GET['tipo_r'][$i];
		$resultado=mysqli_query($con, "INSERT INTO altas_obrast_recurso(ID_alta, ID_Recursos) VALUES($id_alta,$valor2)");	
	} 
	$jsondata['insertar_altas_obrast_recurso']=$resultado;

	header('Content-type: application/json; charset=utf-8');
	echo json_encode($jsondata);
	exit();

	
?>