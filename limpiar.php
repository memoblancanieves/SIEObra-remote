<?php
	
	$posicion=0;
	$cadena="UAEM/013/sudo/2018";
	do{
		$posicion=strpos($cadena, "/", $posicion+1);
		if($posicion != 0)
		{
			$cadena[$posicion]="-";	
		}
		
		echo " ".$posicion." ";
	}while($posicion != false);

	echo "Nueva cadena: ".$cadena;
?>