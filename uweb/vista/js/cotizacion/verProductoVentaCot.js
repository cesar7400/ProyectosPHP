var tablaCotizacionProductosVenta = $('.tablaCotizacionProductosVenta').DataTable({
	"ajax":"ajax/cotizacion/cotizacionProductos.ajax.php",
	"columnDefs": [
		{
			"targets": -1,
			"data": null,
			render: function(data, type, row){
				return '<div class="btn-group"><button class="btn btn-primary agregarProducto estadoBoton estbtn'+row[6]+'" idProductoCotizacion valorProductoCot nombreProductoCot>Agregar</button></div>'
			}
		}
	],
	"language": {
		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}

	}

});
/*ACTIVAR LOS BOTONES CON LOS ID CORRESPONDIENTES*/
$(".tablaCotizacionProductosVenta tbody").on( 'click', 'button.agregarProducto', function () {
	var data = tablaCotizacionProductosVenta.row( $(this).parents('tr') ).data();
	$(this).attr("idProductoCotizacion",data[6]); 
	$(this).attr("valorProductoCot",data[4]);
	$(this).attr("nombreProductoCot",data[2]);
});