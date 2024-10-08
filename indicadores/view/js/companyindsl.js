$('.infcompanyindicators').ready(function(){
    //CARGAR TABLA DINÁMICA
    var infcompanyindicatorss = $('.infcompanyindicators').DataTable({
        "pageLength": 5,
        "bLengthChange": false,
        "ajax":{
            "type": 'POST',
            "url": "ajax/indicatorshistory.ajax.php",
            "data": {"idCompany": $("#idCompInd").val()},
        },
        "language":{
            "sProcessing":     "Procesando...",
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
        //actualiza tabla indicadores
        $('#btn_upd_ind_comp').on('click',function(e){
            infcompanyindicatorss.ajax.reload(null, false);
        });
});