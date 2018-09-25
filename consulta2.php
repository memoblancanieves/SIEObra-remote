<?php
	include 'conexion.php';
	$tabla=$_GET['tabla'];
	try 
	{
		
		
		$resultado=mysqli_query($con,"SELECT id, nombre, mostrar FROM $tabla");

		if(mysqli_num_rows($resultado)>0)
		{
			$registros = "[";
			foreach ($resultado as $res) 
			{
				if ($registros != "[") 
				{
					$registros .= ",";
				}
					
				$registros .= '{"name": "'.$res["nombre"].'"';
				$registros .= ',"mostrar": "'.$res["mostrar"].'"';
				$registros .= ',"id": "'.$res["id"].'"}';
					
			}
				
			$registros .= "]";

		}
		else
		{
			$registros = '[{"name":"no se encontro"}]';
		}		
		
		echo ($registros); 
	}
	catch (Exception $e)
	{
		echo "Erro: ". $e->getMessage();
	};
?>