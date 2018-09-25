<?php
	include'conexion.php';
	sleep(1);
	//OBTENEMOS LOS DATOS DEL FORMULARIO 
	$n_obra                =  $_POST['n_obra'];
	$n_contrato            =  $_POST['n_contrato'];
	$importeAutorizado     =  $_POST['importeAutorizado'];
	$importeContratado     =  $_POST['importeContratado'];
	$importeEjercido       =  $_POST['importeEjercido'];
	$alumnosh      	       =  $_POST['alumnosh'];
	$alumnosm     	       =  $_POST['alumnosm'];
	$profesoresh  	       =  $_POST['profesoresh'];
	$profesoresm 	       =  $_POST['profesoresm'];
	$fechaInicio  	       =  $_POST['fechaInicio'];
	$fechaTermino 	       =  $_POST['fechaTermino'];
	$empresa      	       =  $_POST['empresa'];
	$bitacora     	       =  $_POST['bitacora'];
	$SEmpresa     	       =  $_POST['SEmpresa'];
	$GradoEmpresa 	       =  $_POST['GradoEmpresa'];
	$descripcion  	       =  $_POST['descripcion'];
	$Id_EspacioBeneficiado =  $_POST['beneficiado'];
	$ID_SupervisorUAEMex   =  $_POST['SUaemex'];        
	$id_tipo_obra          =  $_POST['tipoObra'];
	$id_estadoObra 		   =  $_POST['estadoObra'];
	$observacionesEstatus  =  $_POST['observacionesEstatus'];
	$mensaje=" ";
	$jsondata    = array();

	$permitidos = array("application/pdf");
	//PESO MAXIMO PERMITIDO EN BYTE 
	// 1MB = 1000000 BYTE
	$lim_bytes = 4000000;

	
	//ARCHIVO EmpresaContrato
	if($_FILES["EmpresaContrato"]["error"] > 0)
	{
		$mensaje=$mensaje."Error al cargar el archivo EmpresaContrato";
	}
	else
	{
		if(in_array($_FILES["EmpresaContrato"]["type"], $permitidos) && $_FILES["EmpresaContrato"]["size"] <= $lim_bytes)
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
			$ruta = "Archivos/".$cadena."/";

			//NOMBRE DEL ARCHIVO
			$archivo = $ruta."EmpresaContrato.pdf";

			//VERIFICAMOS SI EXISTE LA RUTA SI NO EXISTE SE CREA
			if(!file_exists($ruta))
			{
				mkdir($ruta);
			}
			

			//VERIFICAMOS SI EXISTE UN ARCHIVO CON EL MISMO NOMBR
			if(!file_exists($archivo))
			{
				$resultado = @move_uploaded_file($_FILES["EmpresaContrato"]["tmp_name"], $archivo);

				if($resultado)
				{
					$mensaje=$mensaje." EmpresaContrato se guardo con exito";
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


	//ARCHIVO SupervisorEmpresa
	if($_FILES["SupervisorEmpresa"]["error"] == 4)
	{
		$mensaje=$mensaje."Error al cargar el archivo SupervisorEmpresa";
	}
	else
	{
		if(in_array($_FILES["SupervisorEmpresa"]["type"], $permitidos) && $_FILES["SupervisorEmpresa"]["size"] <= $lim_bytes)
		{
			 
			//NOMBRE DEL ARCHIVO
			$archivo = $ruta."SupervisorEmpresa.pdf";

			

			//VERIFICAMOS SI EXISTE UN ARCHIVO CON EL MISMO NOMBR
			if(!file_exists($archivo))
			{
				$resultado = @move_uploaded_file($_FILES["SupervisorEmpresa"]["tmp_name"], $archivo);

				if($resultado)
				{
					$mensaje=$mensaje." SupervisorEmpresa se guardo con exito";
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


	if($fechaTermino == "")
	{
		$resultado=mysqli_query($con,"INSERT INTO altas_obras(Nombre,NoContrato,descripcion,Monto,importeAutorizado,importeEjercido,AlumnosH, AlumnosM,ProfesoresH, ProfesoresM, FechaInicio, Empresa, ID_Bitacora, SupEmpresa, EmpresaGrado,ObsEstatus, id_tipo_obra, id_estadoObra) VALUES('$n_obra', '$n_contrato', '$descripcion',$importeContratado,$importeAutorizado,$importeEjercido ,$alumnosh, $alumnosm, $profesoresh, $profesoresm, '$fechaInicio', '$empresa', $bitacora, '$SEmpresa', '$GradoEmpresa','$observacionesEstatus', $id_tipo_obra, $id_estadoObra)");

	}
	else
	{
		$resultado=mysqli_query($con,"INSERT INTO altas_obras(Nombre,NoContrato,descripcion,Monto,importeAutorizado,importeEjercido,AlumnosH, AlumnosM,ProfesoresH, ProfesoresM, FechaInicio, FechaTermino, Empresa, ID_Bitacora, SupEmpresa, EmpresaGrado,ObsEstatus, id_tipo_obra, id_estadoObra) VALUES('$n_obra', '$n_contrato', '$descripcion',$importeContratado,$importeAutorizado,$importeEjercido, $alumnosh, $alumnosm, $profesoresh, $profesoresm, '$fechaInicio', '$fechaTermino', '$empresa', $bitacora, '$SEmpresa', '$GradoEmpresa','$observacionesEstatus', $id_tipo_obra, $id_estadoObra)");

	}

	if($resultado)
	{
		$jsondata['insert_alta_obras'] = $resultado;	
	}
	else
	{
		$jsondata['insert_alta_obras'] = mysqli_error($con);
	}


	$resultado=mysqli_query($con, "SELECT * FROM altas_obras WHERE NoContrato= '".$n_contrato."'");

	foreach ($resultado as $fila) 
	{
		$id=$fila['ID'];
	}

	$jsondata['mensajes']    = $mensaje;
	$jsondata['id']          = $id;
	
	
	//FALTA LA TABLA espaciobeneficiado_altaobras

 	$resultado=mysqli_query($con,"INSERT INTO espaciobeneficiado_altaobras (EspacioBeneficiadoId, AltaObrasID) VALUES ($Id_EspacioBeneficiado,$id)");

	//FALTA LA TABLA s_uaemexaltaobras 

 	$resultado=mysqli_query($con,"INSERT INTO s_uaemexaltaobras (S_UAEMexID, AltaObrasID) VALUES ($ID_SupervisorUAEMex,$id)");

	echo json_encode($jsondata);
	exit();	
?>