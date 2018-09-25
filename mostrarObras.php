<?php
	include 'conexion.php';
	$id=$_GET["id"];
	$resultado=mysqli_query($con,"SELECT * FROM t_obra WHERE id=$id");

	foreach ($resultado as $fila) 
	{
		$valor=$fila['mostrar'];
	}
	//echo "mostrar vale: ".$valor;
	if($valor == "0")
	{
		$resultado=mysqli_query($con,"UPDATE t_obra SET mostrar='1' WHERE id=$id");
		//echo " Ahora mostrar vale: 1";
	}
	else
	{
		$resultado=mysqli_query($con,"UPDATE t_obra SET mostrar='0' WHERE id=$id");
		//echo " Ahora mostrar vale: 0";	
	}
	
?>