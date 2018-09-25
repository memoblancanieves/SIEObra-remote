function actualizarColor(id_estadoObra)
{
    $("#colorEstado").removeClass();
    switch(parseInt(id_estadoObra))
    {
        case 0:
            //No se tiene registro -> GRIS
           
        break;

        case 1:
            //Por adjudicar -> BLANCO
            
        break;

        case 2:
            //En proceso  -> AZUL
            $("#colorEstado").addClass("alert alert-info text-center");
        break;

        case 3:
            //Suspendida -> ROJO
             $("#colorEstado").addClass("alert alert-danger text-center");
        break;

        case 4:
            //Concluida sin Equipamiento -> VERDE
            $("#colorEstado").addClass("alert alert-success text-center");
        break;

        case 5:
            //Concluida con Equipamiento  -> VERDE
            $("#colorEstado").addClass("alert alert-success text-center"); 
        break;

        case 6:
            //Terminacion anticipada  -> NARANJA 
            $("#colorEstado").addClass("alert alert-warning text-center");
        break;

        default:
            $("#colorEstado").addClass("text-center"); 
        break;
    }

    console.log("id_estadoObra: "+id_estadoObra);
}