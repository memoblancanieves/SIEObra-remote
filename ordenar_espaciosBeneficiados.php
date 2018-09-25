<?php
	include 'conexion.php';
	$contador=0;

	/*
		Verificamos si existen espacios beneficiados nuevos
		-Checamos el campo orden si esta en null se tiene que actualizar
	*/ 

	//Facultades (Nuevas) 
	$resultado01=mysqli_query($con, "SELECT ID, Nombre, orden from espaciobeneficiado WHERE  Nombre like 'facultad%' AND orden is null");
	if(mysqli_num_rows($resultado01) > 0)
	{
		foreach ($resultado01 as $fila) 
		{
			mysqli_query($con, "UPDATE espaciobeneficiado SET orden=1 WHERE ID=".$fila['ID']);
		}
	}

	//Centros Universitarios (Nuevas)
	$resultado01=mysqli_query($con, "SELECT ID, Nombre, orden from espaciobeneficiado WHERE  Nombre like 'Centro Universitario%' AND orden is null");
	if(mysqli_num_rows($resultado01) > 0)
	{
		foreach ($resultado01 as $fila) 
		{
			mysqli_query($con, "UPDATE espaciobeneficiado SET orden=3 WHERE ID=".$fila['ID']);
		}
	}

	//Unidades Academicas (Nuevas)
	$resultado01=mysqli_query($con, "SELECT ID, Nombre, orden from espaciobeneficiado WHERE  Nombre like 'UNIDAD ACAEDMICA%' AND orden is null");
	if(mysqli_num_rows($resultado01) > 0)
	{
		foreach ($resultado01 as $fila) 
		{
			mysqli_query($con, "UPDATE espaciobeneficiado SET orden=4 WHERE ID=".$fila['ID']);
		}
	}

	//Secretaria de Administracion (Nuevas)
	$resultado01=mysqli_query($con, "SELECT ID, Nombre, orden from espaciobeneficiado WHERE  Nombre like 'SECRETARIA DE ADMINIS%' AND orden is null");
	if(mysqli_num_rows($resultado01) > 0)
	{
		foreach ($resultado01 as $fila) 
		{
			mysqli_query($con, "UPDATE espaciobeneficiado SET orden=5 WHERE ID=".$fila['ID']);
		}
	}

	//Secretaria de Cultura fisica y deporte (Nuevas)
	$resultado01=mysqli_query($con, "SELECT ID, Nombre, orden from espaciobeneficiado WHERE  Nombre like 'SECRETARIA DE CULTURA%' AND orden is null");
	if(mysqli_num_rows($resultado01) > 0)
	{
		foreach ($resultado01 as $fila) 
		{
			mysqli_query($con, "UPDATE espaciobeneficiado SET orden=6 WHERE ID=".$fila['ID']);
		}
	}

	//Planteles  (Nuevas)
	$resultado01=mysqli_query($con, "SELECT ID, Nombre, orden from espaciobeneficiado WHERE  Nombre like 'PLANTEL%' AND orden is null");
	if(mysqli_num_rows($resultado01) > 0)
	{
		foreach ($resultado01 as $fila) 
		{
			mysqli_query($con, "UPDATE espaciobeneficiado SET orden=7 WHERE ID=".$fila['ID']);
		}
	}


	/*
		ORDENAR 
	*/

	//Facultades 
	echo "Facultades: "."<br>";
	$resultado=mysqli_query($con, "SELECT  ID,Nombre  from espaciobeneficiado WHERE orden=1 ORDER BY SUBSTRING(nombre,12)");

	if(mysqli_num_rows($resultado) > 0)
	{
		foreach ($resultado as $fila) 
		{
			$contador=$contador+1;
			mysqli_query($con, "UPDATE espaciobeneficiado SET orden2=".$contador." WHERE ID=".$fila['ID']);
			echo $contador.": ".$fila['Nombre'];
			echo "<br>";
		}
	}

	//Centros Universitarios
	echo "Centros Universitarios: "."<br>";
	$resultado=mysqli_query($con, "SELECT  ID,Nombre from espaciobeneficiado WHERE orden=3 ORDER BY SUBSTRING(nombre,26);");

	if(mysqli_num_rows($resultado) > 0)
	{

		foreach ($resultado as $fila) 
		{
			$contador=$contador+1;
			mysqli_query($con, "UPDATE espaciobeneficiado SET orden2=".$contador." WHERE ID=".$fila['ID']);
			echo $contador.": ".$fila['Nombre'];
			echo "<br>";
		}
	}

	//Unidades Académicas
	echo "Unidades Académicas: "."<br>";
	$resultado=mysqli_query($con, "SELECT  ID,Nombre from espaciobeneficiado WHERE orden=4 ORDER BY SUBSTRING(nombre,30);");

	if(mysqli_num_rows($resultado) > 0)
	{

		foreach ($resultado as $fila) 
		{
			$contador=$contador+1;
			mysqli_query($con, "UPDATE espaciobeneficiado SET orden2=".$contador." WHERE ID=".$fila['ID']);
			echo $contador.": ".$fila['Nombre'];
			echo "<br>";
		}
	}

	//Secretaría de Administración
	echo "Secretaría de Administración: "."<br>";
	$resultado=mysqli_query($con, "SELECT  ID,Nombre from espaciobeneficiado WHERE orden=5;");

	if(mysqli_num_rows($resultado) > 0)
	{

		foreach ($resultado as $fila) 
		{
			$contador=$contador+1;
			mysqli_query($con, "UPDATE espaciobeneficiado SET orden2=".$contador." WHERE ID=".$fila['ID']);
			echo $contador.": ".$fila['Nombre'];
			echo "<br>";
		}
	} 

	//Secretaría de Cultura Física y Deporte
	echo "Secretaría de Cultura Física y Deporte: "."<br>";
	$resultado=mysqli_query($con, "SELECT  ID,Nombre from espaciobeneficiado WHERE orden=6;");

	if(mysqli_num_rows($resultado) > 0)
	{

		foreach ($resultado as $fila) 
		{
			$contador=$contador+1;
			mysqli_query($con, "UPDATE espaciobeneficiado SET orden2=".$contador." WHERE ID=".$fila['ID']);
			echo $contador.": ".$fila['Nombre'];
			echo "<br>";
		}
	} 

	//Planteles de la Escuela
	echo "Planteles: "."<br>";
	$resultado=mysqli_query($con, "SELECT  ID,Nombre from espaciobeneficiado WHERE orden=7 ORDER BY SUBSTRING(nombre,9);");

	if(mysqli_num_rows($resultado) > 0)
	{

		foreach ($resultado as $fila) 
		{
			$contador=$contador+1;
			mysqli_query($con, "UPDATE espaciobeneficiado SET orden2=".$contador." WHERE ID=".$fila['ID']);
			echo $contador.": ".$fila['Nombre'];
			echo "<br>";
		}
	}	
?>