var fechaInicialR="";
var fechaFinalR="";
var opcion="";
//local storage
if(localStorage.getItem("fechaRangoReporte") != null){
	$("#daterange-btn2 span").html(localStorage.getItem("fechaRangoReporte"));
}else{
	$("#daterange-btn2 span").html('<i class="fa fa-calendar"></i> Rango de fecha')
}
if(localStorage.getItem("fecha_inicio") != null){
    fechaInicialR = localStorage.getItem("fecha_inicio");
    fechaFinalR = localStorage.getItem("fecha_fin");
    if(localStorage.getItem("fecha_inicio") != localStorage.getItem("fecha_fin")){
        opcion = "fechadiferente";
        reporteGraficoCotizaciones(localStorage.getItem("fecha_inicio"),localStorage.getItem("fecha_fin"),"fechadiferente"); 
    }else{
        opcion = "fechaigual";
        reporteGraficoCotizaciones(localStorage.getItem("fecha_inicio"),localStorage.getItem("fecha_fin"),"fechaigual"); 
    }
}else{
    fechaInicialR="";
    fechaFinalR="";
    opcion="";
    reporteGraficoCotizaciones("","","");
}
reporteGraficoProdMasVen();
/*RANGO DE FECHAS*/
$('#daterange-btn2').daterangepicker(
    {
      ranges   : {
        'Hoy'       : [moment(), moment()],
        'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
        'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
        'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
        'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment(),
      endDate  : moment()
    },
    function (start, end){
        $('#daterange-btn2 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        var fechaInicial = start.format('YYYY-M-DD');
        var fechaFinal = end.format('YYYY-M-DD');
        var reporteRango = $("#daterange-btn2 span").html();
        localStorage.setItem("fechaRangoReporte", reporteRango);
        localStorage.setItem("fecha_inicio", fechaInicial);
        localStorage.setItem("fecha_fin", fechaFinal);
        fechaInicialR = fechaInicial;
        fechaFinalR = fechaFinal;
        $("#line-chart-ventas-cotizacion").empty();
        if(fechaInicial != fechaFinal){
            opcion="fechadiferente";
            reporteGraficoCotizaciones(fechaInicial,fechaFinal,"fechadiferente"); 
          }else{
            opcion="fechaigual";
            reporteGraficoCotizaciones(fechaInicial,fechaFinal,"fechaigual");
          }
    }
)
/*CANCELAR RANGO DE FECHAS LIMPIAR LOCAL STORAGE*/
$(".daterangepicker.opensright .range_inputs .cancelBtn").on("click", function(){
    localStorage.removeItem("fechaRangoReporte");
    localStorage.removeItem("fecha_inicio");
    localStorage.removeItem("fecha_fin");
    localStorage.clear();
    fechaInicialR = "";
    fechaFinalR = "";
    opcion="";
    window.location = "reporte";
    $('#daterange-btn2 span').html('<i class="fa fa-calendar"></i> Rango de fecha');
    reporteGraficoCotizaciones("","","");
})
/*REPORTE DIA HOY*/
$(".daterangepicker.opensright .ranges li").on("click", function(){
    var textoHoy = $(this).attr("data-range-key");
    if(textoHoy == "Hoy"){
        var d = new Date();
        var dia = d.getDate();
        var mes = d.getMonth()+1;
        var año = d.getFullYear();
        var fechaInicial = año+"-"+mes+"-"+dia;
        var fechaFinal = año+"-"+mes+"-"+dia;
        localStorage.setItem("fechaRangoReporte", "Hoy");
    }
})

function reporteGraficoCotizaciones(fechaInicial,fechaFinal,opcion){
    var datos = new FormData();
    datos.append("fechaInicial",fechaInicial);
    datos.append("fechaFinal",fechaFinal);
    datos.append("opcion",opcion);
    $.ajax({
        type : 'POST',
        url  : "ajax/reportes/reporteVentas.ajax.php",
        data : datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            if(respuesta=="errorConsulta" || respuesta=="errorConexion"){
                swal({
                    type: "error",
                    title: "Error al consultar el reporte.<br>No es posible la conexión con el servidor.",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                });
            }else{
                var rptaDatos = [];
                if(respuesta != null){
                    for (var valor in respuesta){
                        rptaDatos.push({
                            y: valor,
                            Ventas: respuesta[valor]
                        });
                    }
                }else{
                    rptaDatos.push({
                        y: '',
                        Ventas: ''
                    });
                }
                if(typeof $('#line-chart-ventas-cotizacion').val()!="undefined"){
                    var line = new Morris.Line({
                        element          : 'line-chart-ventas-cotizacion',
                        resize           : true,
                        data             : rptaDatos,
                        xkey             : 'y',
                        ykeys            : ['Ventas'],
                        labels           : ['Ventas'],
                        lineColors       : ['#efefef'],
                        lineWidth        : 2,
                        hideHover        : 'auto',
                        gridTextColor    : '#fff',
                        gridStrokeWidth  : 0.4,
                        pointSize        : 4,
                        pointStrokeColors: ['#efefef'],
                        gridLineColor    : '#efefef',
                        gridTextFamily   : 'Open Sans',
                        preUnits         : '$',
                        gridTextSize     : 10
                      });
                }
            }
        }
    });
}

function reporteGraficoProdMasVen(){
    var datos = new FormData();
    datos.append("reporteProducto","reporteProducto");
    $.ajax({
        type : 'POST',
        url  : "ajax/reportes/reporteProductosVendidos.ajax.php",
        data : datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            if(respuesta=="errorConsulta" || respuesta=="errorConexion"){
                swal({
                    type: "error",
                    title: "Error al consultar el reporte.<br>No es posible la conexión con el servidor.",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                });
            }else{
                var sum = 0;
                var colores = ["red","green","yellow","aqua","purple","blue","cyan","magenta","orange","gold"];
                var nombres = [];
                var cantidad = [];
                var final = [];
                var tam = 0;
                if(respuesta.length < 10){
                  tam = respuesta.length;
                }else{
                  tam = 10;
                }
                for(i=0; i<tam; i++){
                    $(".clearfix").append('<li><i class="fa fa-circle-o text-'+colores[i]+'"></i><label id="NomRepP'+i+'" style="font-weight:500;font-family:Source Sans Pro; font-size: 16px;"></label></li>');

                    final.push({
                      value: respuesta[i]['cantidad'],
                      color: colores[i],
                      highlight: colores[i],
                      label: respuesta[i]['nombre']
                  });
                }
                for(var i in respuesta){
                    $("#NomRepP"+i).html(' '+respuesta[i]['nombre']);
                    sum += parseInt(respuesta[i]['cantidad']);
                }
                for(i=0; i<5; i++){
                    $(".nav-stacked").append('<li><a>'+respuesta[i]['nombre']+''+
                    '<span class="pull-right text-red"><i class="fa fa-angle-right"></i> '+Math.ceil(respuesta[i]['cantidad']*100/sum)+'%</span></a></li>');
                }
                if(typeof $('#pieChart').val()!="undefined"){
                // -------------
                // - PIE CHART -
                // -------------
                // Get context with jQuery - using jQuery's .get() method.
                var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
                var pieChart       = new Chart(pieChartCanvas);
                var PieData        = final;
                var pieOptions     = {
                  // Boolean - Whether we should show a stroke on each segment
                  segmentShowStroke    : true,
                  // String - The colour of each segment stroke
                  segmentStrokeColor   : '#fff',
                  // Number - The width of each segment stroke
                  segmentStrokeWidth   : 1,
                  // Number - The percentage of the chart that we cut out of the middle
                  percentageInnerCutout: 50, // This is 0 for Pie charts
                  // Number - Amount of animation steps
                  animationSteps       : 100,
                  // String - Animation easing effect
                  animationEasing      : 'easeOutBounce',
                  // Boolean - Whether we animate the rotation of the Doughnut
                  animateRotate        : true,
                  // Boolean - Whether we animate scaling the Doughnut from the centre
                  animateScale         : false,
                  // Boolean - whether to make the chart responsive to window resizing
                  responsive           : true,
                  // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                  maintainAspectRatio  : false,
                  // String - A legend template
                  legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
                  // String - A tooltip template
                  tooltipTemplate      : '<%=value %> <%=label%>'
                };
                // Create pie or douhnut chart
                // You can switch between pie and douhnut using the method below.
                pieChart.Doughnut(PieData, pieOptions);
                // -----------------
                // - END PIE CHART -
                // -----------------
                }
            }
        }
    });
}
//reporte excel
$('#btnreporteExcel').on('click',function(e){
    var d = new Date();
    var reporteExcel=d.getFullYear()+"-"+d.getMonth()+1+"-"+d.getDate();
    window.location = "vista/modulos/reporteExcel.php?reporteExcel="+reporteExcel+'&fechaInicial='+fechaInicialR+'&fechaFinal='+fechaFinalR+'&opcion='+opcion;    
});