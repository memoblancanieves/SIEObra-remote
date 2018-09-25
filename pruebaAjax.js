
var tipo_r = [1,2,3,4,8];

insertarRecurso(2);

function insertarRecurso(datos)
{
            var parametros = {
                "id_alta" : datos,
                "arreglo" : tipo_r
            };
            $.ajax({
                    url:"AltaRecursos2.php",
                    type:"POST",
                    dataType:"html",
                    data:parametros,
                    cache:false,
                    contentType: false,
                    encode:true,
                    processData: false,
                    beforeSend: function()
                    {
                        document.getElementById("vtn_login").style.display="block";
                    },
                    success: function(datos)
                    {
                        document.getElementById("vtn_login").style.display="none";
                        console.log(datos);                           
                    } 
                });

}