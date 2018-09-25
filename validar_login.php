<?php
	session_start();
	include'conexion.php';

		$usuario=$_POST['user'];
		$pass=$_POST['pass'];
		$log =mysqli_query($con,"SELECT user FROM  usuarios WHERE user='$usuario' AND password='$pass'");//seleciono la tabla de datos donde el capo Correo sea igual al usuario, li mismo pasa con password
		

		if (mysqli_num_rows($log)>0) 	
		{
			$row = mysqli_fetch_assoc($log);
			$_SESSION["user"] = $row['user'];//inicio sesio
			 echo (1);
			
		}
		else
		{
			echo (0);
		}
?>