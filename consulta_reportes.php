<?php
  	include 'conexion.php';

 	$salida = "";

	 if(isset($_POST['id']))
	 {	
	 	$id = $_POST['id'];


	 	$query="SELECT * FROM reportes WHERE IdObra=".$id." ORDER BY NoReporte";
	 	$resultado22 = mysqli_query($con,$query);
		if($resultado22->num_rows > 0)
		{
				//SI ENTRA A ESTA PARTE ES POR QUE ESTA OBRA TIENE REPORTES 
				//OBTENER EL PROGRESO DEL AVANCE FISICO
				$resultadoX=mysqli_query($con,"SELECT SUM(AvanceFisico) AS AvanceFisicoTotal FROM reportes WHERE IdObra =".$id);
				if(mysqli_num_rows($resultadoX)>0)
				{
					foreach ($resultadoX as $fila) 
					{
						$AvanceFisicoTotal=$fila['AvanceFisicoTotal'];
					}
				}
				else
				{
					$AvanceFisicoTotal=0;
				}

				$salida.="
				<div class='row'>
					<div class='col-md-2'>
						<h5 style='margin:0px;'>Avance Fisico</h5>
					</div>
					<div class='progress col-md-10' style='padding:0px;'>
					  <div class='progress-bar' role='progressbar' style='width:".$AvanceFisicoTotal."%;' aria-valuenow='".$AvanceFisicoTotal."' aria-valuemin='0' aria-valuemax='100'>".$AvanceFisicoTotal."%</div>
					</div>
				</div>";

				//OBTENER EL PROGRESO DEL AVANCE FINANCIERO
				$resultadoX=mysqli_query($con,"SELECT SUM(AvanceFinanciero) AS AvanceFinancieroTotal FROM reportes WHERE IdObra =".$id);
				if(mysqli_num_rows($resultadoX)>0)
				{
					foreach ($resultadoX as $fila) 
					{
						$AvanceFinancieroTotal=$fila['AvanceFinancieroTotal'];
					}
				}
				else
				{
					$AvanceFinancieroTotal=0;
				}

				$salida.="
				<div class='row'>
					<div class='col-md-2'>
						<h5 style='margin:0px;'>Avance Financiero</h5>
					</div>
					<div class='progress col-md-10' style='padding:0px;'>
					  <div class='progress-bar' role='progressbar' style='width:".$AvanceFinancieroTotal."%;' aria-valuenow='".$AvanceFinancieroTotal."' aria-valuemin='0' aria-valuemax='100'>".$AvanceFinancieroTotal."%</div>
					</div>
				</div>";
				//OBTENER LOS DATOS PARA LA TABLA DE REPORTES
				include 'documentos_reportes.php';
		  		$salida.="<table class='table table-hover' style='margin:10px 0px; width: 100%;'>
		  				<thead>
		  					<tr>
		  						<th scope='col'>No.</th>
		  						<th scope='col' style='width:100px'>Inicio</th>
		  						<th scope='col' style='width:100px'>Termino</th>
		  						<th scope='col'>A.Fisico</th>
		  						<th scope='col'>A.Financiero</th>
		  						<th scope='col'>Trabajos en proceso</th>
		  						<th scope='col'>E.Cuenta</th>
		  						<th scope='col'>Adicional</th>
		  						<th scope='col'>Imagenes</th>
		  					<tr>
		  				</thead>
		  				<tbody>";

		  		foreach ($resultado22 as $fila) 
			  	{
			  		$fecha1=date("d-m-Y",strtotime($fila['FechaInicio']));
			  		$fecha2=date("d-m-Y",strtotime($fila['FechaTermino']));
			  	  	$salida.="<tr>
				  	  			<td>".$fila['NoReporte']."</td>
				  	  			<td>".$fecha1."</td>
				  	  			<td>".$fecha2."</td>
				  	   			<td>".$fila['AvanceFisico']."% </td>
				  	   			<td>".$fila['AvanceFinanciero']."% </td>
				  	   			<td>".$fila['descripcion']."</td>";

				  	   			//ESTADO DE CUENTA
				  	   			if(strcmp($jsondata[$fila['NoReporte']]["estadoCuenta"], "No se tiene registro") != 0)
				  	   			{

				  	   				$salida.="<td style='text-align: center;'>"."<a href='mostrarPDF.php?id=".$jsondata[$fila['NoReporte']]["estadoCuenta"]."' target='_blank'><button type='button' class='btn btn-link' >Ver</button></a>"."</td>";
				  	   			}
				  	   			else
				  	   			{
				  	   				$salida.="<td>"."<p>".$jsondata[$fila['NoReporte']]["estadoCuenta"]."</p>"."</td>";

				  	   			}

				  	   			//REPORTE DEL SUPERVISOR
				  	   			if(strcmp($jsondata[$fila['NoReporte']]["ReporteSupervisor"], "No se tiene registro") != 0)
				  	   			{
				  	   				$salida.="<td style='text-align:center;'>"."<a href='mostrarPDF.php?id=".$jsondata[$fila['NoReporte']]["ReporteSupervisor"]."' target='_blank'><button type='button' class='btn btn-link' >Ver</button></a>"."</td>";
				  	   			}
				  	   			else
				  	   			{
				  	   				$salida.="<td>"."<p>".$jsondata[$fila['NoReporte']]["ReporteSupervisor"]."</p>"."</td>";

				  	   			}

				  	   			//IMAGENES DE REPORTES 
				  	   			$resultado33=mysqli_query($con,"SELECT * FROM imagenes_reporte WHERE IdReportes=".$fila['id']);
				  	   			if(mysqli_num_rows($resultado33)>0)
				  	   			{
				  	   				/* BOTON DE VERT FOTOS*/

				  	   				$salida.="<td>"."<button type='button'  class='btn btn-link' data-toggle='modal' onclick='cargarImagenes(".$fila['id'].")' data-target='#VentanaModal'><img src='imagenes/photo_32.png'>
                					</button>"."</td>";

                					/*ICONO PARA VER FOTOS
                					$salida.="<td> <img src='imagenes/photo_64.png' alt='imagen' onclick='cargarImagenes(".$fila['id'].")' data-target='#VentanaModal'> </td>";*/
				  	   			}
				  	   			else
				  	   			{
				  	   				$salida.="<td>"."<p>"."No se tiene registro"."</p>"."</td>";
				  	   			}
				  	   			
				  	   			 
				  	   		$salida.="</tr>";
			  	}
		  	   		
		  	   $salida.="</tbody></table>";
		}
		else
		{
		  $salida.="No se han registrado reportes";
		} 
	 	

	 }
	 else
	 {
	 	
	 	$salida="Error no se reconoce el valor del id";
	 }

	echo $salida;
	mysqli_close ($con);
  ?>