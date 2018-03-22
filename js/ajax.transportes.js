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

nombreT = document.frmTransportes.nombreT.value;
direccionT = document.frmTransportes.direccionT.value;
telefonoT = document.frmTransportes.telefonoT.value;
contactoT = document.frmTransportes.contactoT.value ;
observacionesT = document.frmTransportes.observacionesT.value ;

ajax = objetoAjax();
if(accion=='N'){
ajax.open("POST", "../include/clases/transportes.registrar.php", true);
}else if(accion=='E'){
ajax.open("POST", "../include/clases/transportes.actualizar.php", true);
}
ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			swal("Muy bien!", "El transporte "+ nombreT +" fue guardado con exito", "success");
			setTimeout(function(){
				window.location.reload(true);
			}, 4100);
		}
	}
ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
//ajax.send("nombres="+nombres+"&ocupacion="+ocupacion+"&telefono="+telefono+"&sitioweb="+sitioweb+"&idP="+idP)
ajax.send("nombreT="+nombreT+
		  "&direccionT="+direccionT+
		  "&telefonoT="+telefonoT+
		  "&contactoT="+contactoT+
		  "&observacionesT="+observacionesT+
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
