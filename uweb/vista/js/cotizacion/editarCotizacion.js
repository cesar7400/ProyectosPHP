$('.cotizacionesVenProd').ready(function(){
    $('.cotizacionesVenProd tbody').on('click','button.btnEditarCot',function(){
        idCotizacion = $(this).attr("idCotizacionEditar");
        idCliente = $(this).attr("IdClienteCotEd");  

        var datos = new FormData();
        datos.append("idCotizacionCot",idCotizacion);
        datos.append("idClienteCot",idCliente);
        $.ajax({
            type : 'POST',
            url  : "ajax/cotizacion/editarCotizacion.ajax.php",
            data : datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                if(respuesta != ""){
                    window.location = "cotizacion";
                }
            }
        })
    });
});