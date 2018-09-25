<?php
  	include 'conexion.php';

 	$salida = "";

	 if(isset($_POST['id']))
	 {	
	 	$id = $_POST['id'];


	 	$query="SELECT * FROM prologas WHERE ID_Obra=".$id;
	 	$resultado22 = mysqli_query($con,$query);
		if($resultado22->num_rows > 0)
		{
				
				//OBTENER LOS DATOS PARA LA TABLA DE PROLOGAS
				include 'documentos_Prologa.php';
		  		$salida.="<table class='table table-hover' style='margin:10px 0px; width: 100%;'>
		  				<thead>
		  					<tr>
		  						<th scope='col'>No</th>
		  						<th scope='col'>Fecha de la prologa</th>
		  						<th scope='col'>Documento</th>
		  						<th scope='col'>Observaciones</th>
		  					<tr>
		  				</thead>
		  				<tbody>";

		  		$numero=0;
		  		foreach ($resultado22 as $fila) 
			  	{
			  		$numero=$numero+1;
			  		$fechaFormato=$fecha=date("d-m-Y",strtotime($fila['fecha']));
			  	  	$salida.="<tr>
				  	  			<td>".$numero."</td>
				  	   			<td>".$fechaFormato."</td>";
				  	   	
		
				  	   			//ESTADO DE CUENTA
				  	   			if(strcmp($jsondata[$numero]["estadoCuenta"], "No se tiene registro") != 0)
				  	   			{

				  	   				$salida.="<td>"."<a href='mostrarPDF.php?id=".$jsondata[$numero]["estadoCuenta"]."' target='_blank'><button type='button' class='btn btn-link' >Ver</button></a>"."</td>";
				  	   			}
				  	   			else
				  	   			{
				  	   				$salida.="<td>"."<p>".$jsondata[$numero]["estadoCuenta"]."</p>"."</td>";

				  	   			}


				  	   			$salida.="<td>".$fila['observaciones']."</td>";
				  	   		$salida.="</tr>";
			  	}
		  	   		
		  	   $salida.="</tbody></table>";
		}
		else
		{
			$salida.="<div class='alert alert-info' role='alert'>Esta obra NO tiene prologas actualmente</div>";

		} 
	 	

	 }
	 else
	 {
	 	
	 	$salida="Error no se reconoce el valor del id";
	 }

	echo $salida;
	mysqli_close ($con);
  ?>