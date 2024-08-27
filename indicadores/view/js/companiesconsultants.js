$('.companiesConslts').ready(function(){
    //CARGAR TABLA DINÁMICA
    var companiesConsltss = $('.companiesConslts').DataTable({
        "pageLength": 5,
        "bLengthChange": false,
        "ajax":{
            "type": 'POST',
            "url": "ajax/viewcompaniesconsultant.ajax.php",
            "data": null,
        },
        "columnDefs": [
            {
                "targets": -1,
                "data": null,
                render: function(data, type, row){
                    return '<button class="btn btn-default btn-xs btnViewIndicator" idcompanyView="'+row[4]+'" nameCompanyViewc="'+row[1]+'" title="Seleccionar"><i class="fa fa-check"></i></button>'
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

    $('.companiesConslts tbody').on('click','button.btnViewIndicator',function(){

        idcompaniesSel = $(this).attr("idcompanyView");
        nameCompany = $(this).attr("nameCompanyViewc");

        localStorage.setItem('idCompanySelect', JSON.stringify(idcompaniesSel));
        localStorage.setItem('nameCompanySelect', JSON.stringify(nameCompany));
        
        localStorage.setItem('optionSl', JSON.stringify('2'));
        window.location = "viewindicator";
    });
    $('#btn_updade_consltComp').on('click',function(e){
        companiesConsltss.ajax.reload(null, false);
    });
});