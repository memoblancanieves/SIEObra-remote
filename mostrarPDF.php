<?php
	$ruta=$_GET['id'];

	header('content-type: application/pdf');
	readfile($ruta);
?>