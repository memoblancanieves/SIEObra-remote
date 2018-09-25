<?php
	include 'conexion.php';

	$noContrato = $_POST['noContrato'];
	$jsondata    = array();

	$resultado=mysqli_query($con, "SELECT Nombre from altas_obras WHERE NoContrato='".$noContrato."'");

	

	if(mysqli_num_rows($resultado) == 0)
	{
		//No se repite el numero de contrato
		$jsondata['resultado']=false;
	}
	else
	{
		//Se repite el numero de contrato
		$jsondata['resultado']=true;
	}

	echo json_encode($jsondata);
?>