<?php
	include 'conexion.php';
	$jsondata    = array();

	$jsondata['IDSupervisorUAEMex'] = $_POST['ID'];

	//CONSEGUIR EL NOMBRE DEL SUPERVISOR DE UAEMex
	$resultado=mysqli_query($con, "SELECT * FROM supervisoruaemex WHERE ID=".$jsondata['IDSupervisorUAEMex']);
	foreach ($resultado as $fila) 
	{
		$nombre=$fila['Nombre'];
	}

	$jsondata['NombreUAEMex']=$nombre;

	//CONSEGUIR EL CERTIFICADO DEL SUPERVISOR UAEMex
	$ruta = "SupervisoresUAEMex/".$jsondata['IDSupervisorUAEMex']."/";
	$archivo = $ruta."SupervisorUAEMex.pdf";

	//VERIFICAMOS QUE EXISTA EmpresaContrato.pdf
	if(file_exists($archivo))
	{
		$jsondata['SupervisorUAEMex']=$archivo;
	}
	else
	{
		$jsondata['SupervisorUAEMex']="NO SE ENCONTRO ARCHIVO";
	}

	echo json_encode($jsondata);
	exit();
?>