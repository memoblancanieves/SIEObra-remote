


function validarPDF()
{
   //ARCHIVO DE estado de cuenta 
	$("#estadoCuenta").change(function() 
	{
	         var fileName = this.files[0].name;
   			 var ext = fileName.split('.').pop();
   			 if(ext == "pdf" || ext == "PDF")
   			 {
   			 	//tipo de archivo permitido ahora solo es validar el peso del archivo
   			 	var sizeByte = this.files[0].size;
   			 	
   			 	if(sizeByte <= 20000000)
   			 	{
   			 		//todo esta bien
   			 	}
   			 	else
   			 	{
   			 		alert("El archivo debe pesar menos de 20MB");
   			 		//se tiene que cambiar el tamaño en phpmyadmin para que lo pueda procesar
   			 	}
   			 }
   			 else
   			 {
   			 	alert("Tipo de archivo no permitido, el archivo debe ser PDF");
   			 	this.value = '';
   			 }
   			 
	});

   //ARCHIVO DE ReporteSupervisor
   $("#ReporteSupervisor").change(function() 
   {
            var fileName = this.files[0].name;
             var ext = fileName.split('.').pop();
             if(ext == "pdf" || ext == "PDF")
             {
               //tipo de archivo permitido ahora solo es validar el peso del archivo
               var sizeByte = this.files[0].size;
               
               if(sizeByte <= 20000000)
               {
                  //todo esta bien
               }
               else
               {
                  alert("El archivo debe pesar menos de 20MB");
                  //se tiene que cambiar el tamaño en phpmyadmin para que lo pueda procesar
               }
             }
             else
             {
               alert("Tipo de archivo no permitido, el archivo debe ser PDF");
               this.value = '';
             }
             
   });

   //ARCHIVO DE ReporteSupervisor
   $("#imgReporte").change(function() 
   {
            var fileName = this.files[0].name;
             var ext = fileName.split('.').pop();
             if(ext == "jpg" || ext == "JPG" || ext == "JPEG" || ext == "jpeg")
             {
               //tipo de archivo permitido ahora solo es validar el peso del archivo
               var sizeByte = this.files[0].size;
               
               if(sizeByte <= 20000000)
               {
                  //todo esta bien
               }
               else
               {
                  alert("El archivo debe pesar menos de 20MB");
                  //se tiene que cambiar el tamaño en phpmyadmin para que lo pueda procesar
               }
             }
             else
             {
               alert("Tipo de archivo no permitido, el archivo debe ser JPG");
               this.value = '';
             }
             
   });

}