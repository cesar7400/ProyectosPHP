if(JSON.parse(localStorage.getItem("idcompaniesSel")) != null){

    $('.companiesIndicatorsTable').ready(function(){
        //CARGAR TABLA DINÁMICA
        var companiesIndicatorsTables = $('.companiesIndicatorsTable').DataTable({
            "pageLength": 5,
            "bLengthChange": false,
            "ajax":{
                "type": 'POST',
                "url": "ajax/companiesindicators.ajax.php",
                "data": {"idcompany": JSON.parse(localStorage.getItem("idcompaniesSel"))},
            },
            "columnDefs": [
                {
                    "targets": -1,
                    "data": null,
                    render: function(data, type, row){
                        if(row[3] == ""){
                            $data = '<button class="btn btn-default btn-xs btn_idcomp_ind" id="'+row[2]+'" id_indicators="'+row[5]+'" id_company="'+row[6]+'" title="Seleccionar indicador" disabled><i class="fa fa-check"></i></button>'
                        }else{
                            $data = '<button class="btn btn-default btn-xs btn_idcomp_ind" id="'+row[2]+'" id_indicators="'+row[5]+'" id_company="'+row[6]+'" title="Seleccionar indicador"><i class="fa fa-check"></i></button>'
                        }
                        return $data;

                    }
                },
            ],
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

        $('.companiesIndicatorsTable tbody').on('click','button.btn_idcomp_ind',function(){
        
            id = $(this).attr("id");
            id_indicators = $(this).attr("id_indicators");
            id_company = $(this).attr("id_company");

            if(id != "undefined"){
                
                document.cookie ='id_indicators='+id_indicators;
                document.cookie ='id_company='+id_company;
                window.location = "indicatorsel";
            }
        });
    });
}