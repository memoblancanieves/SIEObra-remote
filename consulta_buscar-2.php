<?php
  	include 'conexion.php';

 	$salida = "";
 	//ESTA ES LA CONSULTA ES PARA "OBRAS CON IMPORTE PRESUPUESTARIO"


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
	 	 		$query  = "SELECT ID, Nombre from altas_obras WHERE tipo_importe=0 AND Nombre LIKE '%".$q."%' ";
	 	 	break;

	 	 	case '2':
	 	 		$query  = "SELECT ID, Nombre from altas_obras  WHERE tipo_importe=0 AND NoContrato LIKE '%".$q."%'";
	 	 	break;

	 	 	case '3':
	 	 		$query  = "SELECT altas_obras.ID, altas_obras.Nombre, espaciobeneficiado.Nombre as espaciobeneficiado, supervisoruaemex.Nombre AS supervisor 
				from altas_obras INNER JOIN espaciobeneficiado_altaobras ON espaciobeneficiado_altaobras.AltaObrasId=altas_obras.ID
				INNER JOIN espaciobeneficiado ON espaciobeneficiado.ID=espaciobeneficiado_altaobras.EspacioBeneficiadoId
				INNER JOIN s_uaemexaltaobras ON s_uaemexaltaobras.AltaObrasID=altas_obras.ID
				INNER JOIN supervisoruaemex ON supervisoruaemex.ID=s_uaemexaltaobras.S_UAEMexID WHERE espaciobeneficiado.Nombre LIKE '%".$q."%' WHERE tipo_importe=0";
	 	 	break;
	 	 	
	 	 	default:
	 	 		$salida.="Error en el switch";
	 	 	break;
	 	 } 
	 	

	 }
	 else
	 {
	 	$query  = "SELECT ID, Nombre, NoContrato from altas_obras
				WHERE tipo_importe=0 ORDER BY altas_obras.ID";

	 }

  	$resultado = mysqli_query($con,$query);
  	
	if($resultado)
	{
	  		$salida.="<table class='table table-hover'>
	  				<thead>
	  					<tr>
	  						<th scope='col'>Nombre de la obra</th>
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
			  	   			</tr>";
		  	   }

	  	   }		
	  	   
	  	   $salida.="</tbody></table>";
	}
	else
	{
	  $salida.="No hay datos";
	}

	echo $salida;
	mysqli_close ($con);
  ?>