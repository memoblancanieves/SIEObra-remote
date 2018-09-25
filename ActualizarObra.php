<?php

	include'conexion.php';
	sleep(1);
	//OBTENEMOS LOS DATOS DEL FORMULARIO 
	$id                    =  $_POST['id_Obra'];
	$n_obra      		   =  $_POST['n_obra'];
	$n_contrato   		   =  $_POST['n_contrato'];
	$importePresupuestado  =  $_POST['importePresupuestado'];
	$importeAutorizado     =  $_POST['importeAutorizado'];
	$importeContratado     =  $_POST['importeContratado'];
	$importeEjercido       =  $_POST['importeEjercido'];
	$alumnosh    		   =  $_POST['alumnosh'];
	$alumnosm    		   =  $_POST['alumnosm'];
	$profesoresh 		   =  $_POST['profesoresh'];
	$profesoresm 		   =  $_POST['profesoresm'];
	$fechaInicio 		   =  $_POST['fechaInicio'];
	$fechaTermino 		   =  $_POST['fechaTermino'];
	$empresa      		   =  $_POST['empresa'];
	$bitacora     	       =  $_POST['bitacora'];
	$SEmpresa     		   =  $_POST['SEmpresa'];
	$GradoEmpresa 		   =  $_POST['GradoEmpresa'];
	$descripcion 		   =  $_POST['descripcion'];
	$Id_EspacioBeneficiado =  $_POST['beneficiado'];
	$ID_SupervisorUAEMex   =  $_POST['SUaemex'];
	$id_tipo_obra          =  $_POST['tipoObra'];
	$id_estadoObra 		   =  $_POST['estadoObra'];
	$observacionesEstatus  =  $_POST['observacionesEstatus'];
	
	//VALIDAR SI TODAS LAS VARIABLES DE TIPO NUMERICO TENGAN UN VALOR DE NO SER ASI SE LES TIENE QUE ASIGNAR EL VALOR DE 0
	if($importeAutorizado == "")
	{
		$importeAutorizado = 0;
	}

	if($importeContratado == "")
	{
		$importeContratado = 0;
	}

	if($importeEjercido == "")
	{
		$importeEjercido = 0;
	}

	if($alumnosh == "")
	{
		$alumnosh =0; 
	}

	if($alumnosm == "")
	{
		$alumnosm = 0;
	}

	if($profesoresh == "")
	{
		$profesoresh = 0;
	}

	if($profesoresm == "")
	{
		$profesoresm = 0;
	}

	if($bitacora == "")
	{
		$bitacora =0;	
	}

	/*
		Las fechas si vienen vacias marcan error por eso se realizo la siguientes validaciones
	*/

	if($fechaInicio == "")
	{
		$fechaInicio="00/00/000";
	}

	if($fechaTermino == "")
	{
		$fechaTermino="00/00/000";
	}

	if($observacionesEstatus == "")
	{
		$observacionesEstatus="  ";
	}
	
	
	$mensaje=" ";
	$jsondata    = array();

	$permitidos = array("application/pdf");
	//PESO MAXIMO PERMITIDO EN BYTE 
	// 1MB = 1000000 BYTE
	$lim_bytes = 20000000;

	if($n_obra == "")
	{
		//ARCHIVO EmpresaContrato
		if($_FILES["EmpresaContrato"]["error"] == 0)
		{
			if($_FILES["EmpresaContrato"]["error"] > 0)
			{
				$mensaje=$mensaje+"Error al cargar el archivo EmpresaContrato";
			}
			else
			{
				if(in_array($_FILES["EmpresaContrato"]["type"], $permitidos) && $_FILES["EmpresaContrato"]["size"] <= $lim_bytes)
				{
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
					$mensaje=$mensaje."Error al subir el archivo EmpresaContrato";
				}
				
				

			}
			
		}
		

		//ARCHIVO SupervisorUAEMex
		if($_FILES["SupervisorUAEMex"]["error"] == 0)
		{
			if($_FILES["SupervisorUAEMex"]["error"] > 0)
			{
				$mensaje=$mensaje+"Error al cargar el archivo SupervisorUAEMex";
			}
			else
			{
				if(in_array($_FILES["SupervisorUAEMex"]["type"], $permitidos) && $_FILES["SupervisorUAEMex"]["size"] <= $lim_bytes)
				{
					
					 
					//RUTA DE DONDE SE VA ALMACENAR EL ARCHIVO
					$ruta = "SupervisoresUAEMex/".$ID_SupervisorUAEMex."/";

					//NOMBRE DEL ARCHIVO
					$archivo = $ruta."SupervisorUAEMex.pdf";

					//VERIFICAMOS SI EXISTE LA RUTA SI NO EXISTE SE CREA
					if(!file_exists($ruta))
					{
						mkdir($ruta);
					}

					
					$resultado = @move_uploaded_file($_FILES["SupervisorUAEMex"]["tmp_name"], $archivo);

					if($resultado)
					{
						$mensaje=$mensaje." SupervisorUAEMex se guardo con exito";
					}
					else
					{
						$mensaje=$mensaje."No se pudo guardar el archivo";
					}

				}
				else
				{
					$mensaje=$mensaje."Error al subir el archivo SupervisorUAEMex";
				}
				
				

			}
		}
		

		//ARCHIVO SupervisorEmpresa
		if($_FILES["SupervisorEmpresa"]["error"] == 0)
		{
			if($_FILES["SupervisorEmpresa"]["error"] > 0)
			{
				$mensaje=$mensaje+"Error al cargar el archivo SupervisorEmpresa";
			}
			else
			{
				if(in_array($_FILES["SupervisorEmpresa"]["type"], $permitidos) && $_FILES["SupervisorEmpresa"]["size"] <= $lim_bytes)
				{
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
					$archivo = $ruta."SupervisorEmpresa.pdf";

					//VERIFICAMOS SI EXISTE LA RUTA SI NO EXISTE SE CREA
					if(!file_exists($ruta))
					{
						mkdir($ruta);
					}

					
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
					$mensaje=$mensaje."Error al subir el archivo SupervisorEmpresa";
				}
				
				

			}
		}
			


	}
	
	
	

		$resultado=mysqli_query($con,"UPDATE altas_obras SET 
			Nombre='$n_obra',
			NoContrato='$n_contrato' ,
			descripcion='$descripcion',
			importePresupuestado=$importePresupuestado,
			Monto=$importeContratado, 
			importeAutorizado=$importeAutorizado, 
			importeEjercido=$importeEjercido,
			AlumnosH=$alumnosh, 
			AlumnosM=$alumnosm,
			ProfesoresH=$profesoresh, 
			ProfesoresM=$profesoresm,
			Empresa='$empresa', 
			ID_Bitacora=$bitacora, 
			SupEmpresa='$SEmpresa', 
			EmpresaGrado='$GradoEmpresa', 
			ObsEstatus='$observacionesEstatus',
			id_tipo_obra=$id_tipo_obra,
			id_estadoObra=$id_estadoObra 
			WHERE ID=".$id);					

	


	
	if($resultado)
	{
		$jsondata['update_alta_obras'] = TRUE;
		/*
		    Se busca el "id" de la obra que se acaba de insertar para poder insertar las siguientes tablas:
		    	A)espaciobeneficiado_altaobras
		    	B)s_uaemexaltaobras
		*/

		$resultado=mysqli_query($con,"UPDATE espaciobeneficiado_altaobras SET EspacioBeneficiadoId=$Id_EspacioBeneficiado WHERE AltaObrasID=$id");
		$resultado=mysqli_query($con,"UPDATE s_uaemexaltaobras SET S_UAEMexID=$ID_SupervisorUAEMex WHERE AltaObrasID=$id");
	}
	else
	{
		$jsondata['update_alta_obras'] = mysqli_error($con)+" ";
	}



	$jsondata['mensajes']    = $mensaje;
	$jsondata['id']          = $id;
	$jsondata['ObsEstatus']    = $observacionesEstatus;
	echo json_encode($jsondata);
	exit();

?>