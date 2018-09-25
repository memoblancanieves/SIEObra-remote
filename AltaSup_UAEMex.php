<?php
	include'conexion.php';
	sleep(1);
	header("Content-Type: text/html;charset=utf-8");
	
	//OBTENEMOS LOS DATOS DEL FORMULARIO
	$nombre   =  $_POST['nombre'];
	$grado    =  $_POST['grado'];
	$mensaje  = "";
	$jsondata    = array();

	//VALIDAMOS QUE SEA UN ARCHIVO PERMITIDO 
	$permitidos = array("application/pdf");
	//PESO MAXIMO PERMITIDO EN BYTE 
	// 1MB = 1000000 BYTE
	$lim_bytes = 5000000;
	
	if($_FILES["SupervisorUAEMex"]["error"] > 0)
	{
		if($_FILES["SupervisorUAEMex"]["error"] == 4)
		{
			//NO SE CARGO EL DOCUEMENTO PERO SI LO DEMAS
			$resultado=mysqli_query($con,"INSERT INTO supervisoruaemex(Nombre, Grado) VALUES('$nombre', '$grado')");
		}
		else
		{
			//Es otro tipo de error
			$mensaje=$mensaje."Error al cargar el archivo SupervisorUAEMex codigo de error:".$_FILES["SupervisorUAEMex"]["error"];
		}
	}
	else
	{
		if(in_array($_FILES["SupervisorUAEMex"]["type"], $permitidos) && $_FILES["SupervisorUAEMex"]["size"] <= $lim_bytes)
		{
			//ARCHIVO PERMITIDO SE PROCESE A GUARDAR, SE INSERTA PRIMERO EL NOMBRE Y EL GRADO EN LA TABLA PARA POSTERIORMENTE OBTENER EL ID
			//QUE SE LE ASIGNO PARA OCUPAR ESE ID PARA QUE SEA EL NOMBRE DE LA CARPETA 

			

			$resultado=mysqli_query($con,"SELECT * FROM supervisoruaemex WHERE Nombre = '$nombre' ");

			foreach ($resultado as $r) 
			{
				$id=$r['ID'];
			}

			//RUTA DE DONDE SE VA ALMACENAR EL ARCHIVO
			$ruta = "SupervisoresUAEMex/".$id."/";

			//NOMBRE DEL ARCHIVO
			$archivo = $ruta."SupervisorUAEMex.pdf";


			//VERIFICAMOS SI EXISTE LA RUTA SI NO EXISTE SE CREA
			if(!file_exists($ruta))
			{
				mkdir($ruta);
			}

			//VERIFICAMOS SI EXISTE UN ARCHIVO CON EL MISMO NOMBR
			if(!file_exists($archivo))
			{
				$resultado = @move_uploaded_file($_FILES["SupervisorUAEMex"]["tmp_name"], $archivo);

				if($resultado)
				{
					$resultado=mysqli_query($con,"INSERT INTO supervisoruaemex(Nombre, Grado) VALUES('$nombre', '$grado')");
					$mensaje=$mensaje."SupervisorUAEMex se guardo con exito";
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
		else
		{
			$mensaje=$mensaje."Error tipo de archivo no permitido o excede el tamaño";
		}
	}


	
	$jsondata['mensajes']   = $mensaje;
	$jsondata['nombre']     = $nombre;
	
	header('Content-type: application/json; charset=utf-8');
	echo json_encode($jsondata);
?>