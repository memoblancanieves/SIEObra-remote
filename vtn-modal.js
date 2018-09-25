$("#miFormSupervisorUAEMex").on("submit", function(e)//BOTON PARA AGREGAR UN SUPERVISOR
{
            e.preventDefault();//evita que se recarge la pagina
            var formData = new FormData(document.getElementById("miFormSupervisorUAEMex"));
            $.ajax({
                url:"AltaSup_UAEMex.php",
                type:"POST",
                dataType:"json",
                data:formData,
                cache:false,
                contentType: false,
                encode:true,
                processData: false,
                beforeSend: function()
                {
                    document.getElementById("form_supervisor").style.display="none";
                    document.getElementById("cargando_SupervisorUAEMex").style.display="block";   
                },
                success: function(datos)
                {
                    //LIMPIAMOS LOS DATOS DEL FORMULARIO 
                    document.getElementById("miFormSupervisorUAEMex").reset();

                    //OCULTAMOS LA VENTANA MODAL DE AGREGAR UN NUEVO SUPERVISOR
                    document.getElementById("cargando_SupervisorUAEMex").style.display="none";
                    document.getElementById("form_supervisor").style.display="block";
                    document.getElementById("mnsjSupervisorUAMex").innerHTML="Se agrego correctamente <strong>"+datos.nombre+"</strong>";
                    document.getElementById("mnsjSupervisorUAMex").style.display="block";

                    //Hacer que el mensaje desaparesca despues de un tiempo 
                    setTimeout(function(){ 
                        $("#mnsjSupervisorUAMex").addClass("fadeOut");
                    }, 3000);
                    consulta_Select("supervisoruaemex","SUaemex");

                    setTimeout(function(){ 
                        document.getElementById("mnsjSupervisorUAMex").style.display="none";
                        $("#mnsjSupervisorUAMex").removeClass("fadeOut");
                    }, 4000);
                    consulta_Select("supervisoruaemex","SUaemex");
                },
                error: function(XMLHttpRequest, datos)
                {
                   console.log(XMLHttpRequest);
                   console.log(datos.mensajes);
                   document.getElementById("cargando_SupervisorUAEMex").style.display="none";
                   document.getElementById("SupervisorUAEMex_Error").style.display="block";
                   document.getElementById("SupervisorUAEMex_Error").getElementsByTagName("p").innerHTML = "Error "+XMLHttpRequest;  
                }
            });
});


$('#miFormEspacioB').on("submit", function(e)
{
             e.preventDefault();//evita que se recarge la pagina
            var formData = new FormData(document.getElementById("miFormEspacioB"));
            $.ajax({
                url:"AltaEspacioBeneficiado.php",
                type:"POST",
                dataType:"json",
                data:formData,
                cache:false,
                contentType: false,
                encode:true,
                processData: false,
                beforeSend: function()
                {
                    document.getElementById("formEspacioBeneficiado").style.display="none";
                    document.getElementById("cargando_EspacioBeneficiado").style.display="block";   
                },
                success: function(datos)
                {
                    //LIMPIAMOS LOS DATOS DEL FORMULARIO 
                    document.getElementById("miFormEspacioB").reset();

                    //OCULTAMOS LA VENTANA MODAL DE AGREGAR UN NUEVO SUPERVISOR
                    document.getElementById("cargando_EspacioBeneficiado").style.display="none";
                    document.getElementById("formEspacioBeneficiado").style.display="block";
                    document.getElementById("mnsjEspacioBeneficiado").innerHTML="Se agrego correctamente <strong>"+datos.nombre+"</strong>";
                    document.getElementById("mnsjEspacioBeneficiado").style.display="block";

                    //Hacer que el mensaje desaparesca despues de un tiempo 
                    setTimeout(function(){ 
                        $("#mnsjEspacioBeneficiado").addClass("fadeOut");
                    }, 3000);
                    consulta_Select("espaciobeneficiado","beneficiado");

                    setTimeout(function(){ 
                        document.getElementById("mnsjEspacioBeneficiado").style.display="none";
                        $("#mnsjEspacioBeneficiado").removeClass("fadeOut");
                    }, 4000);
                    consulta_Select("supervisoruaemex","SUaemex");
                },
                error: function(XMLHttpRequest, datos)
                {
                   console.log(XMLHttpRequest);
                   console.log(datos.mensajes);
                   document.getElementById("cargando_EspacioBeneficiado").style.display="none";
                   document.getElementById("EspacioBeneficiado_Error").style.display="block";
                   document.getElementById("EspacioBeneficiado_Error").getElementsByTagName("p").innerHTML = "Error "+XMLHttpRequest;  
                }
            });

});


 function consulta_Select(tabla, select)
{
            $.ajax({
                url:"consulta_Select.php?tabla="+tabla,
                type:"GET",
                dataType:"json",
                cache:false,
                contentType: false,
                encode:true,
                processData: false,
                beforeSend: function()
                {
                     
                },
                success: function(datos)
                {
                    var t_re=document.getElementById(select);
                    t_re.innerHTML="<option value='0'>Seleccione una opción</option";
                    for (i in datos) 
                    {
                        t_re.innerHTML +=`<option value='${datos[i].id}'>${datos[i].name}</option>`;
                        
                    }
                    
                },
                error: function(XMLHttpRequest)
                {
                   console.log("erro"+XMLHttpRequest); 
                }
            });

}