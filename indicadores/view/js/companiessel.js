$('.companiesselTable').ready(function(){
    if($("#idConsult").val() != ""){
        //CARGAR TABLA DINÁMICA
        var companiesSelTables = $('.companiesselTable').DataTable({
            "pageLength": 5,
            "bLengthChange": false,
            "ajax":{
                "type": 'POST',
                "url": "ajax/viewcompanies.ajax.php",
                "data": {"option": "consultant","data": $("#idConsult").val()},
            },
            "columnDefs": [
                {
                    "targets": -2,
                    "data": null,
                    render: function(data, type, row){
                        return '<button class="btn btn-default btn-xs btn_companiesSel" id_companiesSel="'+row[4]+'" nameCompany="'+row[1]+'" title="Seleccionar"><i class="fa fa-check"></i></button>'
                    }
                },
                {
                    "targets": -1,
                    "data": null,
                    render: function(data, type, row){
                        return '<button class="btn btn-default btn-xs btn_companiesSelView" id_companiesSelView="'+row[4]+'" nameCompanyView="'+row[1]+'" title="Ver indicadores"><i class="fa fa-search"></i></button>'
                    }
                }
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

        $('.companiesselTable tbody').on('click','button.btn_companiesSel',function(){

            idcompaniesSel = $(this).attr("id_companiesSel");
            nameCompany = $(this).attr("nameCompany");
            localStorage.setItem('nameCompany', JSON.stringify(nameCompany));
            localStorage.setItem('idcompaniesSel', JSON.stringify(idcompaniesSel));
            window.location = "companiesindicators";
        });

        $('.companiesselTable tbody').on('click','button.btn_companiesSelView',function(){

            idcompaniesSel = $(this).attr("id_companiesSelView");
            nameCompany = $(this).attr("nameCompanyView");
            
            localStorage.setItem('idCompanySelect', JSON.stringify(idcompaniesSel));
            localStorage.setItem('nameCompanySelect', JSON.stringify(nameCompany));
            
            localStorage.setItem('optionSl', JSON.stringify('1'));
            window.location = "viewindicator";
            
        });
    }
});