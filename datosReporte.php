<?php
	//PARA OBTENER:
	//-Numero de reporte
	//-Nombre de la obra
	include'conexion.php';
	$jsondata    = array();

	$resultado=mysqli_query($con,"SELECT * FROM reportes WHERE IdObra =".$_POST['id']);

	if(mysqli_num_rows($resultado)>0)
	{
		foreach ($resultado as  $fila) 
		{
			$jsondata['No'] = $fila['NoReporte'];
		}
		
	}
	else
	{
		$jsondata['No'] = 0; //Es el primer reporte que se va hacer	
	}

	$resultado=mysqli_query($con,"SELECT ID,Nombre,id_estadoObra FROM altas_obras WHERE ID =".$_POST['id']);
	if(mysqli_num_rows($resultado)>0)
	{
		foreach ($resultado as $fila) 
		{
			//Nombre de la obra
			$jsondata['Nombre']       = $fila['Nombre'];

			//Estado de la obra
				//Por adjudicar
				//En proceso
				//Suspendida 
				//Concluida sin equipamiento 
				//Concluida con equipamiento 
				if($fila['id_estadoObra'] == null)
				{
					$fila['id_estadoObra']=0;
				}

				$jsondata['idEstadoObra'] = $fila['id_estadoObra'];

				$aux_res=mysqli_query($con,"SELECT nombre FROM estadoObra WHERE id =".$fila['id_estadoObra']);
				if(mysqli_num_rows($aux_res)>0)
				{
					foreach ($aux_res as $fila_aux) 
					{
						$jsondata['estadoObra']       = $fila_aux['nombre'];
					}
				}
				else
				{
					$jsondata['estadoObra']       = "No se encontro en BD";
				}

					$resultado3=mysqli_query($con,"SELECT s_uaemexaltaobras.S_UAEMexID, supervisoruaemex.Nombre 
						FROM s_uaemexaltaobras 
						INNER JOIN supervisoruaemex ON s_uaemexaltaobras.S_UAEMexID =supervisoruaemex.ID 
						WHERE AltaObrasID=".$fila["ID"]);

					if(mysqli_num_rows($resultado3)>0)
					{

						foreach ($resultado3 as $fila3) 
						{
						 	$jsondata['Supervisor']=$fila3["Nombre"];
						}

					}
					else
					{
						$jsondata['Supervisor']       = "No se encontro";
					}	
					 
		}

	}
	else
	{
		$jsondata['Nombre']       = "No se encontro";
	}

	echo json_encode($jsondata);
	exit();	
?>