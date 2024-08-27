$('.cotizacionesVenProd').ready(function(){
    cargarCotizaciones("","","");
});
function cargarCotizaciones(fechaInicial,fechaFinal,opcion){
    //CARGAR TABLA DINÁMICA
    var cotizacionesVenProd = $('.cotizacionesVenProd').DataTable({
        "ajax":{
            "type": 'POST',
            "url": "ajax/cotizacion/verCotizaciones.ajax.php",
            "data": {"fechaInicial": fechaInicial,"fechaFinal": fechaFinal,"opcion":opcion},
          },
        "columnDefs": [
            {
                "targets": -1,
                "data": null,
                render: function(data, type, row){
                    if(row[9]=="0"){
                        $data = '<button class="btn btn-warning btnEditarCot" IdClienteCotEd="'+row[10]+'" idCotizacionEditar="'+row[1]+'" title="Editar cotización"><i class="fa fa fa-pencil"></i></button>'
                               +'<button class="btn btn-danger btnEliminarCot" idEliminarCotizacion="'+row[1]+'" title="Eliminar cotización"><i class="fa fa-trash-o"></i></button>';
                    }else{
                        $data = '<button class="btn btn-warning deshabilitarbtnCot btnEditarCot" idCotizacionEditar="'+row[1]+'" title="Editar cotización" disabled><i class="fa fa fa-pencil"></i></button>'
                               +'<button class="btn btn-danger deshabilitarbtnCot btnEliminarCot" idEliminarCotizacion="'+row[1]+'" title="Eliminar cotización" disabled><i class="fa fa-trash-o"></i></button>';
                    }
                    return '<button class="btn btn-success btnVerCotizacion" fechainicial="'+row[7]+'" fechamovimiento="'+row[8]+'" IdCotCliente="'+row[10]+'" idverCotizacion="'+row[1]+'" title="Ver cotización"><i class="fa fa-search-plus"></i></button>'
                           +$data
                           +'<button class="btn btn-info btnImprimirCotizacion" idImprimirCotizacion="'+row[1]+'" title="Imprimir cotización"><i class="fa fa-print"></i></button>'
                }
            },
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
    //actualizar tabla cotizaciones 
    $('#btn_upd_actualizarCot').on('click',function(e){
        localStorage.removeItem("fechaRango");
        localStorage.clear();
        $('#daterange-btn span').html('<i class="fa fa-calendar"></i> Rango de fecha');
        $(".cotizacionesVenProd").dataTable().fnDestroy();
        cargarCotizaciones("","","");
    })
}
/*almacena fecha seleccionada*/
if(localStorage.getItem("fechaRango") != null){
    $('#daterange-btn span').html(localStorage.getItem("fechaRango"));
}else{
    $('#daterange-btn span').html('<i class="fa fa-calendar"></i> Rango de fecha');
}
/*buscat rango fechas*/
$('#daterange-btn').daterangepicker(
    {
      ranges   : {
        'Hoy'       : [moment(), moment()],
        'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
        'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
        'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
        'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate  : moment()
    },
    function (start, end) {
      $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      var fechaInicial = start.format('YYYY-M-DD');
      var fechaFinal = end.format('YYYY-M-DD');
      var fechaRango =$("#daterange-btn span").html();
      localStorage.setItem("fechaRango",fechaRango);
      $(".cotizacionesVenProd").dataTable().fnDestroy();
      if(fechaInicial != fechaFinal){
        cargarCotizaciones(fechaInicial,fechaFinal,"fechadiferente"); 
      }else{
        cargarCotizaciones(fechaInicial,fechaFinal,"fechaigual");
      }
    }
);
//cancelar fecha rango y limpiar localstorage
$(".daterangepicker .range_inputs .cancelBtn").on("click",function(){
    localStorage.removeItem("fechaRango");
    localStorage.clear();
    $(".cotizacionesVenProd").dataTable().fnDestroy();
    $('#daterange-btn span').html('<i class="fa fa-calendar"></i> Rango de fecha');
    cargarCotizaciones("","","");
});