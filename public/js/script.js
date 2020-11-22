var plant = document.getElementById('id_plantilla').value;
if ( plant!= 0 && !isNaN(plant)) {
	plantilla(plant);
}

function plantilla(id_plantilla){
	document.getElementById('id_plantilla').value=id_plantilla;
	$( ".p").removeClass( "select_pla" );
	$( ".plantilla_"+id_plantilla).addClass( "select_pla" );
}

$("#btn_cotizacion_concepto").on("click",function(){
	 document.getElementById('err_nom_cotizacion').innerHTML = '';
	 document.getElementById('err_fecha_ven').innerHTML = '';
	 document.getElementById('err_id_plantilla').innerHTML = '';
	 $.ajax({
		type:'POST',
		url:'/insert_update_cotizacion',
		data:{
			nom_cotizacion: document.getElementById('nom_cotizacion').value,
			razon_cliente: document.getElementById('razon_social_cliente').value,
			rfc_cliente: document.getElementById('rfc_cliente').value,
			fecha_ven: document.getElementById('fecha_ven').value,
			id_plantilla: document.getElementById('id_plantilla').value,
			id_cotizacion: document.getElementById('id_cotizacion').value
		},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data){
			var datos = JSON.parse(data)
			console.log(datos.response);
			if (datos.response == 'success') {
				document.getElementById('id_cotizacion').value =datos.id_cotizacion;
				indexConcepto(datos.id_cotizacion);
				siguiente(2);
			}
		},
		error: function (error) {
			if( error.status === 422 ) {
				var errors = $.parseJSON(error.responseText);
				console.log(errors.errors);
				 $.each( errors.errors, function( key, value) {
	            document.getElementById('err_'+key).innerHTML = value;
	        });
			}
		}
	  });
});

// function pulsar(e) {
// 	if (e.keyCode === 13 && !e.shiftKey) {
// 		e.preventDefault();
$("#btn_concepto_new").on("click",function(){
	document.getElementById('err_input_concepto').innerHTML = '';
	document.getElementById('err_input_cantidad').innerHTML = '';
	document.getElementById('err_input_precioU').innerHTML = '';
	$.ajax({
		type:'POST',
		url:'/insert_concepto',
		data:{
			input_concepto: document.getElementById('input_concepto').value,
			input_cantidad: document.getElementById('input_cantidad').value,
			input_precioU: document.getElementById('input_precioU').value,
			id_cotizacion: document.getElementById('id_cotizacion').value,
		},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data){
			var datos = JSON.parse(data)
			if (datos.response == 'success') {
				indexConcepto(datos.id_cotizacion);
				siguiente(2);
			}else{
				console.log(datos);
			}
		},
		error: function (error) {
			if( error.status === 422) {
				var errors = $.parseJSON(error.responseText);
				$.each( errors.errors, function( key, value) {
	            document.getElementById('err_'+key).innerHTML = value;
	        });
			}
			if (error.status === 404) {
				console.log("ocurrio un error: "+error.status);
			}
		}
	});
});
// 	}
// }

// indexConcepto();
function indexConcepto(id){
	document.getElementById('err_input_concepto').innerHTML = '';
	document.getElementById('err_input_cantidad').innerHTML = '';
	document.getElementById('err_input_precioU').innerHTML = '';

	// $(".errores").value = '';
	// $('.errores').value('');;
	$('.errores').val("")

	$.ajax({
		type:'POST',
		url:'/index_concepto',
		data:{
			id_cotizacion: id,
		},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data){
			console.log(data);
			document.getElementById("input_concepto").value = '';
			document.getElementById("input_cantidad").value = '';
			document.getElementById("input_precioU").value = '';
			document.getElementById('subtotal').value = 0;
			var datos= data.conceptos;
			var sub_general = data.sub_general;//data.sub_general.toFixed(2)
			var iva = data.iva;
			var total = data.total;
			var tabla ='';
			for(var i=0; i<datos.length; i++){
					 tabla += '<tr onkeyup="calc_sub('+"'"+'cantidad'+data.conceptos[i].id_concepto+"'"+','+"'"+'precio_u'+data.conceptos[i].id_concepto+"'"+','+"'"+'sub'+data.conceptos[i].id_concepto+"'"+');">'+
			      '<th scope="row">'+(i+1)+'</th>'+
			      '<td><input name="input_concepto_tab" type="text" value="'+data.conceptos[i].concepto+'" class="input_concepto_d form-control" id="concepto'+data.conceptos[i].id_concepto+'" onclick="editar_c('+data.conceptos[i].id_concepto+');">'+
			      '<small class="text-center errores" id="err_concepto'+data.conceptos[i].id_concepto+'"></small>'+'</td>'+
			      '<td><input name="input_cantidad_tab" type="text" value="'+data.conceptos[i].cantidad+'" class="input_concepto_d form-control" id="cantidad'+data.conceptos[i].id_concepto+'" onclick="editar_c('+data.conceptos[i].id_concepto+');">'+
			      '<small class="text-center errores" id="err_cantidad'+data.conceptos[i].id_concepto+'"></small>'+'</td>'+
			      '<td><input name="input_precioU_tab" type="text" value="'+data.conceptos[i].precio_u+'" class="input_concepto_d form-control" id="precio_u'+data.conceptos[i].id_concepto+'" onclick="editar_c('+data.conceptos[i].id_concepto+');">'+
			      '<small class="text-center errores" id="err_precio_u'+data.conceptos[i].id_concepto+'"></small>'+'</td>'+
			      '<td><input type="text" value="'+data.conceptos[i].subtotal+'" class="input_concepto_sub form-control" id="sub'+data.conceptos[i].id_concepto+'" disabled></td>'+
			     ' <td style="display:flex; justify-content:space-between"><button class="btn btn-second btn-circle btn-sm mx-2 btn_update_c" title="Actualizar" id="btn_update_c'+data.conceptos[i].id_concepto+'" onclick="actualizar_c('+data.conceptos[i].id_concepto+');" ><i class="fas fa-check"></i></button><button onclick="deleted('+data.conceptos[i].id_concepto+');" class="btn bg-gray-300 btn-circle btn-sm"><i class="fas fa-trash"></i></button></td>'+
			    '</tr>';
			}
			document.getElementById("tab_concepto").innerHTML = tabla;
			document.getElementById("sub_general").innerHTML = sub_general;
			document.getElementById("iva").innerHTML = iva;
			document.getElementById("total").innerHTML = total;
		},
		error: function (error) {
			if( error.status === 422 || error.status === 404) {
				console.log("ocurrio un error: "+errors.status);
			}
		}
	});
}
function editar_c(id){
	$('.btn_update_c').hide();
	$('#btn_update_c'+id).show();
}
function TrAgregarC (){
	$('.btn_update_c').hide();
}
function calc_sub(idcantidad,idprecio,idsub){
	var cantidad = document.getElementById(idcantidad).value;
	var precio = document.getElementById(idprecio).value;
	var subtotal = parseInt(cantidad) * parseFloat(precio);

	if( subtotal == null || subtotal == 0 || isNaN(subtotal) ) {
		subtotal = 0;
	}else{
		subtotal = subtotal.toFixed(2);
	}
	document.getElementById(idsub).value = subtotal;

	// console.log(idcantidad+" "+idprecio);
}
function val_int(id){
	var numero = document.getElementById('input_cantidad').value;
	document.getElementById('err_input_cantidad').innerHTML = '';
	if(numero % 1 ==0){
	    console.log("Es entero");
	}else{
	    document.getElementById('err_input_cantidad').innerHTML = 'ingrese una cantidad valida';
	}
}
function val_int2(){
	var valor = document.getElementById('input_precioU').value;
	document.getElementById('err_input_precioU').innerHTML = '';
	let regex = /^\d+(\.\d{1,2})?$/;//solo permite 2 decimales
	var decimal = regex.test(valor);
	if( valor == null || valor.length == 0 || decimal !=true ) {
	  document.getElementById('err_input_precioU').innerHTML = 'Ingrese un precio valido';
	}
}
function actualizar_c(id_concepto){
	var concepto = document.getElementById("concepto"+id_concepto).value;
	var cantidad = document.getElementById("cantidad"+id_concepto).value;
	var precio_u = document.getElementById("precio_u"+id_concepto).value;
	var id_cotizacion = document.getElementById('id_cotizacion').value;
	document.getElementById('err_concepto'+id_concepto).innerHTML = '';
	document.getElementById('err_cantidad'+id_concepto).innerHTML = '';
	document.getElementById('err_precio_u'+id_concepto).innerHTML = '';
	$.ajax({
			type:'POST',
			url:'/update_concepto',
			data:{
				id_concepto: id_concepto,
				concepto: concepto,
				cantidad: cantidad,
				precio_u: precio_u,
				id_cotizacion: id_cotizacion,
			},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success:function(data){
				// console.log(data);
				// if (data.response == 'success') {
				// 	indexConcepto(data.id_cotizacion);
				// }
				var datos = JSON.parse(data)
				if (datos.response == 'success') {
					indexConcepto(datos.id_cotizacion);
					// siguiente(2);
				}else{
					console.log(datos);
				}
			},
			error: function (error) {
				if( error.status === 422) {
				var errors = $.parseJSON(error.responseText);
				$.each( errors.errors, function( key, value) {
					console.log('err_'+key+id_concepto);
	            document.getElementById('err_'+key+id_concepto).innerHTML = value;
	        });
			}
			if (error.status === 404) {
				console.log("ocurrio un error: "+error.status);
			}
			}
		});
}
function deleted(id_concepto){
	$.ajax({
		type:'POST',
		url:'/delete',
		data:{
			id_concepto: id_concepto,
			id_cotizacion: document.getElementById('id_cotizacion').value,
		},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data){
			var datos = JSON.parse(data)
			if (datos.response == 'success') {
				indexConcepto(datos.id_cotizacion);
			}else{
				console.log(datos);
			}
		},
		error: function (error) {
			if( error.status === 422) {
			var errors = $.parseJSON(error.responseText);
			$.each( errors.errors, function( key, value) {
				console.log('err_'+key+id_concepto);
        });
		}
		if (error.status === 404) {
			console.log("ocurrio un error: "+error.status);
		}
		}
	});
}

$("#btn_concepto_termino").on("click",function(){
	document.getElementById('err_termino').value = '';
	var id_cotizacion = document.getElementById('id_cotizacion').value;
	indexTermino(id_cotizacion);
	siguiente(3);
});

$("#btn_termino_new").on("click",function(){
	document.getElementById('err_termino').value = '';
	$.ajax({
		type:'POST',
		url:'/insert_termino',
		data:{
			termino: document.getElementById('input_termino').value,
			id_cotizacion: document.getElementById('id_cotizacion').value,
		},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data){
			var datos = JSON.parse(data)
			if (datos.response == 'success') {
				console.log(datos);
				indexTermino(datos.id_cotizacion);
				siguiente(3);
			}else{
				console.log(datos);
			}
		},
		error: function (error) {
			if( error.status === 422) {
				var errors = $.parseJSON(error.responseText);
				$.each( errors.errors, function( key, value) {
					console.log(key+" "+value);
	            document.getElementById('err_'+key).innerHTML = value;
	        });
			}
			if (error.status === 404) {
				console.log("ocurrio un error: "+error.status);
			}
		}
	});
});

function indexTermino(id){
	document.getElementById('err_termino').innerHTML = '';
	$('.errores').val("")

	$.ajax({
		type:'POST',
		url:'/index_termino',
		data:{
			id_cotizacion: id,
		},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data){
			console.log(data);
			document.getElementById("input_termino").value = '';
			var datos= data.terminos;
			var tabla ='';
			for(var i=0; i<datos.length; i++){
					 tabla += '<tr>'+
					      '<th scope="row">'+(i+1)+'</th>'+
					      '<td>'+
					      	'<textarea name="" id="termino'+data.terminos[i].id_termino+'" cols="30" rows="2" class="form-control input_termino_d" onclick="editar_t('+data.terminos[i].id_termino+');">'+data.terminos[i].termino+'</textarea>'+
					      	'<small class="text-center errores" id="err_termino'+data.terminos[i].id_termino+'"></small>'+
					      '</td>'+
					      '<td style="display:flex; justify-content:flex-end;">'+
					      	'<button class="btn btn-second btn-circle btn-sm mx-2 btn_update_t" title="Actualizar" id="btn_update_t'+data.terminos[i].id_termino+'" onclick="actualizar_t('+data.terminos[i].id_termino+');" ><i class="fas fa-check"></i></button>'+
					      	'<button class="btn bg-gray-300 btn-circle btn-sm" onclick="deleted_t('+data.terminos[i].id_termino+')"><i class="fas fa-trash"></i></button>'+
					      '</td>'+
					    '</tr>';
			}
			document.getElementById("tab_termino").innerHTML = tabla;
		},
		error: function (error) {
			if( error.status === 422 || error.status === 404) {
				console.log("ocurrio un error: "+errors.status);
			}
		}
	});
}
function editar_t(id){
	$('.btn_update_t').hide();
	$('#btn_update_t'+id).show();
}
function TrAgregarT (){
	$('.btn_update_t').hide();
}
function actualizar_t(id_termino){
	var termino = document.getElementById("termino"+id_termino).value;
	var id_cotizacion = document.getElementById('id_cotizacion').value;
	document.getElementById('err_termino'+id_termino).innerHTML = '';
	$.ajax({
		type:'POST',
		url:'/update_termino',
		data:{
			id_termino: id_termino,
			termino: termino,
			id_cotizacion: id_cotizacion,
		},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data){
			var datos = JSON.parse(data)
			if (datos.response == 'success') {
				indexTermino(datos.id_cotizacion);
			}else{
				console.log(datos);
			}
		},
		error: function (error) {
			if( error.status === 422) {
			var errors = $.parseJSON(error.responseText);
			$.each( errors.errors, function( key, value) {
				console.log('err_'+key+id_termino);
            document.getElementById('err_'+key+id_termino).innerHTML = value;
        });
		}
		if (error.status === 404) {
			console.log("ocurrio un error: "+error.status);
		}
		}
	});
}
function deleted_t(id_termino){
	$.ajax({
		type:'POST',
		url:'/delete_t',
		data:{
			id_termino: id_termino,
			id_cotizacion: document.getElementById('id_cotizacion').value,
		},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data){
			var datos = JSON.parse(data)
			if (datos.response == 'success') {
				indexTermino(datos.id_cotizacion);
			}else{
				console.log(datos);
			}
		},
		error: function (error) {
			if( error.status === 422) {
			var errors = $.parseJSON(error.responseText);
			$.each( errors.errors, function( key, value) {
				console.log('err_'+key+id_termino);
        });
		}
		if (error.status === 404) {
			console.log("ocurrio un error: "+error.status);
		}
		}
	});
}

$("input[name=color1]").change(function(){
	var color = $('input[name=color1]').val();
   $(".color1").css("color", color);
   $(".color_subtotal").css('background', color);
});
$("input[name=color2]").change(function(){
	var color = $('input[name=color2]').val();
   // $(".color1").css("color", color);
   $("#head_tabla").css('background', color);
});
$("input[name=color3]").change(function(){
	var color = $('input[name=color3]').val();
   $(".terminos_prev").css('background', color);
});

$("#btn_termino_previa").on("click",function(){
	var id_cotizacion = document.getElementById('id_cotizacion').value;
	indexPrevia(id_cotizacion);
	siguiente(4);
});
$("#guardar_color").on("click",function(){
	var id_cotizacion = document.getElementById('id_cotizacion').value;
	var color_primario = $('input[name=color1]').val();
	var color_tabla = $('input[name=color2]').val();
	var color_termino = $('input[name=color3]').val();
	$.ajax({
		type:'POST',
		url:'/save_color',
		data:{
			id_cotizacion: id_cotizacion,
			color_primario:color_primario,
			color_tabla:color_tabla,
			color_termino:color_termino
		},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data){
			console.log(data);
			indexPrevia(id_cotizacion);
			// document.getElementById('card_body').innerHTML = data;
		},
		error: function (error) {
			if( error.status === 422 || error.status === 404) {
				console.log("ocurrio un error: "+errors.status);
			}
		}
	});
});

function indexPrevia(id){
	document.getElementById('err_termino').innerHTML = '';
	$('.errores').val("");

	$.ajax({
		type:'POST',
		url:'/index_previa',
		data:{
			id_cotizacion: id,
		},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data){
			console.log(data);
			document.getElementById('card_body').innerHTML = data;
			document.getElementById('id_cotizacion_fin').value = id;
			// document.getElementById("input_termino").value = '';
			// var datos= data.terminos;
			// var tabla ='';
			// for(var i=0; i<datos.length; i++){
			// 		 tabla += '<tr>'+
			// 		      '<th scope="row">'+(i+1)+'</th>'+
			// 		      '<td>'+
			// 		      	'<textarea name="" id="termino'+data.terminos[i].id_termino+'" cols="30" rows="2" class="form-control input_termino_d" onclick="editar_t('+data.terminos[i].id_termino+');">'+data.terminos[i].termino+'</textarea>'+
			// 		      	'<small class="text-center errores" id="err_termino'+data.terminos[i].id_termino+'"></small>'+
			// 		      '</td>'+
			// 		      '<td style="display:flex; justify-content:flex-end;">'+
			// 		      	'<button class="btn btn-second btn-circle btn-sm mx-2 btn_update_t" title="Actualizar" id="btn_update_t'+data.terminos[i].id_termino+'" onclick="actualizar_t('+data.terminos[i].id_termino+');" ><i class="fas fa-check"></i></button>'+
			// 		      	'<button class="btn bg-gray-300 btn-circle btn-sm" onclick="deleted_t('+data.terminos[i].id_termino+')"><i class="fas fa-trash"></i></button>'+
			// 		      '</td>'+
			// 		    '</tr>';
			// }
			// document.getElementById("tab_termino").innerHTML = tabla;
		},
		error: function (error) {
			if( error.status === 422 || error.status === 404) {
				console.log("ocurrio un error: "+errors.status);
			}
		}
	});
}