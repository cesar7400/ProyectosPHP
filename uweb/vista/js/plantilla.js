//sidebar menu
$('.sidebar-menu').tree();

//datatable
$(".tablaUsuarios").DataTable({

    "language": {

		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
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
//formato numero de celular de 10 digitos
$('.celular').keyup(function(){

    var valor = this.value.replace(/\D/g, '');
    var nuevovalor = '';
    var cont = "";
    while(valor.length > 3 && cont < 2){
      nuevovalor += valor.substr(0, 3) + ' - ';
      valor = valor.substr(3);
      cont++;
    }
    if(valor.length > 3){
      nuevovalor += valor.substr(0, 2) + ' - ';
      valor = valor.substr(2);
    }
    nuevovalor += valor; 
    this.value = nuevovalor;
});

//formato numero de telefono de 7 digitos
$('.telefono').keyup(function(){

    var valor = this.value.replace(/\D/g, '');
    var nuevovalor = '';
    if (valor.length > 3){
      nuevovalor += valor.substr(0, 3) + ' - ';
      valor = valor.substr(3);
    }
    while(valor.length > 3){
      nuevovalor += valor.substr(0, 2) + ' - ';
      valor = valor.substr(2);
    }
    nuevovalor += valor; 
    this.value = nuevovalor;
  });
  
  function DigVer(digvr){
    $(".text").remove();
    var nit = digvr.trim();
    var temp, cont, resd, acum,valor;
    x=0; y=0;
    var dv=[3,7,13,17,19,23,29,37,41,43,47,53,59,67,71];
    acum = 0;
    resd = 0;
    for(cont=0; cont<nit.length; cont++){
        temp=nit[(nit.length -1)-cont];
        acum+=(temp*dv[cont]);
    }
    resd = acum % 11;
    if(resd > 1){
        valor = 11 - resd;
    }else{
        valor = resd;
    }
    return valor;
  }
  $(".nit").keyup(function(){
    if(isNaN($(".nit").val()) || $(".nit").val()==''){
      document.querySelector('#dv').innerText = '';
    }else{
      document.querySelector('#dv').innerText = DigVer($(".nit").val());
    }
  });
  //permite solo números
  function Numeros(e){
    tecla = (document.all) ? e.keyCode : e.which;
    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
    // Patron de entrada, en este caso solo acepta numeros, espacio y <<->>
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
  }
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  });
  
  $.fn.datepicker.defaults.language = 'es';
  //Date picker
  $('#datepickerFechaCot').datepicker({
    format: "yyyy/mm/dd",
    language: "es",
    weekStart: 1,

    daysOfWeekHighlighted: "0,6",
    calendarWeeks: true,
    autoclose: true,
    todayHighlight: true
  }).on('changeDate', checkDate);
  function checkDate() {

    var from = $('#datepickerFechaCot').val();
    var validDate = new Date(from);
    var checkDate = Date.now();
    checkDate = addDays(checkDate, 30);
  }
  
function addDays(date, days) {
  var result = new Date(date);
  result.setDate(result.getDate() + days);
  return result;
}