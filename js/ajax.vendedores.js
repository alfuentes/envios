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

nombreV = document.frmVendedores.nombreV.value;
telefonoV = document.frmVendedores.telefonoV.value;
emailV = document.frmVendedores.emailV.value ;

ajax = objetoAjax();
if(accion=='N'){
ajax.open("POST", "../include/clases/vendedores.registrar.php", true);
}else if(accion=='E'){
ajax.open("POST", "../include/clases/vendedores.actualizar.php", true);
}
ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			swal("Muy bien!", "El vendedor "+ nombreV +" fue actualizado con exito!", "success");
			setTimeout(function(){
				window.location.reload(true);
			}, 4100);
		}
	}
ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
//ajax.send("nombres="+nombres+"&ocupacion="+ocupacion+"&telefono="+telefono+"&sitioweb="+sitioweb+"&idP="+idP)
ajax.send("nombreV="+nombreV+
		  "&telefonoV="+telefonoV+
		  "&emailV="+emailV+
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
