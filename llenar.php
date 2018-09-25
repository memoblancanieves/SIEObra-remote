<?php
	include 'conexion.php';
	$jsondata    = array();

	$resultado=mysqli_query($con,"SELECT * FROM altas_obras WHERE ID =".$_POST['id']);

	if(mysqli_num_rows($resultado)>0)
	{
		foreach ($resultado as $fila) 
		{
			$jsondata['ID']                   = $fila['ID'];
			$jsondata['Nombre']               = $fila['Nombre'];
			$jsondata['NoContrato']           = $fila['NoContrato'];
			$jsondata['descripcion']          = $fila['descripcion'];
			$jsondata['importeAutorizado']    = $fila['importeAutorizado'];
			$jsondata['importeEjercido']      = $fila['importeEjercido'];
			$jsondata['importePresupuestado'] = $fila['importePresupuestado'];
			$jsondata['Monto']                = $fila['Monto'];//importeContratado
			$jsondata['AlumnosH']             = $fila['AlumnosH'];
			$jsondata['AlumnosM']             = $fila['AlumnosM'];
			$jsondata['ProfesoresH']          = $fila['ProfesoresH'];
			$jsondata['ProfesoresM']          = $fila['ProfesoresM'];
			$jsondata['FechaInicio']          = $fila['FechaInicio'];
			$jsondata['FechaTermino']         = $fila['FechaTermino'];
			$jsondata['Empresa']              = $fila['Empresa'];
			$jsondata['ID_Bitacora']          = $fila['ID_Bitacora'];
			$jsondata['SupEmpresa']           = $fila['SupEmpresa'];
			$jsondata['EmpresaGrado']         = $fila['EmpresaGrado'];
			

			//Select tipoObra  tabla: tipo_obra pero se inserta en la tabla: altas_obras
			$jsondata['tipoObraSelect']=$fila['id_tipo_obra'];

			//Select estadoObra tabla: estadoobra pero se inserta en la tabla: alta_obras
			$jsondata['estadoobraSelect']=$fila['id_estadoObra'];

			//observacionesEstatus
			$jsondata['observacionesEstatus']=$fila['ObsEstatus'];
		}
	}

	

	//SUPERVISOR DE LA UAEMex
	$resultado=mysqli_query($con,"SELECT * FROM s_uaemexaltaobras WHERE AltaObrasID =".$jsondata['ID']);

	if(mysqli_num_rows($resultado)>0)
	{
		foreach ($resultado as $fila) 
		{
			$jsondata['IDSupervisorUAEMex'] =$fila['S_UAEMexID'];
		}
	}

	//ESPACIO BENEFICIADO
	$resultado=mysqli_query($con,"SELECT * FROM espaciobeneficiado_altaobras WHERE AltaObrasID =".$jsondata['ID']);

	if(mysqli_num_rows($resultado)>0)
	{
		foreach ($resultado as $fila) 
		{
			$jsondata['IDEspacioBeneficiado'] =$fila['EspacioBeneficiadoId'];
		}
	}

	//TIPO DE OBRA
	$jsondata['tipoObra'] =array();
	$i=0;
	$resultado=mysqli_query($con,"SELECT * FROM altas_obrast_obras WHERE ID_alta=".$jsondata['ID']);

	if(mysqli_num_rows($resultado)>0)
	{
		foreach ($resultado as $fila) 
		{
			$jsondata['tipoObra'][$i] = $fila['ID_Obras'];
			$i=$i+1;
		}
	}


	//TIPO DE RECURSO
	$jsondata['tipoRecurso'] =array();
	$i=0;
	$resultado=mysqli_query($con,"SELECT * FROM altas_obrast_recurso WHERE ID_alta=".$jsondata['ID']);

	if(mysqli_num_rows($resultado)>0)
	{
		foreach ($resultado as $fila) 
		{
			$jsondata['tipoRecurso'][$i] = $fila['ID_Recursos'];
			$i=$i+1;
		}
	}

	/*
		REMPLAZAMOS EL " / " POR  " - " 
		EJEMPLO UAEM/SAD/001/2018 = UAEM-SAD-001-2018 
		YA QUE LAS CARPETAS SE CREARON CON EL - YA QUE EL / NO SE PUEDE CREAR.
	*/
	$posicion=0;
	$cadena=$jsondata['NoContrato'];

	if($cadena != "")
	{
		do{
			$posicion=strpos($cadena, "/", $posicion+1);
			if($posicion != 0)
			{
				$cadena[$posicion]="-";	
			}
		}while($posicion != false); 

		//RUTA DEL ARCHIVO EJEMPLO $ruta= Archivos/UAEM-SAD-001-2018/
		$ruta = "Archivos/".$cadena."/";


		/* ARCHIVO: EmpresaContrato.pdf */
		//LEEMOS EL ARCHIVO PDF DEL CONTRATO DE LA EMPRESA $archivo=Archivos/UAEM-SAD-001-2018/EmpresaContrato.pdf
		$archivo = $ruta."EmpresaContrato.pdf";

		//VERIFICAMOS QUE EXISTA EmpresaContrato.pdf
		if(file_exists($archivo))
		{
			$jsondata['EmpresaContrato']=$archivo;
		}
		else
		{
			$jsondata['EmpresaContrato']="NO SE ENCONTRO ARCHIVO";
		}

		/* ARCHIVO: SupervisorEmpresa.pdf */
		//LEEMOS EL ARCHIVO PDF DEL CONTRATO DE LA EMPRESA $archivo=Archivos/UAEM-SAD-001-2018/SupervisorEmpresa.pdf
		$archivo = $ruta."SupervisorEmpresa.pdf";

		//VERIFICAMOS QUE EXISTA SupervisorEmpresa.pdf
		if(file_exists($archivo))
		{
			$jsondata['SupervisorEmpresa']=$archivo;
		}
		else
		{
			$jsondata['SupervisorEmpresa']="NO SE ENCONTRO ARCHIVO";
		}


		/* ARCHIVO: SupervisorUAEMex.pdf */
		//LEEMOS EL ARCHIVO PDF DEL CONTRATO DE LA EMPRESA $archivo=Archivos/UAEM-SAD-001-2018/SupervisorUAEMex.pdf
		$ruta = "SupervisoresUAEMex/".$jsondata['IDSupervisorUAEMex']."/";
		$archivo = $ruta."SupervisorUAEMex.pdf";

		//VERIFICAMOS QUE EXISTA EmpresaContrato.pdf
		if(file_exists($archivo))
		{
			$jsondata['SupervisorUAEMex']=$archivo;
		}
		else
		{
			$jsondata['SupervisorUAEMex']="NO SE ENCONTRO ARCHIVO";
		}

	}
	else
	{
		$jsondata['EmpresaContrato']="NO SE ENCONTRO ARCHIVO";
		$jsondata['SupervisorEmpresa']="NO SE ENCONTRO ARCHIVO";
		$jsondata['SupervisorUAEMex']="NO SE ENCONTRO ARCHIVO";
	}
	



	

	//CONSEGUIR EL NOMBRE DEL SUPERVISOR DE UAEMex
	$resultado=mysqli_query($con, "SELECT * FROM supervisoruaemex WHERE ID=".$jsondata['IDSupervisorUAEMex']);
	foreach ($resultado as $fila) 
	{
		$nombre=$fila['Nombre'];
	}

	$jsondata['NombreUAEMex']=$nombre;

	
	

	//print_r($jsondata[0]['uno'])
	//echo $jsondata['tipoRecurso'][0];
    echo json_encode($jsondata);
	exit();	
?>