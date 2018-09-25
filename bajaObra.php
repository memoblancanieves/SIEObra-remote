<?php
	include 'conexion.php';
	$id=$_POST["id"];

	$jsondata    = array();
	$x=0;
	//PARA PODER DAR DE BAJA UNA OBRA SE NECESITAN BORRAR 5 TABLAS ANTES

	//altas_obras_bitacora
	$jsondata[$x]="altas_obras_bitacora: ".mysqli_query($con, "DELETE FROM altas_obras_bitacora WHERE ID_alta=".$id);

	//s_uaemexaltaobras
	$x=$x+1;
	$jsondata[$x]="s_uaemexaltaobras: ".mysqli_query($con, "DELETE FROM s_uaemexaltaobras WHERE AltaObrasID=".$id);

	//altas_obrast_recurso
	$x=$x+1;
	$jsondata[$x]="altas_obrast_recurso: ".mysqli_query($con, "DELETE FROM altas_obrast_recurso WHERE ID_alta=".$id);


	//consulta ha reportes para obtener su ID y con eso eliminar en la tabla imagenes_reporte
	$x=$x+1;
	$resultado=mysqli_query($con, "SELECT * FROM reportes WHERE IdObra=".$id);

	if(mysqli_num_rows($resultado)>0)
	{
		foreach ($resultado as $fila) 
		{
			//imagenes_reporte
			$x=$x+1;
			$jsondata[$x]="imagenes_reporte: ".mysqli_query($con, "DELETE FROM imagenes_reporte WHERE IdReportes=".$fila["id"]);
		}

	}
	else
	{
		$jsondata[$x]="reportes: NO SE TIENE reportes de esta obra";		
	}
	

	//reportes
	$x=$x+1;
	$jsondata[$x]="reportes: ".mysqli_query($con, "DELETE FROM reportes WHERE IdObra=".$id);

	//espaciobeneficiado_altaobras
	$x=$x+1;
	$jsondata[$x]="espaciobeneficiado_altaobras: ".mysqli_query($con, "DELETE FROM espaciobeneficiado_altaobras WHERE AltaObrasId=".$id);

	//altas_obrast_obras
	$x=$x+1;
	$jsondata[$x]="altas_obrast_obras: ".mysqli_query($con, "DELETE FROM altas_obrast_obras WHERE ID_alta=".$id);

	//alta_obras
	$x=$x+1;
	$jsondata[$x]="altas_obras: ".mysqli_query($con, "DELETE FROM altas_obras WHERE ID=".$id);

	echo json_encode($jsondata);
	exit();
?>