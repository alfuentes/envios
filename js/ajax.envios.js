function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
		}
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function registroDistribuidor(idP, accion){

	//tipoEnvio = document.frmEnvioDi.envio.value;
	tipoEnvio = "Distribucion";
	codigoCliente = document.frmEnvioDi.qCliente.value;
	seleccionNombre = document.frmEnvioDi.seleccionNombre.value;
	nombreEnvio = document.frmEnvioDi.nombreEnvio.value;
	codigoTransporte = document.frmEnvioDi.qTransporte.value;
	seleccionDireccion = document.frmEnvioDi.seleccionDireccion.value;
	direccionEnvio = document.frmEnvioDi.direccionEnvio.value;
	codigoPiloto = document.frmEnvioDi.qPiloto.value;
	codigoVendedor = document.frmEnvioDi.qVendedor.value;
	seEnvia = document.frmEnvioDi.seEnvia.value;
	factura = document.frmEnvioDi.factura.value;
	instrucciones = document.frmEnvioDi.instrucciones.value;
	emite = document.frmEnvioDi.emite.value;
	//emite = '<?php echo $_SESSION['usuario']['nombre']; ?>'

	ajax = objetoAjax();

	if(accion=='N'){
		ajax.open("POST", "../include/clases/envios.registrar.php", true);
	}
	else if(accion=='E'){
		ajax.open("POST", "../include/clases/envios.actualizar.php", true);
	}

	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
				swal("Muy bien!", "El envio de "+ tipoEnvio +" fue guardado con exito", "success");
				setTimeout(function(){
					window.location.reload(true);
				}, 4100);
			}
		}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("tipoEnvio="+tipoEnvio+
			"&codigoCliente="+codigoCliente+
			"&seleccionNombre="+seleccionNombre+
			"&nombreEnvio="+nombreEnvio+
			"&codigoTransporte="+codigoTransporte+
			"&seleccionDireccion="+seleccionDireccion+
			"&direccionEnvio="+direccionEnvio+
			"&codigoPiloto="+codigoPiloto+
			"&codigoVendedor="+codigoVendedor+
			"&seEnvia="+seEnvia+
			"&factura="+factura+
			"&instrucciones="+instrucciones+
			"&emite="+emite+
			"&idP="+idP)

			//alert("ya mando el ajax "+tipoEnvio)
}

function registroClienteFinal(idP, accion){
		//tipoEnvio = document.frmEnvioDi.envio.value;


		tipoEnvio = "Cliente Final";
		nombreEnvio = document.frmEnvioCF.nombreEnvio.value;
		telefonoEnvio = document.frmEnvioCF.telefonoEnvio.value;
		codigoTransporte = document.frmEnvioCF.qTransporteCF.value;
		direccionEnvio = document.frmEnvioCF.direccionEnvio.value;
		codigoPiloto = document.frmEnvioCF.qPilotoCF.value;
		codigoVendedor = document.frmEnvioCF.qVendedorCF.value;
		fechaEntrega = document.frmEnvioCF.fechaEntrega.value;
		seEnvia = document.frmEnvioCF.seEnvia.value;
		factura = document.frmEnvioCF.factura.value;
		instrucciones = document.frmEnvioCF.instrucciones.value;
		emite = document.frmEnvioCF.emite.value;



		ajax = objetoAjax();

		if(accion=='N'){
			ajax.open("POST", "../include/clases/envios.registrarCF.php", true);
		}
		else if(accion=='E'){
			ajax.open("POST", "../include/clases/envios.actualizar.php", true);
		}

		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
					swal("Muy bien!", "El envio de "+ tipoEnvio +" fue guardado con exito", "success");
					setTimeout(function(){
						window.location.reload(true);
					}, 4100);
				}
			}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("tipoEnvio="+tipoEnvio+
				"&nombreEnvio="+nombreEnvio+
				"&telefonoEnvio="+telefonoEnvio+
				"&codigoTransporte="+codigoTransporte+
				"&direccionEnvio="+direccionEnvio+
				"&codigoPiloto="+codigoPiloto+
				"&codigoVendedor="+codigoVendedor+
				"&fechaEntrega="+fechaEntrega+
				"&seEnvia="+seEnvia+
				"&factura="+factura+
				"&instrucciones="+instrucciones+
				"&emite="+emite+
				"&idP="+idP)

				//alert("ya mando el ajax "+tipoEnvio)
	}
