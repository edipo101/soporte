// CONFIGURACION DEL TOKEN PARA EL AJAX
$.ajaxSetup({
	headers: {
    	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   	}
});
// CONFIGURACION PARA EL TOAST
const opcionesToastr = {
	"closeButton" : true,
	"debug" : false,
	"newestOnTop" : false,
	"progressBar" : true,
	"positionClass" : "toast-top-center",
	"preventDuplicates" : true,
	"onclick" : null,
	"showDuration" : "300",
	"hideDuration" : "1000",
	"timeOut" : "5000",
	"extendedTimeOut" : "1000",
	"showEasing" : "swing",
	"hideEasing" : "linear",
	"showMethod" : "fadeIn",
	"hideMethod" : "fadeOut"
 }
// DIRECCION DE DOMINIO PARA LAS RUTAS
let direccion = location.origin;
// SI LA DIRECCION ES LOCALHOST EN VEZ DE soporte.gams
if(direccion === 'http://localhost' || direccion === 'http://192.168.14.70'){
	direccion +='/soporte/public';
}

//Mostrar datos del ticket
$('#ticket_id').change(function (e) {
	e.preventDefault();
	$("#unidadticket").removeClass('hidden');
	limpiar();
	let optionSelected = $(this).find("option:selected");
	let valueSelected  = optionSelected.val();
	let ruta = `${direccion}/api/tickets/${valueSelected}/ticket`;
	$.get(ruta,function(data){
		$('#tsolicitud').val(data.solicitante);
		$('#empresa').val(data.empresa);
		$('#tobservacion').val(data.observacion);
		$("#unidad_id option[value="+ data.unidad_id +"]").attr("selected",true);
		$("#componente_id option[value="+ data.componente_id +"]").attr("selected",true);
	});
});

// Habilitar Editar ticket
$('#editar-ticket').on('click', function(e){
	e.preventDefault();
	$('#tsolicitud').removeAttr('disabled');
	$('#tobservacion').removeAttr('disabled');
	$('#unidad_id').removeAttr('disabled');
	$('#componente_id').removeAttr('disabled');
	// $("#unidad_id").select2();
	// $("#componente_id").select2();
});

// Desabilitar los campos del ticket
const limpiar = () =>{
	$('#tsolicitud').prop('disabled', true);
	$('#tobservacion').prop('disabled', true);
	$('#unidad_id').prop('disabled', true);
	$('#componente_id').prop('disabled', true);
	// $("#unidad_id").select2('destroy');
	// $("#componente_id").select2('destroy');
}

//Funcion para eliminar la fotografia
const eliminarfoto = id =>{
	let ruta = `${direccion}/fotos/${id}/delete`
	swal({
		title: 'Eliminar Fotografia',
		text: "Seguro que desea eliminar la fotografia",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#d33',
		cancelButtonColor: '#3085d6',
		confirmButtonText: 'Eliminar'
	 }).then((result) => {
		if(result.value){
		   $.ajax({
			  url: ruta,
			  method: 'DELETE',
			  success:function(data){
				 swal(
					'Eliminado!',
					data.mensaje,
					'success'
				 );
				 listarFotos(data.id,data.tipo);
			  }
		   });
		}
	 });
}
// Listar todas las fotos de informe con id
const listarFotos = (id,tipo) =>{
	let ruta = `${direccion}/fotos/apiFotos/${id}/${tipo}`;
	$.ajax({
		url:ruta,
		success:function(data){
		   $("#preview").html(data);
		}
	 });
}

//Funcion para mostar la imagen en un modal
const mostrar = (id,informe)=>{
	let ruta = `${direccion}/fotos/${id}/show`;
	$.get({
		url: ruta,
		success:function(data){
			var ubicacion = `${direccion}/img/fotos/${informe}/${data.carpeta}/${data.nombre}`;
			$('#foto-proceso').attr('src', ubicacion);
			$("#modal-show").modal('show');
		}
	});
}
 

/**
 * ELIMINAR UN REGISTRO CUALQUIERA DEL SISTEMA MANDANDO LA RUTA, NOMBRE DE MODULO, Y TABLA
*/
const eliminar = (ruta,nombre,tabla) =>{
    swal({
        title: `Eliminar ${nombre}`,
        text: `Seguro que desea eliminar el/la ${nombre}`,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Eliminar'
    }).then((result) => {
        console.log('Eliminado');
        if(result.value){
            $.ajax({
                url: ruta,
                method: 'DELETE',
                success:function(data){
                    toastr.options = opcionesToastr;
                    let mensaje = `${nombre.toUpperCase()} se elimino correctamente`;
                    toastr.error(mensaje,'Eliminado!');
                    tabla.ajax.reload(null,false);
                }
            });
        }
    });
};

/**
 * 
*/
const resolver = (ruta,nombre,tabla) =>{
    swal({
        title: `Resolver Ticket`,
        text: `Esta acción marcara el ticket como resuleto y no sera necesario realizar un informe.\n ¿Desea continuar?`,
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Resolver',
		cancelButtonText: 'Cancelar'
    }).then((result) => {        
        if(result.value){
            $.ajax({
                url: ruta,
                method: 'GET',
                success:function(data){
                    toastr.options = opcionesToastr;
                    let mensaje = `${nombre.toUpperCase()} se marco como resuelto`;
                    toastr.info(mensaje,'Resuelto!');
                    tabla.ajax.reload(null,false);
                }
            });
        }
    });
};

/**
 * 
*/
const deshacer = (ruta,nombre,tabla) =>{
    swal({
        title: `Deshacer Ticket Resuelto`,
        text: `Retorna al estado de Ticket Recepcionado.\n ¿Desea continuar?`,
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Continuar',
		cancelButtonText: 'Cancelar'
    }).then((result) => {        
        if(result.value){
            $.ajax({
                url: ruta,
                method: 'GET',
                success:function(data){
                    toastr.options = opcionesToastr;
                    let mensaje = `${nombre.toUpperCase()} se marco como Ticket Recepcionado`;
                    toastr.info(mensaje,'Exito!');
                    tabla.ajax.reload(null,false);
                }
            });
        }
    });
};

// IMPRIME CUALQUIER REGISTRO DEL SISTEMA MANDANDOLE LA RUTA
const imprimir = ruta => {
   const pdfFrame = document.getElementById('pdf')
   pdfFrame.setAttribute('src','');
   setTimeout(()=>{
     pdfFrame.setAttribute('src',ruta);
     $('#modal-imprimir').modal('show')
   },200)
 }
 