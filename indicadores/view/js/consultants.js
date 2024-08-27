$('.consultantTable').ready(function(){
    //CARGAR TABLA DINÁMICA
    var consultantTables = $('.consultantTable').DataTable({
        "ajax":"ajax/viewconsultant.ajax.php",
        "columnDefs": [
            {
                "targets": -1,
                "data": null,
                render: function(data, type, row){
                    return '<button class="btn btn-info btn-xs btn_view_consultant" id_view_consultant="'+row[4]+'" data-toggle="modal" data-target="#modalviewconsultants" title="Ver empresas"><i class="fa fa-search"></i></button>'
                }
            },
            {
                "targets": -2,
                "data": null,
                render: function(data, type, row){
                    return '<button class="btn btn-success btn-xs btn_consultant" id_consultant="'+row[4]+'" data-toggle="modal" data-target="#modalconsultants" title="Agregar empresas"><i class="fa fa-plus"></i></button>'
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

    $('.consultantTable tbody').on('click','button.btn_consultant',function(){

        var count = 0;
        //obtiene id del consultor
        var id_consultant = $(this).attr("id_consultant");
        //se guarda el id en el local storage para recojerlo en otro script
        localStorage.setItem("idconsultant", JSON.stringify(id_consultant));
        //se restablace el buscador y los checkbox quedan limpios(false)
        $('input[type="checkbox"]').prop('checked',false);
        $('input[type="checkbox"]').prop('disabled',false);
        var datos = new FormData();
        datos.append("id_user",id_consultant);
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
                    cont = rpta.data.length;
                    for (let index = 0; index < rpta.data.length; index++){
                        if(id_consultant != rpta.data[index][1]){
                            $('.chkidcompany'+rpta.data[index][0]+'').prop('disabled', true);
                        }else{
                            $('.chkidcompany'+rpta.data[index][0]+'').prop('checked', true);
                            count++;
                        }
                    }
                    localStorage.setItem("count", JSON.stringify(count));
                }
                //evitar cierre de modal cuando se hace click fuera de este
                $('#modalEmpresaConsultor').modal({backdrop: 'static', keyboard: false});
                //abre el modal para seleccionar las empresas
                $("#modalEmpresaConsultor").modal("show");
            },
            error: function (request, status, error){
                alert('error al abrir empresas, error de conexion');
            }
        });
    });
    $('.consultantTable tbody').on('click','button.btn_view_consultant',function(){
        //obtiene id del consultor
        var id_view_consultant = $(this).attr("id_view_consultant");
        var datos = new FormData();
        datos.append("id_user",id_view_consultant);
        $.ajax({
            type : 'POST',
            url  : "ajax/companiesuser.ajax.php",
            data : datos,
            //para subir archivos por ajax
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(rpta){
                //limpia la tabla (table)
                $("#view_info td").detach();
                //evitar cierre de modal cuando se hace click fuera de este
                $('#modalviewEmpresaConsultor').modal({backdrop: 'static', keyboard: false});
                //abre el modal para seleccionar las empresas
                $("#modalviewEmpresaConsultor").modal("show");
                for (let index = 0; index < rpta.data.length; index++) {
                    $("#view_info").append("<tr><td>"+rpta.data[index][0]+"</td><td>"+rpta.data[index][1]+"</td><td>"+rpta.data[index][2]+"</td></tr>");
                }
            },
            error: function (request, status, error){
                alert('error al ver infomación, error de conexion');
            }
        })
    });
    //actualiza tabla consultores
    $('#btn_aupdade_con').on('click',function(e){
        consultantTables.ajax.reload(null, false);
    });
});