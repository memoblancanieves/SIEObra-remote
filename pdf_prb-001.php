<?php
	function comas($m)
	{
		$monto=$m;
		//array vacio para almacernar los digitos
		$array=array();
		$array_final=array();

		//Dividimos de la parte entera y la decimal
		$divide= explode('.',$monto);

		
	    //array_chunk necesita resivir un array al momento de divir los divide como string
		$enteros=str_split($divide[0]);

		$cada3=0;
		$evaluar=3;
		for ($i=1; $i <= count($enteros); $i++) 
		{ 
			$cada3=$cada3+1;
			array_push ( $array , $enteros[count($enteros)-$i]);
			if($cada3 == 3 &&  $i < count($enteros))
			{
				array_push ( $array , ",");
				$cada3=0;
				$evaluar=$evaluar+1;
			}
		}

		for ($i=1; $i <=count($array) ; $i++) 
		{ 
			array_push($array_final, $array[count($array)-$i]);	
		}
		 return $monto = implode("",$array_final).".".$divide[1];
		
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<script type='text/php'>
      	if (isset($pdf))
		{
			
			$pdf->page_text(765, 550, "Pagina {PAGE_NUM} de {PAGE_COUNT}", $font, 9, array(0, 0, 0));
		}
     </script>
	<style type="text/css">
		html {
		margin: 0;
		}
		body {
		font-family: "Times New Roman", serif;
		}
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
			padding-top: 5px;
		}
		.subtitulos
		{
			color:#DF0101;
		}

		.menos
		{
			padding: 0px 1px;
		}
		hr 
		{
			page-break-after: always;
			border: 0;
			margin: 0;
			padding: 0;
		}
		p
		{
			height: 10px;
			margin-bottom: 0.7rem;
			width: 100%;
			
			display: inline-block;
		}
		.puteado
		{
			border-bottom: 1px dotted #000;
		}
		.caja_padre
		{
			
		}
	

	</style>
	<div class=""><!--padre border-padre center -->

		
		
		<?php
			include 'conexion.php';
			$resultado=mysqli_query($con,"SELECT
										altas_obras.ID as id, 
										altas_obras.Nombre as obra, 
										altas_obras.Monto as monto, 
										altas_obras.FechaInicio, 
										altas_obras.FechaTermino,
										reportes.imgReporte as imgReporte, 
										reportes.descripcion as trabajos, 
										reportes.Observaciones,
										espaciobeneficiado.Nombre as espacio 
			FROM reportes INNER JOIN altas_obras ON reportes.IdObra = altas_obras.ID
			INNER JOIN espaciobeneficiado_altaobras ON altas_obras.ID = espaciobeneficiado_altaobras.AltaObrasId
			INNER JOIN espaciobeneficiado ON espaciobeneficiado_altaobras.EspacioBeneficiadoId = espaciobeneficiado.ID  
			WHERE reportes.FechaInicio>='".$fechaInicio."' AND reportes.FechaTermino<='".$fechaTermino."' ORDER BY espaciobeneficiado.orden2");

			
			$contador=0;
			$suma=0;
			$bandera=true;
			if(mysqli_num_rows($resultado)>0)
			{

				foreach ($resultado as $fila) 
				{
					//para obtener el tipo de recurso se hace lo siguiente
					$resultado2=mysqli_query($con,"SELECT t_recursos.Nombre AS recurso 
						FROM altas_obras INNER JOIN altas_obrast_recurso ON altas_obras.ID=altas_obrast_recurso.ID_alta 
						INNER JOIN t_recursos ON altas_obrast_recurso.ID_Recursos=t_recursos.ID 
						WHERE altas_obras.ID=".$fila["id"]);
					$mensaje=" ";

					if(mysqli_num_rows($resultado2)>0)
					{
						foreach ($resultado2 as $fila2) 
						{
							$mensaje.=$fila2["recurso"]." ";
						}
					}
					else
					{
						$mensaje.="No se tiene registrado";
					}
					$contador=$contador+1;
					$suma=$suma+1;

					if($contador==2)
					{
						
						$dis=30;
						$dist_alto=25;
					}
					else
					{
						if($bandera)
						{
							$dist_alto=48;
							$bandera=false;	
						}
						else
						{
							$dist_alto=45;
						}
						
						$dis=5;
					}

					//Para obtener el nombre del arquitecto
					$resultado3=mysqli_query($con,"SELECT s_uaemexaltaobras.S_UAEMexID, supervisoruaemex.Nombre 
						FROM s_uaemexaltaobras 
						INNER JOIN supervisoruaemex ON s_uaemexaltaobras.S_UAEMexID =supervisoruaemex.ID 
						WHERE AltaObrasID=".$fila["id"]);

					foreach ($resultado3 as $fila3) 
					{
					 	$super=$fila3["Nombre"];
					} 

					/*Esto solo se va ser una vez
					//Abrir la imagen
					$original = imagecreatefromjpeg($fila["imgReporte"]);
					$ancho_original=imagesx($original);
					$alto_original=imagesy($original);

					//Crear un lienzo vacio
					$copia = imagecreatetruecolor(200, 200);

					imagecopyresampled($copia, $original, 0, 0, 0, 0,200,200 ,$ancho_original, $alto_original);

					//Exportar y guardar la imagen

					//PARA QUE LAS FECHAS TENGAN EL FORMATO QUE QUIERO
					imagejpeg($copia,$fila["imgReporte"], 100);*/
					$date01 = new DateTime($fechaInicio);
					$date02 = new DateTime($fechaTermino);

					//PARA OBTENER EL TOTAL DEL AVANCE FISICO Y FINANCIERO
					$resultado4=mysqli_query($con,"SELECT SUM(AvanceFisico) as TotalAvanceFisico  , 
						SUM(AvanceFinanciero)  as TotalAvanceFinanciero
						FROM reportes 
						WHERE IdObra=".$fila["id"]);

					foreach ($resultado4 as $fila4) 
					{
					 	$TotalAvanceFinanciero=$fila4["TotalAvanceFinanciero"];
					 	$TotalAvanceFisico=$fila4["TotalAvanceFisico"];
					} 


					if($contador == 1)
					{
						?>
							<div class="titulo" style="width: 940px; margin: auto; margin-bottom: 5px; margin-top: 5px;">
									<pre><h3 style="margin-bottom: 5px">Obras en proceso                                            <cite style="font-size: 9pt; color:#000"><?php echo date_format($date01, 'd-m-Y')." a ".date_format($date02, 'd-m-Y');?><cite></h3></pre>
							</div>
						<?php
					}


					?>
					<div class="caja_padre" style="margin-top:<?php echo $dist_alto."px" ?>; margin-bottom:<?php echo  $dis."px" ?>; height: 260px;">
						<table style="width: 940px; max-height: 260px; margin: auto;">

							<tbody style="max-height: 260px">
								<tr><!--Nueva fila-->
									<td class="titulo2">Espacio</td>
									<td class="titulo2" colspan="4"><?php echo $fila["espacio"]; ?></td>
								</tr>
								
								<tr><!--Nueva fila-->
									<td class="puteado separacion subtitulos">Obra</td>
									<td class="puteado separacion" colspan="3"><?php echo $fila["obra"]; ?></td>
									<td class="separacion" rowspan="5" style="padding: 5px 0px 0px 0px; text-align: center;">
										<img src="<?php echo $fila["imgReporte"];  ?>" alt="No se encontro la imagen" style="max-width:150px; width: 120px; height: 120px;">
									</td>
								</tr>
								
								<tr><!--Nueva fila -->
									<td class="puteado subtitulos menos">Monto</td>
									<td class="puteado menos" colspan="3"><?php echo comas($fila["monto"]); ?></td>
									<!--<td>IMAGEN</td>-->
								</tr>	
								
								<tr><!--Nueva fila-->
									<td class="puteado subtitulos menos">Fecha inicio</td>
									<td class="puteado menos" style="max-width:100px;"><?php echo $fila["FechaInicio"]; ?></td>
									<td class="puteado subtitulos menos">Fecha de término programada</td>
									<td class="puteado"><?php echo $fila["FechaTermino"]; ?></td>
									<!--<td>IMAGEN</td>-->
								</tr>
								
								<tr><!--Nueva fila--->
									<td class="puteado subtitulos menos">Tipo de recurso</td>
									<td class="puteado menos" colspan="3"><?php echo $mensaje ?></td>
									<!--<td>IMAGEN</td>-->
								</tr>
								
								<tr><!--Nueva fila-->
									<td class="puteado subtitulos menos">Avance Fisico</td>
									<td class="puteado menos"><?php echo $TotalAvanceFisico."%"; ?></td>
									<td class="puteado subtitulos menos">Avance Financiero</td>
									<td class="puteado menos"><?php echo $TotalAvanceFinanciero."%"; ?></td>
									<!--<td>IMAGEN</td>-->
								</tr>
								
								<tr><!--Nueva fila-->
									<td class="puteado subtitulos menos">Trabajos en proceso</td>
									<td class="puteado menos" colspan="4" style="font-size: 9pt"><?php echo $fila["trabajos"]; ?></td>
								</tr>
								
								<tr><!--Nueva fila-->
									<td class="puteado subtitulos menos">Observaciones</td>
									<td class="puteado menos" colspan="4" style="font-size: 9pt"><?php echo $fila["Observaciones"]; ?></td>
								</tr>

								<tr><!--Nueva fila-->
									<td class="puteado subtitulos menos">Supervisor</td>
									<td class="puteado menos" colspan="4"><?php echo $super; ?></td>
								</tr>
							</tbody>

							
						
						</table>
						
					</div>
					<p></p>
						
					<?php
					$cantidad=mysqli_num_rows($resultado);
					if($contador==2 && $suma != $cantidad)
					{
						$contador=0;
						?>
							<hr>
						<?php
					}
				

				}
			}
			else
			{
				?>
					<h4 style="text-align: center;">No se tiene registros para las fechas <?php echo $fechaInicio." - ".$fechaTermino ?> </h4>
				<?php
			}
			
		?>
	</div>
	
</body>
</html>