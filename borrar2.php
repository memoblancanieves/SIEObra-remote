<?php
	

	$ruta='/Archivosssss/UAEM-SAD-010-201899/EmpresaContrato23.pdf';
	if(file_exists($ruta))
	{
		header('content-type: application/pdf');
		echo "Si existe el archivo";
	}
	else
	{
		echo "No se encontro el arhivo";
	}
	
	
?>