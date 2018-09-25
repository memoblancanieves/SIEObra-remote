<?php
	include 'conexion.php';
	$id = $_POST['id'];
	$jsondata = array();

	$resultado=mysqli_query($con,"SELECT * FROM altas_obras WHERE ID=".$id);

	if(mysqli_num_rows($resultado)>0)
	{
		foreach ($resultado as $fila) 
		{
			$jsondata['nombre']       = $fila["Nombre"];
			$jsondata['FechaInicio']  = $fila["FechaInicio"];
			$jsondata['FechaTermino'] = $fila["FechaTermino"];	
		}
	}
	else
	{
		$jsondata['nombre']       = "No se encontro informacion.";
		$jsondata['FechaInicio']  = "No se encontro informacion.";
		$jsondata['FechaTermino'] = "No se encontro informacion.";
	}
	
	mysqli_close($con);
	echo json_encode($jsondata);
	exit();
?>