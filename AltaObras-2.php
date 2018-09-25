<?php
	/*
		Se van a insertar datos en la siguientes tablas:
			A)alta_obras
			B)espaciobeneficiado_altaobras
			C)s_uaemexaltaobras

		No se van a insetar los siguientes archivos por que en este modulo "Nueva obra (con importe presupuestado)" 
		no se tiene el numero de contrato y para poder crear las carpetas donde van los archivos se crean con el 
		numero de contrato, se podran insertar los archivos cuando la obra pase a "Nueva obra (con importe autorizado)"
			A)EmpresaContrato
			B)SupervisorEmpresa

		Ultima Autoalizacion: 23/agosto/2018
	*/

	include'conexion.php';
	sleep(1);
	
	//OBTENEMOS LOS DATOS DEL FORMULARIO 
	$n_obra                =  $_POST['n_obra'];
	$n_contrato            =  $_POST['n_contrato'];
	$importePresupuestado  =  $_POST['importePresupuestado'];
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

	//VALIDAR SI TODAS LAS VARIABLES DE TIPO NUMERICO TENGAN UN VALOR DE NO SER ASI SE LES TIENE QUE ASIGNAR EL VALOR DE 0
	if($importePresupuestado == "")
	{
		$importePresupuestado = 0;
	}

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

	if($id_tipo_obra  == "")
	{
		$id_tipo_obra = 0;
	}

	if($id_estadoObra == "")
	{
		$id_estadoObra = 0;
	}

	if($ID_SupervisorUAEMex)
	{
		$ID_SupervisorUAEMex=0;
	}

	/*
		Las fechas si vienen vacias marcan error por eso se realizo la siguientes validaciones
	*/

	if($fechaTermino == "" && $fechaInicio == "")
	{
		//No se tienen fechaTermino ni fechaInicio
		$resultado=mysqli_query($con,"INSERT INTO altas_obras(Nombre,NoContrato,descripcion,Monto,importeAutorizado,importeEjercido,AlumnosH, AlumnosM,ProfesoresH, ProfesoresM, Empresa, ID_Bitacora, SupEmpresa, EmpresaGrado, ObsEstatus, id_tipo_obra, id_estadoObra, tipo_importe, importePresupuestado) 
			VALUES('$n_obra', '$n_contrato','$descripcion',$importeContratado,$importeAutorizado,$importeEjercido,$alumnosh,$alumnosm,$profesoresh,$profesoresm,'$empresa',$bitacora,'$SEmpresa','$GradoEmpresa','$observacionesEstatus',$id_tipo_obra,$id_estadoObra,0, $importePresupuestado)");

	}
	else
	{
		if($fechaTermino != "" && $fechaInicio != "")
		{
			//Si se tiene fechaTermino y fechaInicio
			$resultado=mysqli_query($con,"INSERT INTO altas_obras(Nombre,NoContrato,descripcion,Monto,importeAutorizado,importeEjercido,AlumnosH, AlumnosM,ProfesoresH, ProfesoresM, FechaInicio, FechaTermino, Empresa, ID_Bitacora, SupEmpresa, EmpresaGrado, ObsEstatus, id_tipo_obra, id_estadoObra, tipo_importe, importePresupuestado) VALUES('$n_obra', '$n_contrato', '$descripcion',$importeContratado,$importeAutorizado,$importeEjercido, $alumnosh, $alumnosm, $profesoresh, $profesoresm, '$fechaInicio', '$fechaTermino', '$empresa', $bitacora, '$SEmpresa', '$GradoEmpresa','$observacionesEstatus', $id_tipo_obra, $id_estadoObra, 0, $importePresupuestado)");
		}
		else
		{
			if($fechaTermino != "")
			{
				//Solo se tiene la fechaTermino
				$resultado=mysqli_query($con,"INSERT INTO altas_obras(Nombre,NoContrato,descripcion,Monto,importeAutorizado,importeEjercido,AlumnosH, AlumnosM,ProfesoresH, ProfesoresM, FechaTermino, Empresa, ID_Bitacora, SupEmpresa, EmpresaGrado, ObsEstatus, id_tipo_obra, id_estadoObra, tipo_importe, importePresupuestado) VALUES('$n_obra', '$n_contrato', '$descripcion',$importeContratado,$importeAutorizado,$importeEjercido, $alumnosh, $alumnosm, $profesoresh, $profesoresm,'$fechaTermino', '$empresa', $bitacora, '$SEmpresa', '$GradoEmpresa','$observacionesEstatus', $id_tipo_obra, $id_estadoObra, 0, $importePresupuestado)");
			}
			else
			{
				//Solo se tiene la fechaInicio
				$resultado=mysqli_query($con,"INSERT INTO altas_obras(Nombre,NoContrato,descripcion,Monto,importeAutorizado,importeEjercido,AlumnosH, AlumnosM,ProfesoresH, ProfesoresM, FechaInicio, Empresa, ID_Bitacora, SupEmpresa, EmpresaGrado, ObsEstatus, id_tipo_obra, id_estadoObra, tipo_importe, importePresupuestado) VALUES('$n_obra', '$n_contrato', '$descripcion',$importeContratado,$importeAutorizado,$importeEjercido, $alumnosh, $alumnosm, $profesoresh, $profesoresm, '$fechaInicio','$empresa', $bitacora, '$SEmpresa', '$GradoEmpresa','$observacionesEstatus', $id_tipo_obra, $id_estadoObra, 0, $importePresupuestado)");
			}
		}
		

	}

	/*
		SI LA INSERCION A LA TABLA "altas_obras" es exitosa se prosede a insertar en las tablas siguientes:
			A) espaciobeneficiado_altaobras
			B) s_uaemexaltaobras
	*/


	if($resultado === TRUE)
	{
		$jsondata['insert_alta_obras'] = TRUE;
		/*
		    Se busca el "id" de la obra que se acaba de insertar para poder insertar las siguientes tablas:
		    	A)espaciobeneficiado_altaobras
		    	B)s_uaemexaltaobras
		*/
		$resultado=mysqli_query($con, "SELECT MAX(id) as id_maximo from altas_obras");
		foreach ($resultado as $fila) 
		{
			$id=$fila['id_maximo'];
			$jsondata['id'] = $id;
		}

		//Se procede a insertar en la tabla A)espaciobeneficiado_altaobras
		$resultado=mysqli_query($con,"INSERT INTO espaciobeneficiado_altaobras (EspacioBeneficiadoId, AltaObrasID) VALUES ($Id_EspacioBeneficiado,$id)");
		if($resultado === TRUE)
		{
			$jsondata['insert_espaciobeneficiado_altaobras']=TRUE;
		}
		else
		{
			$jsondata['insert_espaciobeneficiado_altaobras']=FALSE;
		}

		//Se procede a instar en la tabla B)s_uaemexaltaobras
		$resultado=mysqli_query($con,"INSERT INTO s_uaemexaltaobras (S_UAEMexID, AltaObrasID) VALUES ($ID_SupervisorUAEMex,$id)");
		if($resultado === TRUE)
		{
			$jsondata['insert_s_uaemexaltaobras']=TRUE;
		}
		else
		{
			$jsondata['insert_s_uaemexaltaobras']=FALSE;
		}	
	}
	else
	{
		$jsondata['insert_alta_obras'] = mysqli_error($con);
		$jsondata['insert_espaciobeneficiado_altaobras']=FALSE;
		$jsondata['insert_s_uaemexaltaobras']=FALSE;

	}

	echo json_encode($jsondata);
	exit();	
?>