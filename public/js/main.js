
var view_cotizacion = document.getElementById('section_cotizacion');
var view_concepto = document.getElementById('section_concepto');
var view_termino = document.getElementById('section_termino');
var view_previa = document.getElementById('section_vista_previa');

var step_1 = document.getElementById('step_1');
var step_2 = document.getElementById('step_2');
var step_3 = document.getElementById('step_3');
var step_4 = document.getElementById('step_4');

function siguiente(view){
    var id_cotizacion = document.getElementById('id_cotizacion').value;
	var vistas ={1:view_cotizacion,2:view_concepto,3:view_termino,4:view_previa};
	var step ={1:step_1,2:step_2,3:step_3,4:step_4};
	// var index ={1:'view_cotizacion',2:'view_concepto',3:'view_termino',4:'view_previa'};
	var contador =1;
	for(var key in vistas){
		if (view == key) {
            if (id_cotizacion!=0) {
                vistas[key].style.display='block';
                step[key].style.backgroundColor='#F8A100';
            }else{
                alert("agrega una cotizacion");
                vistas[1].style.display='block';
                step[1].style.backgroundColor='#F8A100';
            }
		}else{
			vistas[key].style.display='none';
			step[key].style.backgroundColor='#B6A19E';
		}
		contador ++;
	}

}

// function Index(){
// 	$.ajax({
//     type:'POST',
//     url:'/insert_update_cotizacion',
//     data:{
//       nombre: document.getElementById('nom_cotizacion').value,
//       razon_cliente: document.getElementById('razon_social_cliente').value,
//       rfc_cliente: document.getElementById('rfc_cliente').value,
//       fecha_ven: document.getElementById('fecha_ven').value,
//       id_plantilla: document.getElementById('id_plantilla').value,
//       id_cotizacion: document.getElementById('id_cotizacion').value
//     },
//     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//     success:function(data){
//     }
//   });
// }

// function plantilla(id_plantilla){
// 	// alert(id_plantilla);
// 	// var arr_plantillas ={1:id_plantilla_1,2:id_plantilla_2,3:id_plantilla_3,4:id_plantilla_4};
// 	// var plantilla =document.getElementById('plantilla_'+id_plantilla);
// 	// document.getElementById('plantilla_1').style.border="4px solid red";
// 	$("#plantilla_1").css({'border':'red'});
// 	// document.getElementById('plantilla_4').style.border ='4px';
// 	// for(var i = 1; i<5; i++){
// 	// 	if (id_plantilla == i) {
// 	// 		document.getElementById('plantilla_'+i).style.borderColor = "#F8A100";
// 	// 		document.getElementById('plantilla_'+i).style.border ='4px';
// 	// 		// console.log('pintar: plantilla_'+i);
// 	// 	}else{
// 	// 		// console.log('No pintar: plantilla_'+i);
// 	// 		document.getElementById('plantilla_'+i).style.borderColor = "#B6A19E";
// 	// 		document.getElementById('plantilla_'+i).style.border ='4px';
// 	// 	}
// 	// }
// }
// prueba
// $(document).ready(function(){
//     $("#plantilla_1").on("click",function(){
// 	    $("#plantilla_1").css("border", "4px solid red");
// 	    // alert("kk");
//     });
// });
// owlCarousel plantillas
$(document).ready(function(){
    $('.owl-carousel').owlCarousel({
        loop:true,
        // center: true,
        margin:30,
        nav:true,
        // items:2,
        responsive:{
        0:{
        items:1
        },
        100:{
        items:4
        }
        }
    })
});

$(function () {
// $("#example1").DataTable();
//   $('#example2').DataTable({
//     "paging": true,
//     "lengthChange": false,
//     "searching": false,
//     "ordering": true,
//     "info": true,
//     "autoWidth": true,
//   });
// id="dataTable"
  var table=$('.datatable').DataTable({
      "iDisplayLength": 10,
       "destroy": true,
      searching: true,
      "bLengthChange": true,
      "lengthChange": true,
      "info": true,
      "paging": true,
      language: {
         "sProcessing": "Procesando...",
         "sLengthMenu": "Mostrar _MENU_ registros",
         "sZeroRecords": "No se encontraron resultados",
         "sEmptyTable": "Ningún dato disponible en esta tabla",
         "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
         "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
         "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
         "sSearch": "Buscar:",
         "sLoadingRecords": "Cargando...",
         "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
         }
      },
      "order": [ [0, 'DESC'] ]
  });

  });
  // table.on('order.dt search.dt', function() {
  //   table.column(0, { search: 'applied', order: 'applied' }).nodes().each(function(cell, i) {
  //     cell.innerHTML = i + 1;
  //   });
  // }).draw();