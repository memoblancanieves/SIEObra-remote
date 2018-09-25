function consulta_EspaciosB()
{
            console.log("Consultando los espacios beneficiados...");
                    $.ajax({
                        url:"consulta_EspaciosB.php",
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
                            console.log("La consulta ha espacios beneficiados se hizo bien ");
                            var t_re=document.getElementById("beneficiadoSelect");
                            t_re.innerHTML="<option value='0'>Seleccione una opción</option";
                            for (i in datos) 
                            {
                                t_re.innerHTML +=`<option value='${datos[i].id}'>${datos[i].name}</option>`;
                                
                            }
                        },
                        error: function(XMLHttpRequest, datos)
                        {
                           console.log("Error: "+XMLHttpRequest.responseText); 
                        }
                    });

}