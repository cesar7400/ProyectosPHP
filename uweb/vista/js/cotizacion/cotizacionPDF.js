//ver cotización detalle
$('.cotizacionesVenProd').ready(function(){
    $('.cotizacionesVenProd tbody').on('click','button.btnImprimirCotizacion',function(){
        var id = $(this).attr("idImprimirCotizacion");
        window.open("extensiones/tcpdf/pdf/cotizacionPDF.php?id="+id,"_blank");
    });
});