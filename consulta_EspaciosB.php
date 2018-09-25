<?php
	include'conexion.php';
	$jsondata    = array();
	$contador=0;

	$resultado=mysqli_query($con, "SELECT ID, Nombre from espaciobeneficiado ORDER BY orden2");

	foreach ($resultado as $fila) 
	{	
		$jsondata[$contador] = array("id" => $fila['ID'], "name" => $fila['Nombre']);
		$contador=$contador+1;
	}

	echo json_encode($jsondata);
	//print_r($json);
?>