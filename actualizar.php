<?php
	include'conexion.php';
	sleep(2);
	//OBTENEMOS LOS DATOS DEL FORMULARIO 
	$n_obra       =  $_POST['n_obra'];
	$n_contrato   =  $_POST['n_contrato'];
	$monto        =  $_POST['monto'];
	$alumnosh     =  $_POST['alumnosh'];
	$alumnosm     =  $_POST['alumnosm'];
	$profesoresh  =  $_POST['profesoresh'];
	$profesoresm  =  $_POST['profesoresm'];
	$fechaInicio  =  $_POST['fechaInicio'];
	$fechaTermino =  $_POST['fechaTermino'];
	$empresa      =  $_POST['empresa'];
	$bitacora     =  $_POST['bitacora'];
	$SEmpresa     =  $_POST['SEmpresa'];
	$GradoEmpresa =  $_POST['GradoEmpresa'];
	$descripcion  =  $_POST['descripcion'];
	$Id_EspacioBeneficiado   =  $_POST['beneficiado'];
	$ID_SupervisorUAEMex     =  $_POST['SUaemex'];


	function insertarTabla(datos)
        {
            
            //ESTA FUNCION SIRVE PARA INSERTAR DATOS EN LA TABLA
            //altas_obras_bitacora
            //altas_obrast_obras
            //altas_obrast_recurso
            console.log("id_altas: "+datos);
            console.log("bitacora:"+t_bitacora)
            console.log("tipo_r: "+tipo_r);
            console.log("tipo_o: "+tipo_o);
            $.ajax({
                // En data puedes utilizar un objeto JSON, un array o un query string
                data: {"id_altas" : datos, "id_bitacora" : t_bitacora, "tipo_r" : tipo_r, "tipo_o" : tipo_o},
                //Cambiar a type: POST si necesario
                type: "GET",
                // Formato de datos que se espera en la respuesta
                dataType: "json",
                // URL a la que se enviará la solicitud Ajax
                url: "AltaRecursos2.php",
            })
             .done(function( data, textStatus, jqXHR ) {
                 if ( console && console.log ) {
                     console.log("¿Es correcto?: "+data.success);
                     console.log( "Arreglo de obra: "+data.obra);
                     console.log("Arreglo de recursos:"+data.recurso);
                 }
             })
             .fail(function( data, jqXHR, textStatus, errorThrown ) {
                 if ( console && console.log ) {
                     console.log( "La solicitud a fallado: " +  data);
                 }
            });

        }
?>