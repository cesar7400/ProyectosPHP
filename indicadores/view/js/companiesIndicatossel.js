$('.companiesTableindSel').ready(function(){
    //CARGAR TABLA DINÁMICA
    var companiesTableindSels = $('.companiesTableindSel').DataTable({
        "pageLength": 5,
        "bLengthChange": false,
        "ajax":{
            "type": 'POST',
            "url": "ajax/viewcompanies.ajax.php",
            "data": {"option": "consultant","data": $("#idConsult").val()},
        },
        "columnDefs": [
            {
                "targets": -1,
                "data": null,
                render: function(data, type, row){
                    return '<button class="btn btn-default btn-xs btn_companiesSelInd" id_companiesSel="'+row[4]+'" nameCompany="'+row[1]+'" title="Seleccionar"><i class="fa fa-check"></i></button>'
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

    $('.companiesTableindSel tbody').on('click','button.btn_companiesSelInd',function(){

        idcompaniesSel = $(this).attr("id_companiesSel");
        nameCompany = $(this).attr("nameCompany");

        localStorage.setItem('idCompanySelect', JSON.stringify(idcompaniesSel));
        localStorage.setItem('nameCompanySelect', JSON.stringify(nameCompany));
        window.location = "viewindicator";
    });

    $('#btn_back_ind_sel').on('click',function(e){
        if(JSON.parse(localStorage.getItem("optionSl"))=='1'){
            window.location = 'viewcompanies';
            removeItems();
            return;
        }
        if(JSON.parse(localStorage.getItem("optionSl"))=='2'){
            window.location = 'companiesconsult';
            removeItems();
            return;
        }else{
            window.location = 'companiesindsel';
            removeItems();
        }

    });
    function removeItems(){
        //se limpia el local storage
        localStorage.removeItem("idCompanySelect");
        localStorage.removeItem("nameCompanySelect");
        localStorage.removeItem("optionSl");
    }
    $('#btn_updade_calf_comp').on('click',function(e){
        companiesTableindSels.ajax.reload(null, false);
    });
});