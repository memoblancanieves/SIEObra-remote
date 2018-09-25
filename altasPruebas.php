<?php
	include'conexion.php';
	$id="00";
	
	//SE OBTIENEN LOS DATOS DEL FORMULARIO
	$fecha =	$_POST['inicio'];
	$nombre=    $_POST['nombre'];

	//OBTENEMOS LOS VALORES DEL CHECKBOX SOLO LOS QUE ESTAN SELECCIONADOS
	$t_personas = $_POST["t_personas"];
	$No_t_personas = count($t_personas);

	//Recorremos el arreglo de las t_personas seleccionadas
	$mensaje="Personas seleccionadas: ";
	for($i=0; $i<$No_t_personas; $i++) 
	{
		$mensaje=$mensaje." ".$t_personas[$i];
	}

	//SE INSERTAN A LA BASE DE DATOS
	$resultado=mysqli_query($con,"INSERT INTO t_fecha(fecha,nombre) VALUES('$fecha', '$nombre')");

	//SE OBTIENE EL ID QUE SE ACABA DE GENERAR AL INSERTAR LOS DATOS
	//PARA POSTERIORMENTE CREAR LA CARPETA CON ESE ID
	$resultado=mysqli_query($con,"SELECT MAX(ID) as id FROM t_fecha;");

	foreach ($resultado as $fila) 
	{
		$id=$fila["id"];
	}
		
	if($_FILES["archivo"]["error"]>0)
	{
		echo "Error al cargar el archivo";
	}
	else
	{
		//TIPOS DE FORMATOS PERMETIDOS
		$permitidos = array("application/pdf");
		//PESO MAXIMO PERMITIDO EN MB
		$limite_MB = 100;

		//VALIDAMOS SI EL ARCHIVO CUMPLE CON LAS RESTRINCCIONES 
		if(in_array($_FILES["archivo"]["type"], $permitidos) && $_FILES["archivo"]["size"] <= $limite_MB * 1024)
		{
			//RUTA DE DONDE SE VA ALMACENAR EL ARCHIVO
			$ruta = "ruta_prueba/".$id."/"; 
			//NOMBRE DEL ARCHIVO
			$archivo = $ruta."contrato01.pdf";

			//VERIFICAMOS SI EXISTE LA RUTA SI NO EXISTE SE CREA
			if(!file_exists($ruta))
			{
				mkdir($ruta);
			}

			//VERIFICAMOS SI EXISTE UN ARCHIVO CON EL MISMO NOMBR
			if(!file_exists($archivo))
			{
				$resultado = @move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo);

				if($resultado)
				{
					echo $mensaje;
				}
				else
				{
					echo "No se pudo guardar el archivo";
				}
			}
			else
			{
				echo "El archivo ya existe";
			}

		}
		else
		{
			echo "Error tipo de archivo no permitido o excede el tamaño";
		}
	}

?>