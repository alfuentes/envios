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

codigo = document.frmClientes.codigo.value;
nombre = document.frmClientes.nombre.value;
direccion = document.frmClientes.direccion.value;
departamento = document.frmClientes.qDepartamento.value;
telefono = document.frmClientes.telefono.value;
email = document.frmClientes.email.value;
direccionContacto = document.frmClientes.direccionContacto.value;
contacto = document.frmClientes.contacto.value ;
telefonoContacto = document.frmClientes.telefonoContacto.value ;

ajax = objetoAjax();
if(accion=='N'){
ajax.open("POST", "../include/clases/clientes.registrar.php", true);
}else if(accion=='E'){
ajax.open("POST", "../include/clases/clientes.actualizar.php", true);
}
ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			swal("Muy bien!", "El cliente "+ nombre +" fue guardado con exito", "success");
			setTimeout(function(){
				window.location.reload(true);
			}, 4100);
		}
	}
ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
//ajax.send("nombres="+nombres+"&ocupacion="+ocupacion+"&telefono="+telefono+"&sitioweb="+sitioweb+"&idP="+idP)
ajax.send("codigo="+codigo+
		  "&nombre="+nombre+
		  "&direccion="+direccion+
		  "&departamento="+departamento+
		  "&telefono="+telefono+
		  "&email="+email+
		  "&direccionContacto="+direccionContacto+
		  "&contacto="+contacto+
		  "&telefonoContacto="+telefonoContacto+
		  "&idP="+idP)
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
