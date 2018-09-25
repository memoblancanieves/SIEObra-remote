<?php
	//include'conexion.php';
	//$id=$_GET['id'];
	$jsondata    = array();

	//OBTENEMOS EL NUMERO DE CONTRATO PARA POSTERIOR MENTE CON ESE NUMERO COMPROBAR SI EXISTE LA CARPETA
	$resultado=mysqli_query($con,"SELECT * FROM altas_obras WHERE ID =".$id);

	if(mysqli_num_rows($resultado)>0)
	{
		foreach ($resultado as $fila) 
		{
			$jsondata['NoContrato']   = $fila['NoContrato'];
		}

		//Consultamos las carpetas para encontrar
		//  -Prologas en pdf
		$resultado=mysqli_query($con,"SELECT * FROM prologas WHERE ID_Obra =".$id);
		$NoSemana=0;
		foreach ($resultado as $fila) 
		{
			$NoSemana=$NoSemana+1;
			//VERIFICAMOS QUE EXISTA prologa.pdf
			$archivo_estadoCuenta = $fila['contrato'];
			if(file_exists($archivo_estadoCuenta))
			{
				$jsondata[$NoSemana]["estadoCuenta"]=$archivo_estadoCuenta;
			}
			else
			{
				$jsondata[$NoSemana]["estadoCuenta"]="No se tiene registro";
			}
	
		}
	}
	else
	{
		$jsondata['NoContrato']   = "No se econtro el ID ";
	}
	json_encode($jsondata);
?>