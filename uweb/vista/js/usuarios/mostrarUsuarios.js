$('.tablaUsuarios').ready(function(){
    //reiniciar datatable
    $(".tablaUsuarios").dataTable().fnDestroy();
    //CARGAR TABLA DINÁMICA
    var tablaUsuarios = $('.tablaUsuarios').DataTable({
        "ajax":"ajax/usuarios/verUsuarios.ajax.php",
        "columnDefs": [
            {
                "targets": -4,
                "data": null,
                "defaultContent": '<img class="img-thumbnail imgTablaUsuarios" width="40px">'
            },
            {
                "targets": -1,
                "data": null,
                render: function(data, type, row){
                    return '<button class="btn btn-success btn-xs btnVerUsuario" idverUsuario="'+row[10]+'" title="Ver usuario"><i class="fa fa-search-plus"></i></button>'
                          +'<button class="btn btn-primary btn-xs btnSeleccionarUsuarioEditar" idselUsuarioEditar="'+row[10]+'" title="Editar usuario"><i class="fa fa fa-pencil"></i></button>'
                          +'<button class="btn btn-danger btn-xs btnEliminarUsuario" idUsuarioEliminar="'+row[10]+'" imagenUsuarioEliminar="'+row[7]+'" nombreUsuarioEliminar="'+row[4]+'" title="Eliminar usuario"><i class="fa fa-trash-o"></i></button>'
                }
            },
            {
                "targets": -3,
                "data": null,
                render: function(data, type, row){
                    if(row[8] == 1) {
                        return '<td><button class="btn btn-success btn-xs btnActivarUsuario" idusuario="'+row[10]+'" estadoUsuario="0" name="btnActivado'+row[10]+'" id="btnActivado'+row[10]+'">Activado</button></td>'
                    }
                    if(row[8] == 0)  {
                        return '<td><button class="btn btn-danger btn-xs btnActivarUsuario" idusuario="'+row[10]+'" estadoUsuario="1" name="btnActivado'+row[10]+'" id="btnActivado'+row[10]+'">Desactivado</button></td>'
                    }
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
    //FUNCIÓN PARA CARGAR LAS IMÁGENES
    function cargarImagenesUsuario(){
        var imgTabla = $(".imgTablaUsuarios");
        for(var i = 0; i < imgTabla.length; i++){
            var data = tablaUsuarios.row($(imgTabla[i]).parents("tr")).data();
            //validar que no vengan imagenes vacias
            if(data != null){
                if(data[7] != ""){
                    $(imgTabla[i]).attr("src", data[7]);
                }else{
                    $(imgTabla[i]).attr("src", "vista/img/usuarios/default user.png");
                }
            }
        }
    }
    //cargan las imagenes por primera vez
    setTimeout(function(){

        cargarImagenesUsuario();

    },1000)

    //cara las imagenes cuando se interactua con el paginador
    $(".dataTables_paginate").click(function(){

        cargarImagenesUsuario();
    })
    //cargan las imagenes cuando se interactua con el buscador
    $("input[aria-controls='DataTables_Table_0']").focus(function(){

        $(document).keyup(function(event){
            cargarImagenesUsuario();
        })
    })
    //cargan las imagenes cuando se interactua con el filtro del buscador
    $("input[aria-controls='DataTables_Table_0']").focus(function(){

        $(document).keyup(function(event){
            event.preventDefault();
            cargarImagenesUsuario();
        })
    })
    //cargan las imagenes cuando se interactua con el filtro de cantidad(combobox)
    $("select[name='DataTables_Table_0_length']").change(function(){

        cargarImagenesUsuario();
    })
    //cargan las imagenes cuando se interactua con el filtro de ordenador
    $(".sorting").click(function(){

        cargarImagenesUsuario();
    })

    //actualizar tabla usuarios
    $('#btn_upd_usuarios').on('click',function(e){
        tablaUsuarios.ajax.reload(null, false);
        setTimeout(function(){
            
            cargarImagenesUsuario();
        },2000)
    })
    //ver usuario seleccionado
    $('.tablaUsuarios tbody').on('click','button.btnVerUsuario',function(){
        var id = $(this).attr("idverUsuario");
        var datos = new FormData();
        datos.append("idVerUsuarioSel",id);
        $.ajax({
            type : 'POST',
            url  : "ajax/usuarios/verUsuarioSeleccionado.ajax.php",
            data : datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                if(respuesta=="errorConsulta" || respuesta=="errorConexion"){
                    swal({
                        type: "error",
                        title: "Error al consultar el usuario.<br>No es posible la conexión con el servidor.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    });
                }else{
                    //se muestra el form modal con la informacion del usuario seleccionado
                    $("#modalVerUsuario").modal("show");
                    $("#Vernombre").html(" "+respuesta["nombres"]);
                    $("#Verapellido").html(" "+respuesta["apellidos"]);
                    $("#Veremail").html(" "+respuesta["email"]);
                    $("#Verusuario").html(" "+respuesta["usuario"]);
                    $("#verFechaingreso").html(" "+respuesta["fechaingreso"]);
                    if(respuesta["fechamodificacion"] == null || respuesta["fechamodificacion"] == ""){
                        $("#verFechamodificacion").html("");
                    }else{
                        $("#verFechamodificacion").html(respuesta["fechamodificacion"]);
                    }
                    if(respuesta["imagen"] != ""){
                        document.getElementById("imagenUsuario").src = respuesta["imagen"];
                    }else{
                        document.getElementById("imagenUsuario").src = "vista/img/usuarios/default user.png";
                    }
                    if(respuesta["estado"] == 1){
                        $("#Verestado").html('<span class="label label-success">Activado</span>');
                    }else{
                        $("#Verestado").html('<span class="label label-danger">Desactivado</span>');
                    }
                    if(respuesta["ultimo_login"] == null || respuesta["ultimo_login"] == ""){
                        $("#UltimoLogin").html("");
                    }else{
                        $("#UltimoLogin").html(respuesta["ultimo_login"]);
                    }
                }
            }
        });
    })
});