<?php

echo  comas("589.00");

function comas($m)
{
	$monto=$m;
	//array vacio para almacernar los digitos
	$array=array();
	$array_final=array();

	//Dividimos de la parte entera y la decimal
	$divide= explode('.',$monto);

	echo "<pre>";
	print_r($divide);
	echo "</pre>";
    
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

