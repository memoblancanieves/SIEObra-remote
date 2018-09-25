<?php
	include 'conexion.php';
	$fechaInicio  = $_POST['fechaInicio'];
	$fechaTermino = $_POST['fechaTermino'];
	$opc          = $_POST['opc'];

	$salida="";
	switch ($opc) 
	{
		case '0':
		//OPC: BUSCAR EN TODAS LAS OBRAS
			//SELECT * FROM reportes WHERE FechaInicio >='2018-06-12' AND FechaTermino <='2018-06-18'
			$resultado=mysqli_query($con,"SELECT * FROM reportes WHERE FechaInicio>='".$fechaInicio."' AND FechaTermino<='".$fechaTermino."'");
			
		
			$pdf='<html lang="en">
					<body>
						<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
					';
			if(mysqli_num_rows($resultado)>0)
			{
				
				foreach ($resultado as $fila) 
				{
					$avanceFisico     = $fila['AvanceFisico'];
					$avanceFinanciero = $fila['AvanceFinanciero'];
					$trabajoProceso   = $fila['descripcion'];
					$observaciones    = $fila['Observaciones'];
					$imgReporte       = $fila['imgReporte'];
					
				}
				
				$idObra=$fila['IdObra'];
				$resultado2=mysqli_query($con, "SELECT * FROM altas_obras WHERE ID=".$idObra);
				foreach ($resultado2 as $fila2) 
				{
					$obra  				  = $fila2['Nombre'];
					$monto 				  = $fila2['Monto'];
					$fechaInicioContrato  = $fila2['FechaInicio'];
					$fechaTerminoContrato = $fila2['FechaTermino'];

				}

				$resultado3=mysqli_query($con, "SELECT * FROM altas_obrast_recurso WHERE ID_alta=".$idObra);
				$arrayRecursos=array();
				$n=0;
				foreach ($resultado3 as $fila3) 
				{
					$resultado4=mysqli_query($con, "SELECT * FROM t_recursos WHERE ID=".$fila3['ID_Recursos']);
					if(mysqli_num_rows($resultado4)>0)
					{
						foreach ($resultado4 as $fila4) 
						{
							$arrayRecursos[$n]=$fila4['Nombre'];
							$n=$n+1;
						}
						
					}
					else
					{
						$arrayRecursos[$n]="No se tiene registrado ningun tipo de recurso";
					}
					
					
				}

				$pdf.='<div style="margin:10px 5%;">
							<div class="row">
								<div class="col-md-12" style="border-bottom:2px solid #FE2E2E; color:#FE2E2E">
									<h4><b>Obras en proceso</b></h4>
								</div>
							</div>
							<div class="row" style="border-bottom: 2px solid #04B404; margin-top: 35px;">
								<div class="col-md-6" style=" display: inline-block; color:#04B404">
									<h4>Espacio</h4>
								</div>
								<div class="col-md-6" style=" display: inline-block; color:#04B404">
									<h4>'.$idObra.'</h4>
								</div>
							</div>
							<table style="width:90%; margin: 15px;" class="table">
							  <tr style="width: 100%;">
							    	<th style="color:#FA0202">Obra:</th>
							    	<td colspan="3">Segunda etapa del Centro de Estudios y Enseñanza de Música y Danza de Alto Nivel “Compañía Universitaria de Danza y Escuela de Música”</td>
							    	<th></th>
							    	<td></td>
							    	<td rowspan="3"><img src="Img/prb2.png" align="middle" alt="" style="margin-top: 15px;max-width: 300px"></td>
							  </tr>
							  <tr>
							    	<th style="color:#FA0202">Monto:</th>
							    	<td colspan="3">$12,030,432.53</td>
							  </tr>
							  <tr>
							    	<th style="color:#FA0202">Fecha de inicio:</th>
							    	<td>12/10/2016</td>
							    	<th style="color:#FA0202">Fecha de inicio:</th>
							    	<td>12/10/2016</td>
							  </tr>
							  <tr>
							    	<th style="color:#FA0202">Avance físico:</th>
							    	<td>67.00 %</td>
							    	<th style="color:#FA0202">Avance financiero:</th>
							    	<td>62.00 %</td>
							    	<td></td>
							    	<td></td>
							    	<td></td>
							   </tr>
							   <tr>
							     	<th style="color:#FA0202">Trabajos en proceso:</th>
							    	<td colspan="6">Armado de acero en columnas y muros del segundo nivel, cimbrado de escalera; así como descimbrado de losa 2do nivel. </td>
							   </tr>
							   <tr>
							      <th style="color:#FA0202">Observaciones:</th>
							      <td colspan="6">3a. Prórroga 30/05/2018</td>
							   </tr>
							</table>
						</div>';

			}
			else
			{
				$pdf.="No se encontro, intente de nuevo";
			}
			
			
		break;

		case '1':
		//OPC: BUSCAR EN TIPO DE RECURSO
			$salida.="<h4>En proceso...</h4>";
		break;

		case '2':
			$salida.="<h4>En proceso...</h4>";
		break;
		
		default:
			$salida.="<h4>En proceso...</h4>";
		break;
	}

	$pdf.='</body>
				</html>';
	
	
				$order = array("name" => "Ivan Dimov", "productName" => "Waterproof portable speakers", "productPrice" => "20", "deliveryDate" => "2150");
				
				

				require_once('dompdf/autoload.inc.php');
			  	use Dompdf\Dompdf;

			  	$dompdf = new Dompdf();
			    $dompdf->loadHtml($pdf);
			    $dompdf->setPaper('A4', 'landscape');
			    $dompdf->render();
			    $pdf=$dompdf->output();
			    $filename="reporte.pdf";
			    $dompdf->stream($filename,array("Attachment" =>0));
?>