<?php
/*
	session_start();
	if(!$_SESSION)
	{
		header('Location: login.php');
	}
    else
    {
        switch ($_SESSION["user"]) 
        {
            case 0://Direccion de Obra Universitara
                $bienvenido="Dirección de Obra Universitaria";  
            break;

            case 1://Jefe de Departamentos
                header('Location: index001.php');
            break;

            case 2://Secretaria de Administracion
                header('Location: index002.php');
            break;

            case 3://Supervisores
                header('Location: index003.php');
            break;
        }
    }
    */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<!-- BOOTSTRAP        -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- ESTILOS CSS-->
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- TITULO -->
	<title>SIEObra</title>
	
</head>
<body>
	<div class="container">

		<!--TITULO-->
		<div class="row" style="margin-bottom: 15px;">
                <!--TITULO DE SIEObras-->
                <div class="col-md-1 logo" style="text-align: center; margin-top: 25px;">
                    <img src="imagenes/10_uaem_movHNormal.png" alt="Imagen no encontrada" style="width: 100%">
                </div>
                <div class="col-md-11" style="text-align: left;">
                    <h1 style="margin-bottom: 0px;">SIEObra</h1>
                    <h3 style="margin-top: 0px;">Sistema de Información Estadistica de Obra Universitaria</h3>
                    <!--LINEA DE COLORES-->
                    <div>
	                	    <div class="panel-heading col-md-4" style="background-color: #2C5234; border-color: #2C5234; margin-bottom: 35px; padding: 4px;" >
	                	    </div>
	                	    
	                	    <div class="panel-heading col-md-8" style="background-color: #9C8412;border-color: #9C8412; margin-bottom: 35px; padding: 4px;" >              
	                	    </div>  
	                </div>
                </div>
        </div>
        
        <div style="margin-left: 15px;">
            <h4>Inicio sesión como: <b> <?php echo $bienvenido."  " ?> </b> <a href="salir.php" style="color:red"> salir</a></h4>
        </div>
        
	               	                	
		<br><br><br>
		<!--OPCIONES-->
		<div class="row">
			<div class="opc" style="margin: 20px 10px;">

				<div class="col-md-3" style="text-align: center;">
					<a href="AltaObras.html">
						<img src="imagenes/nueva2.png" alt="Imagen" style="max-width: 100px;">
						<p>Nueva obra</p>
					</a>
				</div>
				
				<div class="col-md-3" style="text-align: center;">
					<a href="Editar.html">	
						<img src="imagenes/editar.png" alt="Imagen" style="max-width: 100px;">
						<p>Editar</p>
					</a>
				</div>
				
				<div class="col-md-3" style="text-align: center;">
					<a href="Consulta.html">
						<img src="imagenes/consulta.png" alt="Imagen" style="max-width: 100px;">
						<p>Consultar</p>
					</a>
				</div>

				<div class="col-md-3" style="text-align: center;">
					<a href="reportes.html">
						<img src="imagenes/Reportes-128.png" alt="Imagen" style="max-width: 100px;">
						<p>Crear Reportes</p>
					</a>
				</div>
				
			</div>
		</div>
		<br><br>
		<div class="row" style="margin-top: 10px">
			<div class="col-md-3" style="text-align: center;">
				<button type="button" class="btn btn-link" data-toggle="modal" data-target="#VentanaModal3">
					<img src="imagenes/espacio-128.png" alt="Imagen" style="max-width: 100px;">
					<p style="color:#000;">Agregar un nuevo Espacio Beneficiado</p>
				</button>
			</div>
			<div class="col-md-3" style="text-align: center;">
				<button type="button" class="btn btn-link" data-toggle="modal" data-target="#VentanaModal2">
					<img src="imagenes/add_user-128.png" alt="Imagen" style="max-width: 100px;">
					<p style="color:#000;">Agregar un nuevo Supervisor</p>
				</button>
			</div>
            <div class="col-md-3" style="text-align: center;">
                <a href="prologa.html">
                        <img src="imagenes/prologa2-128.png" alt="Imagen" style="max-width: 100px;">
                        <p>Consultar y agregar Prórroga</p>
                </a>
            </div>
            <div class="col-md-3" style="text-align: center;">
                <a href="rimpresos.html">
                        <img src="imagenes/generar-reportes2.png" alt="Imagen" style="max-width: 100px;">
                        <p>Generar reportes impresos</p>
                </a>
            </div>
		</div>

        <div class="row" style="margin-top: 10px">
            <div class="col-12" style="text-align: center;">
                <a href="reporteDigital.html">
                        <img src="imagenes/buscar-128.png" alt="Imagen" style="max-width: 100px;">
                        <p>Consultar Reportes</p>
                </a>
            </div>
        </div>
	</div>


	<div><!-- DESDE AQUI COMIENZA LA VENTANA MODAL DE NUEVO ESPACIO ACADEMICO -->
        <div class="modal fade" id="VentanaModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
          <div class="modal-dialog" role="document" style="width: 800px;">
            <div class="modal-content">
               <div class="alert alert-success animated" id="mnsjEspacioBeneficiado" style="display: none; text-align: center;">...</div>
              <div class="row modal-header" style="margin:0px;">
                <div class="col-sm-10 titulo">
                    <h2 class="modal-title animated bounceInLeft" id="modalTitle">Agregar un nuevo espacio beneficiado</h2>
                </div>
                <div class="col-sm-2" style="text-align: right;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
              </div>
              <div class="modal-Imagen" id="modalImagen" style="text-align: center; margin-top: 15px;">
                    <img src="imagenes/home-128.png" alt="Imagen no encontrada">
              </div>

              <div class="modal-body" id="modalBody" style="text-align: justify;">
                 <div id="formEspacioBeneficiado">
                            <form id="miFormEspacioB">
                                    <div class="row form-group">
                                         <!--ESPACIO BENEFICIADO-->
                                        <div class="col-md-12 form-group">
                                            <label for="beneficiado">Espacio beneficiado</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                        <span class="fa fa-bank"></span>
                                                </span>
                                                <input type="text" class="form-control" id="beneficiado" name="beneficiado" placeholder="Ingrese el nombre del espacio beneficiado" required="Campo obligatorio">
                                            </div>
                                        </div>
                                    
                                    </div>
                                    <div class="row form-group">
                                        <!--DIRECCION DEL ESPACIO BENEFICIADO-->
                                        <div class="col-md-12 form-group">
                                                             
                                            <label for="direccion">Dirección del espacio beneficiado</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                        <span class="fa fa-map-marker"></span>
                                                </span>
                                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingrese la direccion" required="Campo obligatorio">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block" style="border-radius: 0px;">Agregar</button>
                                        </div>
                                    </div>
                        </form>
                 </div>

                            <div id="cargando_EspacioBeneficiado" style="display: none;">
                                <div class="row">
                                    <div class="col-sm-12" style="text-align: center;">
                                        <img src="imagenes/cargando.gif" alt="Imagen no encontrada">
                                    </div>
                                </div>
                            </div>

                            <div id="EspacioBeneficiado_Error" style="display: none;">
                                <div class="row">
                                    <div class="col-sm-12" style="text-align: center;">
                                        <img src="imagenes/Error-128.png" alt="Imagen no encontrada">
                                    </div>
                                    <p class="error_supervisor">
                                        
                                    </p>
                                </div>
                            </div>
              </div><!--AQUI TERMINA modal-body -->
            </div><!--AQUI TERMINA modal-content -->
          </div><!--AQUI TERMINA modal-dialog -->
        </div><!--AQUI TERMINA modal fade -->
    </div><!--AQUI TERMINA LA VENTANA MODAL DE NUEVO ESPACIO ACADEMICO-->

     <div><!-- DESDE AQUI COMIENZA LA VENTANA MODAL DE LA OPCION DE AGREGAR UN NUEVO SUPERVISOR -->
        <div class="modal fade" id="VentanaModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
          <div class="modal-dialog" role="document" style="width: 800px;">
            <div class="modal-content">
            <div class="animated" id="mnsjSupervisorUAMex" style="display: none; text-align: center;">...</div>
              <div class="row modal-header" style="margin:0px;">
                <div class="col-sm-10 titulo">
                    <h2 class="modal-title animated bounceInLeft" id="modalTitle">Agregar un nuevo supervisor</h2>
                </div>
                <div class="col-sm-2" style="text-align: right;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
              </div>
              <div class="modal-Imagen" id="modalImagen" style="text-align: center; margin-top: 15px;">
                    <img src="imagenes/add_user-128.png" alt="Imagen no encontrada">
              </div>

              <div class="modal-body" id="modalBody" style="text-align: justify;">
                     <div id="form_supervisor"  style="display: block;">
                        
                         <form id="miFormSupervisorUAEMex" enctype="multipart/for-data" >
                                        <div class="row form-group">
                                            <!--SUPERVISOR ASIGNADO POR PARTE DE LA UAEMex-->
                                            <div class="col-md-12">
                                                <label for="SUaemex">UAEMex</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                            <span class="fa fa-user"></span>
                                                    </span>
                                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del Supervisor" required="Campo obligatorio">
                                                </div>
                                            </div>
                                        </div>
                         
                                        <div class="row form-group">
                                            <!--GRADO MAXIMO DE ESTUDIOS DEL SUPERVISOR DE LA UAEMex-->
                                            <div class="col-md-6">
                                                <label for="GradoUaemex">Grado</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                            <span class="fa fa-bookmark-o"></span>
                                                    </span>
                                                    <input type="text" class="form-control" id="grado" name="grado" placeholder="Ingrese el grado" required="Campo obligatorio">
                                                </div>
                                            </div>
                                            <!--ADJUNTAR EL CERTIFICADO DEL SUPERVISOR DE LA UAEMex-->
                                            <div class="col-md-6">
                                                <label for="SupervisorUAEMex">Adjuntar el certificado</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                            <span class="fa fa-file"></span>
                                                    </span>
                                                    <input type="file" class="filestyle" data-buttonText="Select a File"  name="SupervisorUAEMex" id="SupervisorUAEMex" accept="application/pdf">
                                                </div>
                                            </div>
                                        </div>
                         
                                        <div class="row form-group">
                                            <div class="col-sm-12">
                                                <button type="submit" id="submit" class="btn btn-primary btn-lg btn-block" style="border-radius: 0px;">Agregar</button>
                                            </div>
                                        </div>
                            </form>
                     </div>

                             <div id="cargando_SupervisorUAEMex" style="display: none;">
                                <div class="row">
                                    <div class="col-sm-12" style="text-align: center;">
                                        <img src="imagenes/cargando.gif" alt="Imagen no encontrada">
                                    </div>
                                </div>
                            </div>

                            <div id="SupervisorUAEMex_Error" style="display: none;">
                                <div class="row">
                                    <div class="col-sm-12" style="text-align: center;">
                                        <img src="imagenes/Error-128.png" alt="Imagen no encontrada">
                                    </div>
                                    <p class="error_supervisor">
                                        
                                    </p>
                                </div>
                            </div>   
                </div><!--AQUI TERMINA EL MODAL BODY-->   
              </div><!--AQUI TERMINA EL modal-content-->
            </div><!--AQUI TERMINA El modal-dialog-->                 
          </div><!-- AQUI TERMINA modal fade-->
     </div><!--AQUI TERMINA LA VENTANA MODAL DE LA OPCION DE AGREGAR UN NUEVO SUPERVISOR-->
	


	<script>
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
                            if(datos.error=="no hay errores")
                            {
                                //LIMPIAMOS LOS DATOS DEL FORMULARIO 
                                document.getElementById("miFormSupervisorUAEMex").reset();
                                //OCULTAMOS LA VENTANA MODAL DE AGREGAR UN NUEVO SUPERVISOR
                                document.getElementById("cargando_SupervisorUAEMex").style.display="none";
                                document.getElementById("form_supervisor").style.display="block";
                                document.getElementById("mnsjSupervisorUAMex").innerHTML="<div class='alert alert-success'>Se agrego correctamente <strong>"+datos.nombre+"</strong></div>";
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
                                //consulta_Select("supervisoruaemex","SUaemex");
                            }
                            else
                            {
                                document.getElementById("mnsjSupervisorUAMex").innerHTML="<div class='alert alert-danger'>"+datos.error+"</div>";
                                document.getElementById("mnsjSupervisorUAMex").style.display="block";
                            }
		                    
		                },
		                error: function(XMLHttpRequest, datos)
		                {
		                   console.log(XMLHttpRequest.responseText);
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
	</script>


</body>

</html>