//reiniciar datatable
$(".tablaTipoProducto").dataTable().fnDestroy();
//CARGAR TABLA DINÁMICA
var tablaTipoProducto = $('.tablaTipoProducto').DataTable({
	"ajax":"ajax/tipoproducto/verTipoProducto.ajax.php",
	"columnDefs": [
		{
			"targets": -1,
             "data": 'id',
             render: function(data, type, row){
                 return '<button class="btn btn-warning btnEditarTipoproducto" idTipoPro="'+row[2]+'"><i class="fa fa-pencil"></i></button>'
                       +'<button class="btn btn-danger btnEliminarTipoproducto" idTipoPro="'+row[2]+'" tipoProuducto="'+row[1]+'"><i class="fa fa-trash-o"></i></button>'
             }
        }
    ],
    "language":{
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
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
//actualizar tabla tipo producto
$('#btn_upd_tipoproducto').on('click',function(e){
    tablaTipoProducto.ajax.reload(null, false);
});