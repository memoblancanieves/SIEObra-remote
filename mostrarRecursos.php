<?php
	include 'conexion.php';
	$id=$_GET["id"];
	$var2="0";
	$resultado=mysqli_query($con,"SELECT * FROM t_recursos WHERE id=$id");

	foreach ($resultado as $fila) 
	{
		$valor=$fila['mostrar'];
	}
	//echo "mostrar vale: ".$valor;
	if($valor == "0")
	{
		$resultado=mysqli_query($con,"UPDATE t_recursos SET mostrar='1' WHERE id=$id");
		//echo " Ahora mostrar vale: 1";
	}
	else
	{
		$resultado=mysqli_query($con,"UPDATE t_recursos SET mostrar='0' WHERE id=$id");
		//echo " Ahora mostrar vale: 0";	
	}
	
?>