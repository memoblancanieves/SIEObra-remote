    
    var Sid = null;
    function listaRecursos() //CARGA LISTA DE TIPO DE RECURSOS DESDE LA BASE DE DATOS
    {
                $.ajax({
                url:"consulta.php?tabla=t_recursos",
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
                    var t_re=document.getElementById("t_recurso");
                    t_re.innerHTML="";
                    for (i in datos) 
                    {
                        t_re.innerHTML +=`
                        <tr>
                            <td><input type='checkbox' name='t_recursos' id='recurso${datos[i].id}' value='${datos[i].id}'></td>
                            <td style="text-align:justify;">${datos[i].name}</td>
                            
                            <td><button type="button" class="btn btn-warning" onclick="editar('${datos[i].id}','${datos[i].name}')">Editar</button></td>
                        </tr>
                        `;
                        
                    }
                    
                }
            });

    }

    


    function listaObras() //CARGA LISTA DE TIPO DE OBRA DESDE LA BASE DE DATOS
    {
            $.ajax({
            url:"consulta.php?tabla=t_obra",
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
                var t_re=document.getElementById("t_obra");
                t_re.innerHTML="";
                for (i in datos) 
                {
                   
                    t_re.innerHTML +=`
                    <tr>
                        <td><input type='checkbox' name='t_obras' id='obra${datos[i].id}' value='${datos[i].id}'></td>
                        <td style="text-align:justify;">${datos[i].name}</td>
                        <td><button type="button" class="btn btn-warning" onclick="editar2('${datos[i].id}','${datos[i].name}')">Editar</button></td>
                    </tr>
                    `;
                        
                }
                    
            }
            });

    }



    function otro() //DAR DE ALTA UN NUEVO TIPO DE RECURSO
    {
        var valor = document.getElementById("otro1").value;
        if (!(valor.trim() == "")) 
        {
                    $.ajax({
                    url:"AltaRecursos.php?nombre="+valor,
                    type:"GET",
                    dataType:"HTML",
                    cache:false,
                    contentType: false,
                    encode:true,
                    processData: false,
                    beforeSend: function()
                    {
                         
                    },
                    success: function(datos)
                    {
                        listaRecursos();
                        document.getElementById("otro1").value="";
                    }
                });
        } 
        else 
        {
            alert("No ha ingresado ningún dato");
        }
    }

   
    function otraObra() //DAR DE ALTA O EDITAR UNA OBRA 
    {
        var valor = document.getElementById("otro2").value;
        if (!(valor.trim() == "")) 
        {
            $.ajax({
                    url:"AltaObras2.php?nombre="+valor,
                    type:"GET",
                    dataType:"HTML",
                    cache:false,
                    contentType: false,
                    encode:true,
                    processData: false,
                    beforeSend: function()
                    {
                         
                    },
                    success: function(datos)
                    {
                        listaObras();
                        document.getElementById("otro2").value="";
                    }
                });
        } 
        else 
        {
            alert("No ha ingresado ningún dato");
        }

    }

    function mostrar(opc)
        {
            if (opc=="0")//MOSTRAR TODO LOS TIPOS DE RECURSOS
            {
                $.ajax({
                    url:"consulta2.php?tabla=t_recursos",
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
                        var t_re=document.getElementById("t_recurso");
                        t_re.innerHTML="";

                        var info="";
                        for (i in datos) 
                        {
                            info+=`
                                <tr>                                
                                <td><input type='checkbox' name='t_recursos' value='${datos[i].id}'></td>    
                            `;

                            if(datos[i].mostrar == 0)
                            {
                                //el estado esta en 0 lo que significa que esta oculto 
                                //por lo cual el boton debe de decir mostrar
                                info+=`
                                     <td style="text-align:justify; color:#A4A4A4;">${datos[i].name}</td>
                                    <td><button type="button" class="btn" onclick="eliminar('${datos[i].id}')">Mostrar</button></td>
                                    <td><button type="button" class="btn" onclick="editar('${datos[i].id}',,'${datos[i].name}')">Editar</button>
                                    </td>
                                `;
                            }
                            else
                            {
                                //el estado esta en 1 lo que signifia que esta visible
                                //por lo cual el boton debe de decir ocultar
                                info+=`
                                    <td style="text-align:justify;">${datos[i].name}</td>
                                    <td><button type="button" class="btn btn-danger" onclick="eliminar('${datos[i].id}')">Ocultar</button></td>
                                    <td><button type="button" class="btn btn-warning" onclick="editar('${datos[i].id}',,'${datos[i].name}')">Editar</button>
                                    </td>
                                   `;
                            }
                            info+=`
                            </tr>
                            `;
                            
                        }

                        t_re.innerHTML+=info;
                        
                    }
                });

                var aux=document.getElementById("mostrar");
                aux.innerHTML=`
                    <h6 style='text-align: center;' onclick='mostrar(1)'>Mostrar menos
                    <i class="fa fa-arrow-up" aria-hidden="true"></i></h6>
                `;

            }
            else//solo mostrar los que estan disponibles
            {
                listaRecursos();
                var aux=document.getElementById("mostrar");
                aux.innerHTML=`
                    <h6 style='text-align: center;' onclick='mostrar(0)'>Mostrar todo
                    <i class="fa fa-long-arrow-down" aria-hidden='true'></i></h6>
                `;
            }

        }

        function eliminar(id) //FUNCION PARA OCULTAR UN ELEMENTO DE TIPO DE RECURSO
        {
               
                $.ajax({
                        url:"mostrarRecursos.php?id="+id,
                        type:"GET",
                        dataType:"HTML",
                        cache:false,
                        contentType: false,
                        encode:true,
                        processData: false,
                        beforeSend: function()
                        {
                             
                        },
                        success: function(datos)
                        {
                            listaRecursos();
                            document.getElementById("otro1").value="";
                        }
                    });
            
            
        }   

        function eliminar2(id) //FUNCION PARA OCULTAR UN ELEMENTO DE TIPO DE OBRA
        {
            $.ajax({
                    url:"mostrarObras.php?id="+id,
                    type:"GET",
                    dataType:"HTML",
                    cache:false,
                    contentType: false,
                    encode:true,
                    processData: false,
                    beforeSend: function()
                    {
                         
                    },
                    success: function(datos)
                    {
                        listaObras();
                    }
                });
        }

        function editar(id, valor) //FUNCION PARA EDITAR UN ELEMENTO DE TIPO RECURSO
        {
            //AQUI ES DONDE SE CAMBIA EL BOTON AGREGAR POR EDITAR
            var original=document.getElementById("otro1");//Tipo de recurso ORIGINAL
            original.value=valor;

            var boton = document.getElementById("btnRecursos");
            boton.innerHTML=`
                <div style="color:#fff; padding-bottom: 0.4em;">-</div>
                <button type="button" id="btnAgregar" class="btn btn-success media-middle" data-toggle="modal"  onclick="cargarRecursos('${id}','${valor}')" data-target="#VentanaModal">Editar
                </button>
            `;
            
        }

        function editar2(id, valor) //FUNCION PARA EDITAR UN ELEMENTO DE TIPO DE OBRA
        {
            //AQUI ES DONDE SE CAMBIA EL BOTON AGREGAR POR EDITAR
            var original=document.getElementById("otro2");//Tipo de recurso ORIGINAL
            original.value=valor;

            var boton = document.getElementById("btnObras");
            boton.innerHTML=`
                <div style="color:#fff; padding-bottom: 0.4em;">-</div>
                <button type="button" id="btnAgregar" class="btn btn-success media-middle" data-toggle="modal"  onclick="cargarRecursos2('${id}','${valor}')" data-target="#VentanaModal">Editar
                </button>
            `;
        }

        function editarRecrusos2(id,t_recurso) //BOTON DE SI PARA EDITAR PARA LA VENTANA MODAL TIPO DE RECURSO 
        {
            var boton = document.getElementById("btnRecursos");
            $.ajax({
                url:"EditarRecursos.php?id="+id+"&nombre="+t_recurso,
                type:"GET",
                dataType:"HTML",
                cache:false,
                contentType: false,
                encode:true,
                processData: false,
                beforeSend: function()
                {
                             
                },
                success: function(datos)
                {
                    listaRecursos();
                    document.getElementById("otro1").value="";
                    boton.innerHTML=`
                        <div style="color:#fff; padding-bottom: 0.4em;">-</div>
                         <button type="button" id="btnAgregar" class="btn btn-success media-middle" name="btnIngresar" onclick="otro()">Agregar
                         </button>
                    `;
                   llenar(Sid);
                }
            });
        }

        function editarObra2(id,t_recurso) //BOTON DE SI PARA EDITAR PARA LA VENTANA MODAL TIPO DE OBRA
        {
            var boton = document.getElementById("btnObras");
            $.ajax({
                url:"EditarObras.php?id="+id+"&nombre="+t_recurso,
                type:"GET",
                dataType:"HTML",
                cache:false,
                contentType: false,
                encode:true,
                processData: false,
                beforeSend: function()
                {
                             
                },
                success: function(datos)
                {
                    listaObras();
                    document.getElementById("otro2").value="";
                    boton.innerHTML=`
                        <div style="color:#fff; padding-bottom: 0.4em;">-</div>
                         <button type="button" id="btnAgregar" class="btn btn-success media-middle" name="btnIngresar" onclick="otraObra()">Agregar
                         </button>
                    `;
                    
                }
            });
        }

        function cancelarRecursos() //BOTON DE CANCELAR PARA LA VENTANA MODAL TIPO DE RECURSO
        {
            document.getElementById("otro1").value="";
            var boton = document.getElementById("btnRecursos");
            boton.innerHTML=`
                <div style="color:#fff; padding-bottom: 0.4em;">-</div>
                 <button type="button" id="btnAgregar" class="btn btn-success media-middle" name="btnIngresar" onclick="otro()">Agregar
                 </button>
            `;
        }

        function cancelarRecursos2() //BOTON DE CANCELAR PARA LA VENTANA MODAL TIPO DE OBRA
        {
            document.getElementById("otro2").value="";
            var boton = document.getElementById("btnObras");
            boton.innerHTML=`
                <div style="color:#fff; padding-bottom: 0.4em;">-</div>
                 <button type="button" id="btnAgregar" class="btn btn-success media-middle" name="btnIngresar" onclick="otraObra()">Agregar
                 </button>
            `;
        }

        function cargarRecursos(id, valor) //VENTANA MODAL PARA TIPO DE RECURSO
        {
            //Cargar Tipo de recurso
            //AQUI ES DONDE SE CARGA LOS DATOS DE LA VENTANA MODAL
            var nuevo = document.getElementById("otro1").value;
            document.getElementById("modalImagen").innerHTML=`<img src="imagenes/Informacion-128.png" alt="Imagen no econtrada">`; 
            if(!(nuevo.trim() == ""))
            {
                document.getElementById("modalTitle").innerHTML="<h4>¿Esta seguro?<h4>";
                document.getElementById("modalBody").innerHTML="¿Esta seguro en cambiar el tipo de recurso <b>"+valor+"</b> a <b>"+nuevo+"</b>,? si continua se actualizara automaticamente el nuevo valor para todas las obras registradas con el tipo de recurso <b>"+valor+"</b> ahora va ser <b>"+nuevo+"</b>";

                
                document.getElementById("modalBotones").innerHTML=`
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cancelarRecursos()">NO, Cancelar
                    </button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" 
                        onclick="editarRecrusos2('${id}','${nuevo}')">Si, Cambiar
                    </button>
                `;
            }
            else
            {
                document.getElementById("modalTitle").innerHTML="¿Estas seguro?";
                document.getElementById("modalBody").innerHTML="El campo esta vacio, por favor intente de nuevo";
            }
        }

        function cargarRecursos2(id, valor) //VENTANA MODAL PARA TIPO DE OBRA
        {
            //Cargar Tipo de Obra
            //AQUI ES DONDE SE CARGA LOS DATOS DE LA VENTANA MODAL
            var nuevo = document.getElementById("otro2").value;
            document.getElementById("modalImagen").innerHTML=`<img src="imagenes/Informacion-128.png" alt="Imagen no econtrada">`; 
            if(!(nuevo.trim() == ""))
            {
                document.getElementById("modalTitle").innerHTML="<h4>¿Esta seguro?<h4>";
                document.getElementById("modalBody").innerHTML="¿Esta seguro en cambiar el tipo de obra <b>"+valor+"</b> a <b>"+nuevo+"</b>,? si continua se actualizara automaticamente el nuevo valor para todas las obras registradas con el tipo de obra <b>"+valor+"</b> ahora va ser <b>"+nuevo+"</b>";

                //AQUI FALTA LLAMAR A LA FUNCION editarRecrusos2(id, t_recurso)
                document.getElementById("modalBotones").innerHTML=`
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cancelarRecursos2()">NO, Cancelar
                    </button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" 
                        onclick="editarObra2('${id}','${nuevo}')">Si, Cambiar
                    </button>
                `;
            }
            else
            {
                document.getElementById("modalTitle").innerHTML="¿Estas seguro?";
                document.getElementById("modalBody").innerHTML="El campo esta vacio, por favor intente de nuevo";
            }
        }


        function cargarRecursos3(opc) //VENTANA MODAL PARA TIPO DE RECURSO
        {
            //FALTO ALGO POR SELECCIONAR AQUI ES DONDE SE MUESTRA EL MENSAJE
            //AQUI ES DONDE SE CARGA LOS DATOS DE LA VENTANA MODAL

            document.getElementById("modalTitle").innerHTML="";
            document.getElementById("modalImagen").innerHTML=`<img src="imagenes/Error-128.png" alt="Imagen no econtrada">`;
            switch(opc)
            {
                case 1://FALTA TIPO DE RECURSO, TIPO DE OBRA, BITACORA

                    document.getElementById("modalBody").innerHTML=`Falta seleccionar algunos campos:
                    <ul>
                        <li>
                            Por favor seleccione por lo menos un <FONT COLOR="red"> <b>Tipo de Recurso</b></FONT>.
                        </li>
                        <li>
                            Por favor seleccione por lo menos un <FONT COLOR="red"> <b>Tipo de Obra</b></FONT>.
                        </li>
                        <li>
                            Por favor seleccione un tipo de <FONT COLOR="red"> <b>Bitacora</b></FONT>.
                        </li>
                    </ul>`;
                break;

                case 2://FATLA EL TIPO DE RECURSO Y TIPO DE OBRA
                    document.getElementById("modalBody").innerHTML=`Falta seleccionar algunos campos: 
                        <ul>
                            <li>
                            Por favor seleccione por lo menos un <FONT COLOR="red"> <b>Tipo de Recurso</b></FONT>.
                            </li>
                            <li>
                            Por favor seleccione por lo menos un <FONT COLOR="red"> <b>Tipo de Obra</b></FONT>.
                            </li>
                        </ul>
                        
                        `;
                break;

                case 3://FALTA EL TIPO DE RECURSO Y BITACORA
                    document.getElementById("modalBody").innerHTML=`Falta seleccionar algunos campos: 
                        <ul>
                            <li>
                            Por favor seleccione por lo menos un <FONT COLOR="red"> <b>Tipo de Recurso</b> </FONT>.
                            </li>
                            <li>
                            Por favor seleccione un tipo de <FONT COLOR="red"> <b>Bitacora</b> </FONT>.
                            </li>
                        </ul>
                        
                        `;
                break;

                case 4://FALTA EL TIPO DE RECURSO
                    document.getElementById("modalBody").innerHTML='Por favor seleccione por lo menos un <FONT COLOR="red"> <b>Tipo de Recurso</b> </FONT>';
                break;

                case 5://FALTA TIPO DE OBRA Y TIPO DE RECURSO
                    document.getElementById("modalBody").innerHTML=`Falta seleccionar algunos campos: 
                        <ul>
                            <li>
                            Por favor seleccione por lo menos un <FONT COLOR="red"> <b>Tipo de Obra</b> </FONT>.
                            </li>
                            <li>
                            Por favor seleccione por lo menos un <FONT COLOR="red"> <b>Tipo de Recurso</b> </FONT>.
                            </li>
                        </ul>
                        
                        `;
                break;

                case 6://FALTA TIPO DE OBRA Y TIPO DE BITACORA
                    document.getElementById("modalBody").innerHTML=`Falta seleccionar algunos campos: 
                        <ul>
                            <li>
                            Por favor seleccione por lo menos un <FONT COLOR="red"> <b>Tipo de Obra</b> </FONT>.
                            </li>
                            <li>
                            Por favor seleccione un tipo de <FONT COLOR="red"> <b>Bitacora</b> </FONT>.
                            </li>
                        </ul>
                        
                        `;
                break;

                case 7://FALTA TIPO DE OBRA
                    document.getElementById("modalBody").innerHTML='Por favor seleccione por lo menos un <FONT COLOR="red"> <b>Tipo de Obra</b> </FONT>.';
                break;

                case 8://FALTA BITACORA Y TIPO DE RECURSO
                    document.getElementById("modalBody").innerHTML=`Falta seleccionar algunos campos: 
                        <ul>
                            <li>
                            Por favor seleccione un tipo de <FONT COLOR="red"> <b>Bitacora</b> </FONT>.
                            </li>
                            <li>
                            Por favor seleccione por lo menos un <FONT COLOR="red"> <b>Tipo de Recurso</b> </FONT>.
                            </li>
                        </ul>
                        
                        `;
                break;

                case 9://FALTA BITACORA Y TIPO DE OBRA
                    document.getElementById("modalBody").innerHTML=`Falta seleccionar algunos campos: 
                        <ul>
                            <li>
                            Por favor seleccione un tipo de <FONT COLOR="red"> <b>Bitacora</b> </FONT>.
                            </li>
                            <li>
                            Por favor seleccione por lo menos un <FONT COLOR="red"> <b>Tipo de Obra</b> </FONT>.
                            </li>
                        </ul>
                        
                        `;
                break;

                case 10://FALTA BITACORA
                    document.getElementById("modalBody").innerHTML='Por favor seleccione un tipo de<FONT COLOR="red"> <b>Bitacora</b> </FONT>.'; 
                break;
            }
                
                

                
            document.getElementById("modalBotones").innerHTML=`
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="cancelarRecursos()">Aceptar
                </button>
                   
            `;
            $("#VentanaModal").modal();//Con esto lanza la ventana modal 
        }