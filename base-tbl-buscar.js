    $(opc_buscar).change(function()
    {

        var opc =document.getElementById("opc_buscar").value;
        if(opc != 0)
        {
            //Removemos la clase con la que inicia
            $("#capa").removeClass("bounceInUp");
            //Agregamos la clase con la que sale
            $("#capa").addClass("bounceOutLeft");
            //Ocultamos para que no ocupe espacio
            $("#capa").css("display", "none");
            switch(opc)
            {
                case '1':
                    //Removemos la clase con la que se fue anteriormente
                    $("#capa1").removeClass("bounceOutRight");
                    //Mostramos la nueva clase
                    $("#capa1").css("display", "block");
                    //Agregamos la animacion de entrada
                    $("#capa1").addClass("bounceInRight");
                break;

                case '2':
                    //Removemos la clase con la que se fue anteriormente
                    $("#capa2").removeClass("bounceOutRight");
                    //Mostramos la nueva clase
                    $("#capa2").css("display", "block");
                    //Agregamos la animacion de entrada
                    $("#capa2").addClass("bounceInRight");
                break;

                case '3':
                    //Removemos la clase con la que se fue anteriormente
                    $("#capa3").removeClass("bounceOutRight");
                    //Mostramos la nueva clase
                    $("#capa3").css("display", "block");
                    //Agregamos la animacion de entrada
                    $("#capa3").addClass("bounceInRight");
                break;
            }
        }
            
    });

    function mostrar_opc(opc)
    {
        switch(opc)
        {
            case 1:
                //Removemos la clase con la que inicia
                $("#capa1").removeClass("bounceInRight");
                //Agregamos la clase con la que sale
                $("#capa1").addClass("bounceOutRight");
                 //Ocultamos la capa 
                $("#capa1").css("display", "none");
            break;

            case 2:
                //Removemos la clase con la que inicia
                $("#capa2").removeClass("bounceInRight");
                //Agregamos la clase con la que sale
                $("#capa2").addClass("bounceOutRight");
                 //Ocultamos la capa 
                $("#capa2").css("display", "none");
            break;

            case 3:
                //Removemos la clase con la que inicia
                $("#capa3").removeClass("bounceInRight");
                //Agregamos la clase con la que sale
                $("#capa3").addClass("bounceOutRight");
                 //Ocultamos la capa 
                $("#capa3").css("display", "none");
            break;

        }
        //Mostramos el menu de opc
        $("#capa").css("display", "block");
        $("#capa").removeClass("bounceOutLeft");
        $("#capa").addClass("bounceInLeft");

        //RESETEAMOS EL VALOR DEL SELECT
        $('#opc_buscar').val($('#opc_buscar > option:first').val());
        consultar();
    }

    function consultar(consulta, opc)
    {
        $.ajax({
            url: 'consulta_buscar.php',
            type: 'POST',
            dataType: 'html',
            data: {consulta: consulta, opc : opc},
        })
        .done(function(respuesta) 
        {
            $("#datos").html(respuesta);
        })
        .fail(function() 
        {
            console.log("error");
        });
        
    }


     //LIKE NOMBRE DE LA OBRA
    $(document).on('keyup','#nombreObra', function(){
        var valor = $(this).val();
        if(valor != "")
        {
           consultar(valor,"1");
        }
        else
        {
            consultar();
        }
    });

    //LIKE NUMERO DE CONTRATO 
    $(document).on('keyup','#n_Contrato', function(){
        var valor = $(this).val();
        if(valor != "")
        {
           consultar(valor,"2");
        }
        else
        {
            consultar();
        }
    });


    //LIKE ESPACIO BENEFICIADO 
    $(document).on('keyup','#espacio_B', function(){
        var valor = $(this).val();
        if(valor != "")
        {
           consultar(valor,"3");
        }
        else
        {
            consultar();
        }
    });

    $.fn.extend({
  animateCss: function(animationName, callback) {
    var animationEnd = (function(el) {
      var animations = {
        animation: 'animationend',
        OAnimation: 'oAnimationEnd',
        MozAnimation: 'mozAnimationEnd',
        WebkitAnimation: 'webkitAnimationEnd',
      };

      for (var t in animations) {
        if (el.style[t] !== undefined) {
          return animations[t];
        }
      }
    })(document.createElement('div'));

    this.addClass('animated ' + animationName).one(animationEnd, function() {
      $(this).removeClass('animated ' + animationName);

      if (typeof callback === 'function') callback();
    });

    return this;
  },
});

    var animationEnd = (function(el) {
      var animations = {
        animation: 'animationend',
        OAnimation: 'oAnimationEnd',
        MozAnimation: 'mozAnimationEnd',
        WebkitAnimation: 'webkitAnimationEnd',
      };

      for (var t in animations) {
        if (el.style[t] !== undefined) {
          return animations[t];
        }
      }
    })(document.createElement('div'));