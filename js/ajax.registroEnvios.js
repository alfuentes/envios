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

function RecepcionEnvio(idP, accion){
numeroEnvio = document.getElementById('numeroEnvio').value;
piloto = document.frmRecepcion.qPiloto.value;
status = document.frmRecepcion.status.value;
registra = document.frmRecepcion.registra.value;
correo = document.getElementById('notificacion').checked;
firma = document.getElementById('recibido').value;

//alert('ID'+numeroEnvio+' Accion'+accion+' Piloto:'+piloto+' Status:'+status+' Registra:'+registra+' Correo:'+correo+' Firma de Transporte:'+firma);

ajax = objetoAjax();

if(accion=='UD'){
ajax.open("POST", "../include/clases/envios.recibir.php", true);
}else if(accion=='E'){
ajax.open("POST", "../include/clases/pilotos.actualizar.php", true);
}
ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			swal("Muy bien!", "El envio #"+ numeroEnvio +" fue recibido con exito!", "success");
			setTimeout(function(){
				window.location.reload(true);
			}, 4100);
		}
	}
ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
//ajax.send("nombres="+nombres+"&ocupacion="+ocupacion+"&telefono="+telefono+"&sitioweb="+sitioweb+"&idP="+idP)
ajax.send("numeroEnvio="+numeroEnvio+
		  "&piloto="+piloto+
		  "&status="+status+
			"&registra="+registra+
			"&correo="+correo+
		  "&firma="+firma)
		  //alert("ya mando el ajax "+nombre)


}
