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

function Registrar(idP, accion){

nombreP = document.frmPilotos.nombreP.value;
telefonoP = document.frmPilotos.telefonoP.value;
emailP = document.frmPilotos.emailP.value ;

ajax = objetoAjax();
if(accion=='N'){
ajax.open("POST", "../include/clases/pilotos.registrar.php", true);
}else if(accion=='E'){
ajax.open("POST", "../include/clases/pilotos.actualizar.php", true);
}
ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			swal("Muy bien!", "El piloto "+ nombreP +" fue actualizado con exito!", "success");
			setTimeout(function(){
				window.location.reload(true);
			}, 4100);
		}
	}
ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
//ajax.send("nombres="+nombres+"&ocupacion="+ocupacion+"&telefono="+telefono+"&sitioweb="+sitioweb+"&idP="+idP)
ajax.send("nombreP="+nombreP+
		  "&telefonoP="+telefonoP+
		  "&emailP="+emailP+
		  "&idP="+idP)
		  //alert("ya mando el ajax "+nombre)
}

function Eliminar(idP){
if(confirm("En realizad desea eliminar este registro?")){
ajax = objetoAjax();
ajax.open("POST", "../include/clases/clientes.eliminar.php", true);
ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			alert('El registro fue eliminado con exito!');
      window.location.reload(true);
		}
	}
ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("idP="+idP)
}else{
  //Sin acciones
}
}
