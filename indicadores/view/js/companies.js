var cont = 0;
$('.companiestTable').ready(function(){
    //CARGAR TABLA DINÁMICA
    var companiestTables = $('.companiestTable').DataTable({
        "pageLength": 5,
        "bInfo": false,
        "bLengthChange": false,
        "ajax":{
            "type": 'POST',
            "url": "ajax/viewcompanies.ajax.php",
            "data": {"option": "admin","data": "admin"},
        },
        "columnDefs": [
            {
                "targets": -1,
                "data": null,
                render: function(data, type, row){
                    return '<input type="checkbox" class="chkidcompany'+row[4]+'" chkidcompany='+row[4]+' "name="idcompany">'
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
    
    $('.companiestTable tbody').on('click','input[type="checkbox"]',function(){
        //se obtiene el id del consultor almacenado del local storage
        var idconsultant = JSON.parse(localStorage.getItem("idconsultant"));
        
        if(localStorage.getItem("count") != null){
            cont = cont = JSON.parse(localStorage.getItem("count"));
            localStorage.removeItem("count");
        }
        //si el checkbox es seleccionado
        if($(this).is(":checked")){
            var idcompany = $(this).attr("chkidcompany");
            /*if(cont > 400){
                $('.chkidcompany'+idcompany+'').prop('checked', false);
                alert('no se puede seleccionar más de 5 empresas');
            }else{

            }*/
            var datos = new FormData();
            datos.append("id_companies",idcompany);
            datos.append("id_user",idconsultant);
            $.ajax({
                type : 'POST',
                url  : "ajax/newcompanyuser.ajax.php",
                data : datos,
                //para subir archivos por ajax
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                beforeSend: function(){
                    $('.chkidcompany'+idcompany+'').prop('disabled',true);
                    $('.chkidcompany'+idcompany+'').after("<span id='del'>Seleccionando...</span>");
                },
                success: function(rpta){
                    if(rpta!="addError" || rpta!="connectionError"){
                        cont++;
                        $("#del").remove();
                        $('.chkidcompany'+idcompany+'').prop('disabled', false);
                    }
                },
                error: function (request, status, error){
                    $("#del").remove();
                    $('.chkidcompany'+idcompany+'').prop('checked', false);
                    $('.chkidcompany'+idcompany+'').prop('disabled', false);
                    alert('error al seleccionar, error de conexion');
                },
            });
        }else{
            var idcompany = $(this).attr("chkidcompany");
            var datos = new FormData();
            datos.append("id_companies",idcompany);
            datos.append("id_user",idconsultant);
            $.ajax({
                type : 'POST',
                url  : "ajax/deletecompanyuser.ajax.php",
                data : datos,
                //para subir archivos por ajax
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                beforeSend: function(){
                    $('.chkidcompany'+idcompany+'').prop('disabled',true);
                    $('.chkidcompany'+idcompany+'').after("<span id='del'>Quitando...</span>");
                },
                success: function(rpta){
                    if(rpta!="errorDelete" || rpta!="connectionError"){
                        cont--;
                        $("#del").remove();
                        $('.chkidcompany'+idcompany+'').prop('disabled', false);
                        
                    }
                },
                error: function (request, status, error){
                    $("#del").remove();
                    $('.chkidcompany'+idcompany+'').prop('checked', true);
                    $('.chkidcompany'+idcompany+'').prop('disabled', false);
                    alert('error al seleccionar, error de conexion');
                },
            });
        }
    });

    $(".companiestTable").on('draw.dt', function(){
        
        loadValues();
    });
    function loadValues(){
        //se restablace el buscador y los checkbox quedan limpios(false)
        $('input[type="checkbox"]').prop('checked',false);
        $('input[type="checkbox"]').prop('disabled',false);
        var idconsultant = JSON.parse(localStorage.getItem("idconsultant"));
        var datos = new FormData();
        datos.append("id_user",idconsultant);
        $.ajax({
            type : 'POST',
            url  : "ajax/viewusercompanies.ajax.php",
            data : datos,
            //para subir archivos por ajax
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(rpta){
                //comprobar si hay información en el array
                if(rpta.data.length > 0){
                    for (let index = 0; index < rpta.data.length; index++){
                        if(idconsultant != rpta.data[index][1]){
                            $('.chkidcompany'+rpta.data[index][0]+'').prop('disabled', true);
                        }else{
                            $('.chkidcompany'+rpta.data[index][0]+'').prop('checked', true);
                        }
                    }
                }
            },
            error: function (request, status, error){
                alert('error al abrir empresas, error de conexion');
            }
        });
    }
    $('#btnClose').on('click',function(e){
        //limpia el buscador y el datatable vuelve a su estado normal
        companiestTables.search('').columns().search('').draw();
        //se limpia el local storage
        localStorage.removeItem("idconsultant");
        //se restablace el buscador y los checkbox quedan limpios(false)
        $('input[type="checkbox"]', companiestTables.cells().nodes()).prop('checked',false);
        cont = 0;
    });
});