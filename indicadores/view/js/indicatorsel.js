//ingresar calificacion
function AddCal(option, id_Indicator, id_company){

  var result = 0;
  if(valueFields() != false){
    if(option == "1"){
      if(window.confirm("Ingresar calificación?")){ 
        result = parseFloat($("#NewValue").val()) / parseFloat($("#NewValue1").val());
        SaveIndicatorScore(id_Indicator, id_company, result);
      }
    }else{
      if(window.confirm("Ingresar calificación?")){ 
        result = parseFloat($("#NewValue").val());
        SaveIndicatorScore(id_Indicator, id_company, result);
      }
    }
  }
}
//validar campos
function valueFields(){
  $("#errorLabel").remove();
  if($("#NewValue").val() == "" && $('#NewValue').length){
    $("#NewValue").after('<label id="errorLabel">ingresar valor</label>');
    $("#NewValue").focus();
    return false;
  }
  if($("#NewValue1").val() == "" && $('#NewValue1').length){
    $("#NewValue1").after('<label id="errorLabel">ingresar valor</label>');
    $("#NewValue1").focus();
    return false;
  }
}

//limpiar campos
function clearFields(){
  $("#errorLabel").remove();
  if($('#NewValue').length){
    $("#NewValue").val('');
    $("#NewValue").focus();
  }
  if($('#NewValue1').length){
    $("#NewValue1").val('');
    $("#NewValue1").focus();
  }
}

//permite solo números
function Numeros(e){
  tecla = (document.all) ? e.keyCode : e.which;
  //Tecla de retroceso para borrar, siempre la permite
  if(tecla==8){
    return true;
  }
  // Patron de entrada, en este caso solo acepta numeros, espacio y <<->>
  patron =/[0-9]/;
  tecla_final = String.fromCharCode(tecla);
  return patron.test(tecla_final);
}

//guardar resultado
function SaveIndicatorScore(id_Indicator, id_company, score){

  var datos = new FormData();
  datos.append("score",score);
  datos.append("id_company",id_company);
  datos.append("id_indicators",id_Indicator);
  $.ajax({
      type : 'POST',
      url  : "ajax/addscoreindicator.ajax.php",
      data : datos,
      //para subir archivos por ajax
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      beforeSend: function(){
        $("#btnAddCal").html('Verificando...');
      },
      success: function(rpta){
          if(rpta!="addError" || rpta!="connectionError"){
            clearFields();
            //se limpia el local storage
            /*localStorage.removeItem("nameCompany");
            localStorage.removeItem("idcompaniesSel");*/
            $("#btnAddCal").html('Ingresar');
            window.location = "companiesindicators";
          }
      },
      error: function (request, status, error){
        $("#btnAddCal").html('Ingresar');
        alert('error al ingresar valor, error de conexion');
      },
  });
}