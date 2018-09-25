<?php
  	include 'conexion.php';

 	$salida = "";
	 //CONSULTA PARA OBTENER: 
	 // -Nombre de la obra
	 // -NoContrato
	 // -Espacio beneficiado
	 // -Supervisor de la UAEMex

  	

	 if(isset($_POST['consulta']))
	 {
	 	$q = mysqli_real_escape_string($con, $_POST['consulta']);
	 	$opcion = $_POST['opc'];

	 	switch ($opcion) 
	 	{
	 	 	case '1':
	 	 		$query  = "SELECT altas_obras.ID, altas_obras.Nombre, altas_obras.NoContrato, espaciobeneficiado.Nombre as espaciobeneficiado, supervisoruaemex.Nombre AS supervisor 
				from altas_obras INNER JOIN espaciobeneficiado_altaobras ON espaciobeneficiado_altaobras.AltaObrasId=altas_obras.ID
				INNER JOIN espaciobeneficiado ON espaciobeneficiado.ID=espaciobeneficiado_altaobras.EspacioBeneficiadoId
				INNER JOIN s_uaemexaltaobras ON s_uaemexaltaobras.AltaObrasID=altas_obras.ID
				INNER JOIN supervisoruaemex ON supervisoruaemex.ID=s_uaemexaltaobras.S_UAEMexID WHERE tipo_importe=1  and altas_obras.Nombre  LIKE '%".$q."%'";
	 	 	break;

	 	 	case '2':
	 	 		$query  = "SELECT altas_obras.ID, altas_obras.Nombre, altas_obras.NoContrato, espaciobeneficiado.Nombre as espaciobeneficiado, supervisoruaemex.Nombre AS supervisor 
				from altas_obras INNER JOIN espaciobeneficiado_altaobras ON espaciobeneficiado_altaobras.AltaObrasId=altas_obras.ID
				INNER JOIN espaciobeneficiado ON espaciobeneficiado.ID=espaciobeneficiado_altaobras.EspacioBeneficiadoId
				INNER JOIN s_uaemexaltaobras ON s_uaemexaltaobras.AltaObrasID=altas_obras.ID
				INNER JOIN supervisoruaemex ON supervisoruaemex.ID=s_uaemexaltaobras.S_UAEMexID WHERE tipo_importe=1  and altas_obras.NoContrato LIKE '%".$q."%'";
	 	 	break;

	 	 	case '3':
	 	 		$query  = "SELECT altas_obras.ID, altas_obras.Nombre, altas_obras.NoContrato, espaciobeneficiado.Nombre as espaciobeneficiado, supervisoruaemex.Nombre AS supervisor 
				from altas_obras INNER JOIN espaciobeneficiado_altaobras ON espaciobeneficiado_altaobras.AltaObrasId=altas_obras.ID
				INNER JOIN espaciobeneficiado ON espaciobeneficiado.ID=espaciobeneficiado_altaobras.EspacioBeneficiadoId
				INNER JOIN s_uaemexaltaobras ON s_uaemexaltaobras.AltaObrasID=altas_obras.ID
				INNER JOIN supervisoruaemex ON supervisoruaemex.ID=s_uaemexaltaobras.S_UAEMexID WHERE tipo_importe=1  and espaciobeneficiado.Nombre LIKE '%".$q."%'";
	 	 	break;
	 	 	
	 	 	default:
	 	 		$salida.="Error en el switch";
	 	 	break;
	 	 } 
	 	

	 }
	 else
	 {
	 	$query  = "SELECT altas_obras.ID, altas_obras.Nombre, altas_obras.NoContrato, espaciobeneficiado.Nombre as espaciobeneficiado, supervisoruaemex.Nombre AS supervisor 
				from altas_obras INNER JOIN espaciobeneficiado_altaobras ON espaciobeneficiado_altaobras.AltaObrasId=altas_obras.ID
				INNER JOIN espaciobeneficiado ON espaciobeneficiado.ID=espaciobeneficiado_altaobras.EspacioBeneficiadoId
				INNER JOIN s_uaemexaltaobras ON s_uaemexaltaobras.AltaObrasID=altas_obras.ID
				INNER JOIN supervisoruaemex ON supervisoruaemex.ID=s_uaemexaltaobras.S_UAEMexID  
				WHERE tipo_importe=1 ORDER BY altas_obras.ID";

	 }

  	$resultado = mysqli_query($con,$query);

	if($resultado)
	{
	  		$salida.="<table class='table table-striped'>
	  				<thead>
	  					<tr>
	  						<th scope='col'>Nombre de la obra</th>
	  						<th scope='col'>No. Contrato</th>
	  						<th scope='col'>Espacio beneficiado</th>
	  						<th scope='col'>Supervisor UAEMex</th>
	  					<tr>
	  				</thead>
	  				<tbody>";

	  	   if(isset($_POST['opc']))
	  	   {
	  	   		//Resaltar las letras que coincidan con la busqueda
	  	   		//AQUI FALTA AGREGAR UN SWITCH PARA ESPECIFICAR EN QUE CAMPO ESTAMOS HACIENDO LA BUSQUEDA
	  	   		switch ($_POST['opc']) 
	  	   		{
	  	   			case '1':
	  	   			   foreach ($resultado as $fila) 
				  	   {
				  	   		//$negritas=substr($fila['Nombre'], 0, strlen ($q));
				  	   		//$resto=substr($fila['Nombre'], strlen ($q));
				  	   		//$palabra="<b style='color:green;'>".$negritas."</b>".$resto;
				  	   		$salida.="<tr>
				  	   					<td onclick='llenar(".$fila['ID'].")'>".$fila['Nombre']."</td>					  	   				
				  	   					<td onclick='llenar(".$fila['ID'].")'>".$fila['NoContrato']."</td>
					  	   				<td onclick='llenar(".$fila['ID'].")'>".$fila['espaciobeneficiado']."</td>
					  	   				<td onclick='llenar(".$fila['ID'].")'>".$fila['supervisor']."</td> 
					  	   			</tr>";
				  	   }	
	  	   			break;

	  	   			case '2':
	  	   			   foreach ($resultado as $fila) 
				  	   {
				  	   		//$negritas=substr($fila['NoContrato'], 0, strlen ($q));
				  	   		//$resto=substr($fila['NoContrato'], strlen ($q));
				  	   		//$palabra="<b style='color:green;'>".$negritas."</b>".$resto;
				  	   		$salida.="<tr>
					  	   				<td onclick='llenar(".$fila['ID'].")'>".$fila['Nombre']."</td>
					  	   				<td onclick='llenar(".$fila['ID'].")'>".$fila['NoContrato']."</td>
					  	   				<td onclick='llenar(".$fila['ID'].")'>".$fila['espaciobeneficiado']."</td>
					  	   				<td onclick='llenar(".$fila['ID'].")'>".$fila['supervisor']."</td> 
					  	   			</tr>";
				  	   }	
	  	   			break;

	  	   			case '3':
	  	   			   foreach ($resultado as $fila) 
				  	   {
				  	   		//$negritas=substr($fila['espaciobeneficiado'], 0, strlen ($q));
				  	   		//$resto=substr($fila['espaciobeneficiado'], strlen ($q));
				  	   		//$palabra="<b style='color:green;'>".$negritas."</b>".$resto;
				  	   		$salida.="<tr>
					  	   				<td onclick='llenar(".$fila['ID'].")'>".$fila['Nombre']."</td>
					  	   				<td onclick='llenar(".$fila['ID'].")'>".$fila['NoContrato']."</td>
					  	   				<td onclick='llenar(".$fila['ID'].")'>".$fila['espaciobeneficiado']."</td>
					  	   				<td onclick='llenar(".$fila['ID'].")'>".$fila['supervisor']."</td> 
					  	   			</tr>";
				  	   }	
	  	   			break;
	  	   			
	  	   		}
	  	   	   

	  	   }
	  	   else
	  	   {
	  	   	   foreach ($resultado as $fila) 
		  	   {
		  	   		$salida.="<tr>
			  	   				<td onclick='llenar(".$fila['ID'].")'>".$fila['Nombre']."</td>
			  	   				<td onclick='llenar(".$fila['ID'].")'>".$fila['NoContrato']."</td>
			  	   				<td onclick='llenar(".$fila['ID'].")'>".$fila['espaciobeneficiado']."</td>
			  	   				<td onclick='llenar(".$fila['ID'].")'>".$fila['supervisor']."</td> 
			  	   			</tr>";
		  	   }

	  	   }		
	  	   
	  	   $salida.="</tbody></table>";
	}
	else
	{
	  $salida.="No hay datos </br>"." ".$resultado->error;

	}

	echo $salida;
	mysqli_close ($con);
  ?>