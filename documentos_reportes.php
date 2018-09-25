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

		$posicion=0;
		$cadena=$jsondata['NoContrato'];
		do{
			$posicion=strpos($cadena, "/", $posicion+1);
			if($posicion != 0)
			{
				$cadena[$posicion]="-";	
			}
		}while($posicion != false); 

		//RUTA DEL ARCHIVO EJEMPLO $ruta= Archivos/UAEM-SAD-001-2018/
		$ruta = "Archivos/".$cadena."/";

		//Consultamos las carpetas semanales en busqueda del
		//  -Estado de cuenta
		//  -Reporte del supervisor 
		$resultado=mysqli_query($con,"SELECT * FROM reportes WHERE IdObra =".$id);
		$ruta=$ruta."Semana";
		foreach ($resultado as $fila) 
		{
			$NoSemana=$fila['NoReporte'];
			$ruta2=$ruta.$NoSemana."/";
			//VERIFICAMOS QUE EXISTA estadoCuenta.pdf
			$archivo_estadoCuenta = $ruta2."estadoCuenta.pdf";
			if(file_exists($archivo_estadoCuenta))
			{
				$jsondata[$NoSemana]["estadoCuenta"]=$archivo_estadoCuenta;
			}
			else
			{
				$jsondata[$NoSemana]["estadoCuenta"]="No se tiene registro";
			}

			//VERIFICAMOS QUE EXISTA ReporteSupervisor.pdf
			$archivo_ReporteSupervisor = $ruta2."ReporteSupervisor.pdf";
			if(file_exists($archivo_ReporteSupervisor))
			{
				$jsondata[$NoSemana]["ReporteSupervisor"]=$archivo_ReporteSupervisor;
			}
			else
			{
				$jsondata[$NoSemana]["ReporteSupervisor"]="No se tiene registro";
			}
			
		}
	}
	else
	{
		$jsondata['NoContrato']   = "No se econtro el ID ";
	}
	json_encode($jsondata);
?>