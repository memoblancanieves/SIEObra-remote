<?php

	$resultados=mysqli_query($con,"SELECT nombre FROM modulos ");
	if (mysqli_num_rows($resultados)>0) 	
	{
		$i=1;
		foreach ($resultados as $fila) 
		{
			$nombreModulo[$i]=$fila['nombre'];
			$i=$i+1;
		}
	}
?>