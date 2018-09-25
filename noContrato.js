function validar_numero()
{
	var numero = document.getElementById("n_contrato").value;

	$("#n_contrato").removeClass("alert-danger");
	$("#n_contrato").removeClass("alert-success");

	if(numero.length <= 5)
	{
		$("#n_contrato").addClass("alert-danger");
	}
	else
	{
			$.ajax({
			url: 'validar_contrato.php',
			type: 'POST',
			dataType: 'JSON',
			data: {noContrato: numero},
		})
		.done(function(datos) {
			if(datos.resultado)
			{
				console.log("Se repite el numero de contrato");
				$("#n_contrato").addClass("alert-danger");
				alert("El numero de contrato se repite");
			}
			else
			{
				console.log("No se repite el numero de contrato");
				$("#n_contrato").addClass("alert-success");	
			}
			
		})
		.fail(function(XMLHttpRequest) {
			console.log("error: "+XMLHttpRequest.responseText);
		})
		.always(function() {
			
		});

	}
}