

function validar_extension(archivo, validar)
{
	if(!archivo)
	{
		return "No se ha seleccionado ningun archivo";
	}
	else
	{
		//Extraer la extension del archivo
		extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();

		//Comprobar que sea una extension valida
		if(extension == validar)
		{
			return true;
		}
		else
		{
			return false;
		}  
	}
}