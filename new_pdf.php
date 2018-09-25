<?php

$fechaInicio  = $_POST['fechaInicio'];
$fechaTermino = $_POST['fechaTermino'];
$opc          = $_POST['opc'];
$html ="";


/*
$html.='<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<style type="text/css">
		.padre
		{
			width: 690px;
		}
		.color
		{
			color:#01DF01;
		}
		
		.border
		{
			border: 1px solid #000;
		}
		.border-padre
		{
			border:2px solid #B40404;
			padding: 15px;
		}
		.clean
		{
			clear: both;
		}
		.center
		{
			margin: auto;
		}
		
		.titulo
		{
			border-bottom: 2px solid #DF0101;
			color:#DF0101;
			margin-bottom: 45px;
		}
		
		.titulo2
		{
			border-bottom: 2px solid #088A08;
			color:#088A08;
		}
		.separacion
		{
			padding-top: 15px;
		}
		.subtitulos
		{
			color:#DF0101;
		}
		.menos
		{
			padding: 0px 1px;
		}
		
	</style>
	<div class=""><!--padre border-padre center -->

		<div class="titulo">
			<h3 style="margin-bottom: 5px">Obras en proceso</h3>
		</div>';

			include 'conexion.php';
			$resultado=mysqli_query($con,"SELECT * FROM reportes INNER JOIN altas_obras ON reportes.IdObra = altas_obras.ID  WHERE reportes.FechaInicio>='2018-06-12' AND reportes.FechaTermino<='2018-06-18'");

			if(mysqli_num_rows($resultado)>0)
			{
				foreach ($resultado as $fila) 
				{
					//Obtenemos los datos de la BASE DE DATOS
					$avanceFisico     = $fila['AvanceFisico'];
					$avanceFinanciero = $fila['AvanceFinanciero'];
					$trabajoProceso   = $fila['descripcion'];
					$observaciones    = $fila['Observaciones'];
					$imgReporte       = $fila['imgReporte'];

					
					
					 $html.='
					<div class="caja_padre" style="margin-top: 15px;">
						<table class="">

							<tr><!--Nueva fila-->
								<td class="titulo2">Espacio</td>
								<td class="titulo2" colspan="4">'.$fila["Nombre"].'</td>
							</tr>

							<tr><!--Nueva fila-->
								<td class="separacion subtitulos">Obra</td>
								<td class="separacion" colspan="3">Segunda etapa del Centro de Estudios y Enseñanza de Música y Danza de Alto Nivel “Compañía Universitaria de Danza y Escuela de Música</td>
								<td class="separacion" rowspan="5" style="padding: 5px 0px 0px 0px; text-align: center;"><img src="imagenes/Reporte.jpeg" alt="No se encontro la imagen" style="max-width:250px; width: 250px; height: 250px;"></td>
							</tr>

							<tr><!--Nueva fila -->
								<td class="subtitulos">Monto</td>
								<td colspan="3">$12,030,432.53</td>
								<!--<td>IMAGEN</td>-->
							</tr>	
							
							<tr><!--Nueva fila-->
								<td class="subtitulos">Fecha inicio</td>
								<td style="max-width:100px;">12/10/2016</td>
								<td class="subtitulos">Fecha de término programada</td>
								<td>12/04/2017</td>
								<!--<td>IMAGEN</td>-->
							</tr>

							<tr><!--Nueva fila--->
								<td class="subtitulos">Tipo de recurso</td>
								<td colspan="3">FAMNS 2016</td>
								<!--<td>IMAGEN</td>-->
							</tr>

							<tr><!--Nueva fila-->
								<td class="subtitulos">Avance Fisico</td>
								<td>67.00 %</td>
								<td class="subtitulos">Avance Financiero</td>
								<td>62.00 %</td>
								<!--<td>IMAGEN</td>-->
							</tr>

							<tr><!--Nueva fila-->
								<td class="subtitulos">Trabajos en proceso</td>
								<td colspan="4">Armado de acero en columnas y muros del segundo nivel, cimbrado de escalera; así como descimbrado de losa 2do nivel. </td>
							</tr>	

							<tr><!--Nueva fila-->
								<td class="subtitulos">Observaciones</td>
								<td colspan="4">3a. Prórroga 30/05/2018</td>
							</tr>
						
						</table>
					</div>';
						
											
				}
			}


			include 'conexion.php';
			$resultado=mysqli_query($con,"SELECT * FROM reportes INNER JOIN altas_obras ON reportes.IdObra = altas_obras.ID  WHERE reportes.FechaInicio>='2018-06-12' AND reportes.FechaTermino<='2018-06-18'");

			if(mysqli_num_rows($resultado)>0)
			{
				foreach ($resultado as $fila) 
				{
					//Obtenemos los datos de la BASE DE DATOS
					$avanceFisico     = $fila['AvanceFisico'];
					$avanceFinanciero = $fila['AvanceFinanciero'];
					$trabajoProceso   = $fila['descripcion'];
					$observaciones    = $fila['Observaciones'];
					$imgReporte       = $fila['imgReporte'];

					
					
					 $html.='
					<div class="caja_padre" style="margin-top: 15px;">
						<table class="">

							<tr><!--Nueva fila-->
								<td class="titulo2">Espacio</td>
								<td class="titulo2" colspan="4">'.$fila["Nombre"].'</td>
							</tr>

							<tr><!--Nueva fila-->
								<td class="separacion subtitulos">Obra</td>
								<td class="separacion" colspan="3">Segunda etapa del Centro de Estudios y Enseñanza de Música y Danza de Alto Nivel “Compañía Universitaria de Danza y Escuela de Música</td>
								<td class="separacion" rowspan="5" style="padding: 5px 0px 0px 0px; text-align: center;"><img src="imagenes/Reporte.jpeg" alt="No se encontro la imagen" style="max-width:250px; width: 250px; height: 250px;"></td>
							</tr>

							<tr><!--Nueva fila -->
								<td class="subtitulos">Monto</td>
								<td colspan="3">$12,030,432.53</td>
								<!--<td>IMAGEN</td>-->
							</tr>	
							
							<tr><!--Nueva fila-->
								<td class="subtitulos">Fecha inicio</td>
								<td style="max-width:100px;">12/10/2016</td>
								<td class="subtitulos">Fecha de término programada</td>
								<td>12/04/2017</td>
								<!--<td>IMAGEN</td>-->
							</tr>

							<tr><!--Nueva fila--->
								<td class="subtitulos">Tipo de recurso</td>
								<td colspan="3">FAMNS 2016</td>
								<!--<td>IMAGEN</td>-->
							</tr>

							<tr><!--Nueva fila-->
								<td class="subtitulos">Avance Fisico</td>
								<td>67.00 %</td>
								<td class="subtitulos">Avance Financiero</td>
								<td>62.00 %</td>
								<!--<td>IMAGEN</td>-->
							</tr>

							<tr><!--Nueva fila-->
								<td class="subtitulos">Trabajos en proceso</td>
								<td colspan="4">Armado de acero en columnas y muros del segundo nivel, cimbrado de escalera; así como descimbrado de losa 2do nivel. </td>
							</tr>	

							<tr><!--Nueva fila-->
								<td class="subtitulos">Observaciones</td>
								<td colspan="4">3a. Prórroga 30/05/2018</td>
							</tr>
						
						</table>
					</div>';
						
											
				}
			}
		 


$html.='</div>
	
</body>
</html>';*/



/*

$resultado=mysqli_query($con,"SELECT * FROM reportes INNER JOIN altas_obras ON reportes.IdObra = altas_obras.ID  WHERE reportes.FechaInicio>='".$fechaInicio."' AND reportes.FechaTermino<='".$fechaTermino."'");




if(mysqli_num_rows($resultado)>0)
{
	foreach ($resultado as $fila) 
	{
		//Obtenemos los datos de la BASE DE DATOS
		$avanceFisico     = $fila['AvanceFisico'];
		$avanceFinanciero = $fila['AvanceFinanciero'];
		$trabajoProceso   = $fila['descripcion'];
		$observaciones    = $fila['Observaciones'];
		$imgReporte       = $fila['imgReporte'];

		//Preparamos la plantilla para el PDF
		
		$html.='<div style="width: 298px">
					Espacio
				</div>
				<div calss="color" style="width: 298px float: left;">
					<h4>'.$fila['Nombre'].'</h4>
				</div>';
								
	}
}
else
{

}


$html.='</body>
			</html>';*/


/* Codigo para HTML2PDF
$html2pdf = new Html2Pdf('p', 'A4', 'es', 'true', 'UTF-8');

$html2pdf->writeHTML($html);
$html2pdf->output('pdf_generate.pdf');*/

/*Codigo para domPDF */
			
	
				require_once('dompdf/autoload.inc.php');
			  	use Dompdf\Dompdf;

			  	//Recoger el contenido del otro fichero
				ob_start();
				require_once 'pdf_prb-001.php';
				$html=ob_get_clean();

			  	ini_set("memory_limit", "928M");
			  	
			  	$printpdf = true;

			  	 //Activar la paginacion 
			  	$options = new \Dompdf\Options();
				$options->setIsPhpEnabled(true);

			  	$dompdf = new Dompdf($options);
			    $dompdf->loadHtml($html);
			    $dompdf->setPaper('A4', 'landscape');
				$dompdf->setOptions($options);
			    $dompdf->render();
			    $pdf=$dompdf->output();
			    $filename="reporte.pdf";
			    $dompdf->stream($filename,array("Attachment" =>0));

?>