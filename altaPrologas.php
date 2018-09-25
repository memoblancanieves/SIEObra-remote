<?php
	include'conexion.php';
	sleep(1);
	$jsondata    = array();


	$id             = $_POST['id'];
	$fechaProloga   = $_POST['fechaProloga'] ;
	$observaciones  = $_POST['observaciones'];
	$mensaje     ="";

	//SE OBTIENE EL NUMERO DE CONTRATO POR MEDIO DEL ID DE LA OBRA
	$resultado=mysqli_query($con,"SELECT * FROM altas_obras WHERE ID =".$_POST['id']);
		if(mysqli_num_rows($resultado)>0)
		{
			foreach ($resultado as $fila) 
			{
				$n_contrato    = $fila['NoContrato'];
			}

		}
		else
		{
			echo "Error no se encontro la busqueda para id: ".$id;
		}



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

			$ruta = $ruta."Prologas"."/";//DENTRO DE LA CARPETA DEL ID SE AGREGAN LA CARPETA DE LAS PROLOGAS
			
			//VERIFICAMOS QUE SI EXISTE LA CARPETA CON EL NUMERO DE REPORTE 
			if(!file_exists($ruta))
			{
				mkdir($ruta);
			}

			//HACEMOS UNA CONSULTA A LA TABLA prologas PARA SABER CUANTAS PROLOGAS TIENEN 
			$resultado=mysqli_query($con,"SELECT * FROM prologas WHERE ID_Obra=".$id);
			$numero=mysqli_num_rows($resultado);
			
			//NOMBRE DEL ARCHIVO
			$archivo = $ruta."prologa".$numero.".pdf";

			//VERIFICAMOS SI EXISTE UN ARCHIVO CON EL MISMO NOMBR
			if(!file_exists($archivo))
			{
				$resultado = @move_uploaded_file($_FILES["estadoCuenta"]["tmp_name"], $archivo);

				if($resultado)
				{
					$jsondata['documento']="Se guardo con exito: ".$archivo;
					$resultado=mysqli_query($con,"INSERT INTO prologas(ID_Obra,fecha,contrato,observaciones) VALUES ($id, '$fechaProloga', '$archivo','$observaciones')");
					$jsondata['tablaPrologas']="tabla prologas ".$resultado;
				}
				else
				{
					$mensaje=$mensaje."No se pudo guardar el archivo";
					$jsondata['documento']="No se guardo: ".$archivo;
					$jsondata['tablaPrologas']="No se inserto ";
				}
			}
			else
			{
				$mensaje=$mensaje."El archivo ya existe";
			}
	}
	

	echo json_encode($jsondata);
	exit();
?>