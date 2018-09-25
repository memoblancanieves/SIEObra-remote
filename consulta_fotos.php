<?php
	include'conexion.php';
	$id=$_POST['id'];
	$jsondata    = array();
	$i=0;

	//CONSULTA A LA TABLA imagenes_reporte
	$resultado=mysqli_query($con,"SELECT * FROM imagenes_reporte WHERE IdReportes=".$id);

	if(mysqli_num_rows($resultado)>0)
	{
		foreach ($resultado as $fila) 
		{
			$jsondata[$i] = $fila['imagen'];
			$i=$i+1;
		}
	}
	else
	{
		$jsondata[$i] ="No se econtraron imagenes";
	}

	echo json_encode($jsondata);
	exit();	
?>