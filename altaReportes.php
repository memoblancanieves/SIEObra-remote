<?php
	include'conexion.php';
	$jsondata    = array();


	$id             = $_POST['id'];
	$NoReporte      = $_POST['NoReporte'];
	$descripcion    = $_POST['descripcion'];
	$AFisico        = $_POST['AvanceFisico'];
	$AFinanciero    = $_POST['AvanceFinanciero'];
	$estatus        = $_POST['estatus'];
	$fechaInicio    = $_POST['fechaInicio'];
	$fechaTermino   = $_POST['fechaTermino'];
	$observaciones  = $_POST['observaciones'];
	$id_estadoObra  = $_POST['estadoObra'];
	$mensaje     ="";

	
	//SE OBTIENE EL NUMERO DE CONTRATO POR MEDIO DEL ID DE LA OBRA
	$resultado=mysqli_query($con,"SELECT * FROM altas_obras WHERE ID =".$id);
		if(mysqli_num_rows($resultado)>0)
		{
			foreach ($resultado as $fila) 
			{
				$n_contrato    = $fila['NoContrato'];
				echo "Se encontro el numero de contrato:".$n_contrato;
			}

		}
		else
		{
			echo "Error no se encontro el numero ce contrado";
		}

	//ACTUALIZAR EL ESTADO DE LA OBRA
    mysqli_query($con,"UPDATE altas_obras SET estadoObra=".$id_estadoObra." WHERE ID =".$id);
 

	//ARCHIVO: estadoCuenta
	if(isset($_FILES["estadoCuenta"]))
	{
			//REMPLAZAR LOS CARACTERES / POR UN -
			$posicion=0;
			$cadena=$n_contrato;
			do{
				$posicion=strpos($cadena, "/", $posicion+1);
				if($posicion != 0)
				{
					$cadena[$posicion]="-";	
				}
			}while($posicion != false);
			 
			//RUTA DE DONDE SE VA ALMACENAR EL ARCHIVO
			$ruta = "Archivos/".$cadena."/";//CARPETA DEL ID DEL NOMBRE DE LA OBRA

			if(!file_exists($ruta))
			{
				mkdir($ruta);
			}

			$ruta = $ruta."Semana".$NoReporte ."/";//DENTRO DE LA CARPETA DEL ID SE AGREGAN EL REPORTE SEMANAL CON LA ENUMERACION
			
			//VERIFICAMOS QUE SI EXISTE LA CARPETA CON EL NUMERO DE REPORTE 
			if(!file_exists($ruta))
			{
				mkdir($ruta);
			}

			//NOMBRE DEL ARCHIVO
			$archivo = $ruta."estadoCuenta.pdf";

			//VERIFICAMOS SI EXISTE UN ARCHIVO CON EL MISMO NOMBR
			if(!file_exists($archivo))
			{
				$resultado = @move_uploaded_file($_FILES["estadoCuenta"]["tmp_name"], $archivo);

				if($resultado)
				{
					$mensaje=$mensaje." estadoCuenta se guardo con exito";
				}
				else
				{
					$mensaje=$mensaje."No se pudo guardar el archivo";
				}
			}
			else
			{
				$mensaje=$mensaje."El archivo ya existe";
			}
	}
	

	//ARCHIVO: ReporteSupervisor
	if(isset($_FILES["ReporteSupervisor"]))
	{
		//REMPLAZAR LOS CARACTERES / POR UN -
			$posicion=0;
			$cadena=$n_contrato;
			do{
				$posicion=strpos($cadena, "/", $posicion+1);
				if($posicion != 0)
				{
					$cadena[$posicion]="-";	
				}
			}while($posicion != false);
			 
			//RUTA DE DONDE SE VA ALMACENAR EL ARCHIVO
			$ruta = "Archivos/".$cadena."/"."Semana".$NoReporte ."/";

			//NOMBRE DEL ARCHIVO
			$archivo = $ruta."ReporteSupervisor.pdf";

			//VERIFICAMOS SI EXISTE LA RUTA SI NO EXISTE SE CREA
			if(!file_exists($ruta))
			{
				mkdir($ruta);
			}

			//VERIFICAMOS SI EXISTE UN ARCHIVO CON EL MISMO NOMBR
			if(!file_exists($archivo))
			{
				$resultado = @move_uploaded_file($_FILES["ReporteSupervisor"]["tmp_name"], $archivo);

				if($resultado)
				{
					$mensaje=$mensaje." ReporteSupervisor se guardo con exito";
				}
				else
				{
					$mensaje=$mensaje."No se pudo guardar el archivo";
				}
			}
			else
			{
				$mensaje=$mensaje."El archivo ya existe";
			}
	}
	

	//ARCHIVO: ReporteFotografico

	if(isset($_FILES["ReporteFotografico"]))
	{
		//REMPLAZAR LOS CARACTERES / POR UN -
			$posicion=0;
			$cadena=$n_contrato;
			do{
				$posicion=strpos($cadena, "/", $posicion+1);
				if($posicion != 0)
				{
					$cadena[$posicion]="-";	
				}
			}while($posicion != false);
			 
			//RUTA DE DONDE SE VA ALMACENAR EL ARCHIVO
			$ruta = "Archivos/".$cadena."/"."Semana".$NoReporte ."/";

		

			//VERIFICAMOS SI EXISTE LA RUTA SI NO EXISTE SE CREA
			if(!file_exists($ruta))
			{
				mkdir($ruta);
			}

			//SE INSERTA LA imgReporte PARA EL REPORTE IMPRESO
			for($x=0; $x<count($_FILES["imgReporte"]["name"]); $x++)
			{
				$file = $_FILES["imgReporte"];
				$imgReporte = $file["name"][$x];
				$ruta_provicional=$file["tmp_name"][$x];

				
					//Abrir la imagen
					$original = imagecreatefromjpeg($ruta_provicional);
					$ancho_original=imagesx($original);
					$alto_original=imagesy($original);

					//Crear un lienzo vacio
					$copia = imagecreatetruecolor(200, 200);

					imagecopyresampled($copia, $original, 0, 0, 0, 0,200,200 ,$ancho_original, $alto_original);

					//Exportar y guardar la imagen
					imagejpeg($copia,$ruta.$imgReporte, 100);



			}
			
			$src=$ruta.$imgReporte;	
			
			
			$jsondata["imgReporte"]="Se cambio linea 180";
			$jsondata["imgReporteTipoError"]="Ruta provicional: ".$ruta_provicional." src: ".$src;



			//INSERTAR EN LA TABLA reportes
	$resultado=mysqli_query($con,"INSERT INTO reportes (IdObra, NoReporte, descripcion,AvanceFisico, AvanceFinanciero, EstatusFactura, FechaInicio, FechaTermino, imgReporte, Observaciones) VALUES ($id,$NoReporte,'$descripcion',$AFisico, $AFinanciero, '$estatus', '$fechaInicio', '$fechaTermino', '$src', '$observaciones')");

			//SE HACE UN SELECT PARA OBTENER EL ID de los reportes para posteriormete ocupar dicho ID en la tabal de imagenes_reporte 
			$resultado=mysqli_query($con,"SELECT * FROM reportes WHERE  IdObra={$id} AND NoReporte = {$NoReporte}");

			foreach ($resultado as $fila) 
			{
				$id_reporte=$fila['id'];
			}
			$jsondata["countReporteFotografico"]=$_FILES["ReporteFotografico"]["error"];
			
			for($x=0; $x<count($_FILES["ReporteFotografico"]["name"]); $x++)
			{
					$file = $_FILES["ReporteFotografico"];
					$nombre = $file["name"][$x];
					$tipo = $file["type"][$x];
					$ruta_provicional=$file["tmp_name"][$x];
					$size=$file["size"][$x];

					//Abrir la imagen
					$original = imagecreatefromjpeg($ruta_provicional);
					$ancho_original=imagesx($original);
					$alto_original=imagesy($original);

					//Crear un lienzo vacio
					$ancho_nuevo=1140;
					$alto_nuevo=round($ancho_nuevo * $alto_original / $ancho_original);
					$copia = imagecreatetruecolor($ancho_nuevo, $alto_nuevo);

					imagecopyresampled($copia, $original, 0, 0, 0, 0,$ancho_nuevo,$alto_nuevo ,$ancho_original, $alto_original);

					//Exportar y guardar la imagen
					imagejpeg($copia,$ruta.$nombre, 100);


					$src=$ruta.$nombre;
					$jsondata[$x]="Ya se redimenciona la imagen";
					//INSERTA EN LA TABLA imagenes_reporte
					$rutaCompleta=$ruta.$nombre;
					$resultado=mysqli_query($con,"INSERT INTO imagenes_reporte (IdReportes,imagen) VALUES ($id_reporte, '$rutaCompleta')");
				}
	}
	echo json_encode($jsondata);
	exit();
?>