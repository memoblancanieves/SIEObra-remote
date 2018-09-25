<?php
	session_start();
	if($_SESSION)
	{
		switch ($_SESSION["user"]) 
		{
			case 0://Direccion de Obra Universitara
				header('Location: index000.php');	
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

			case 4://Unidad de planeacion
				header('Location: index004.php');
			break;
		}
		
	}
	
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Inicio</title>
	<!-- BOOTSTRAP        -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <!--COSAS PARA EL MATERIAL DESING-->
	<link rel="stylesheet" href="//fonts.googleapis.com/icon?family=Material+Icons">
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="//storage.googleapis.com/code.getmdl.io/1.0.1/material.teal-red.min.css" />
	<script src="//storage.googleapis.com/code.getmdl.io/1.0.1/material.min.js"></script>
	<!--CSS-->
	<link rel="stylesheet" href="login.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<!--LOGO-->
			<div class="col-md-6 separacion">
					<div class="centrar" style="margin: auto;">
							<div style="margin-top: 28px;">
									<div class="panel-heading col-md-8" style="margin-bottom: 35px; padding: 4px;" >              
							                    </div>
							</div>
							<div style="margin-right: 28px;">
								<!--TITULO DE SIEObras-->
								<div class="logo" style="text-align: center;">
									<img src="imagenes/10_uaem_movHNormal.png" alt="Imagen no encontrada" style="max-width: 200px;">
								</div>
								<div class="col-md-12" style="text-align: center;">
									<br>
									<h2>SIEObra</h2>
									<h4>Sistema de Información Estadistica de Obra Universitaria</h4>
								</div>

								<!--LINEA DE COLORES-->
				                <div class="row">
				                    <div class="col-md-4" style="background-color: #2C5234; border-color: #2C5234; margin-bottom: 35px; padding: 4px;" >
				                    </div>
				                    
				                    <div class="col-md-8" style="background-color: #9C8412;border-color: #9C8412; margin-bottom: 35px; padding: 4px;" >              
				                    </div>  
				                </div>											               
							</div>
					</div>
			</div>
		
			<!--FORMULARIO-->
			<div class="col-md-6 separacion" style="border-left: 1px solid #000;">
				<div class="centrar" style="text-align: center;">
					<div class="espacio">
						<img src="imagenes/user4-128.png" alt="Imagen">
					</div>
					<form id="miFormAltas" >
					  <div class="espacio">
					  	<select class="form-control" name="user">
						  <option value="0">Dirección de Obra Universitaria</option>
						  <option value="1">Jefes de Departamentos</option>
						  <option value="2">Secretaria de Administración</option>
						  <option value="3">Supervisores</option>
						  <option value="4">Unidad de Planeacion</option>
						</select>
					  </div>
					  <div class="espacio">
					  	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
					  	  <input class="mdl-textfield__input color" name="pass" type="password" id="password"/>
					  	  <label class="mdl-textfield__label color" for="password">Contraseña</label>
					  	</div>
					  </div>
					  <div class="row" id="mensaje">
					  	
					  </div>
					  <div class="row">
					  	<div class="col-md-12" style="text-align: center;">
					  		<button type="submit" class="btn btn-outline-success color">Enviar</button>
					  	</div>
					  </div>
					</form>
				</div>
			</div>	
		</div>
	</div>
</body>
	<!-- JQuery           -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <!-- JS de Bootstrap  -->
    <script src="bootstrap-3.3.7-dist/js/bootstrap.js"></script>

    <script>
    	  $("#miFormAltas").on("submit", function(e)//FUNCION AJAX PARA DAR DE ALTA UNA NUEVA OBRA
    	  {
             e.preventDefault();//evita que se recarge la pagina
             var formData = new FormData(document.getElementById("miFormAltas"));
           

            $.ajax({
                    url:"validar_login.php",
                    type:"POST",
                    dataType:"html",
                    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    data:formData,
                    cache:false,
                    contentType: false,
                    encode:true,
                    processData: false,
                    beforeSend: function()
                    {
                        
                    },
                    success: function(datos)
                    {
                        if(datos=="1")
                        {
                        	location.reload();
                        }
                        else
                        {
                        	alert("Usuario y/o Contraseña incorrectos, intente de nuevo");
                        }                           
                    },
                    error: function(XMLHttpRequest,data)
                    {
                      
                    } 
                });
             
          });
    </script>
</html>