<?php
session_start();
require_once "../../controlador/cotizacion.controlador.php";
require_once "../../modelo/cotizacion.modelo.php";
require_once "../../controlador/historial.controlador.php";
require_once "../../modelo/historial.modelo.php";

class AjaxGuardarCot{
    public $opcion;
    public function IngresarCotizacion(){
        
        $opcion = $this->opcionCotizacion;
        $listaProductos = $this->listaProductos;
        $idCotizacion = $this->idCotizacion;
        $totalCotizacion = $this->totalCotizacion;
        $valorP = $this->valorP;
        $fechaVenciminetoCot = $this->fechaVenciminetoCot;
        if($opcion == "SM"){
            echo json_encode(cotizacionDetalle($listaProductos, $idCotizacion));
        }else{
            if(cotizacionDetalle($listaProductos, $idCotizacion)=="ok"){
                if(cotizacion($opcion, $totalCotizacion, $idCotizacion, $valorP, $fechaVenciminetoCot) != "ok"){
                    echo json_encode("errorCotizacion");
                }else{
                    echo json_encode("ok");
                }
            }else{
                echo json_encode("errorActualizar");
            }
        }
    }
}
function cotizacion($op, $totalCot, $idCot, $valorP, $fechaVenciminetoCot){
    if($op == "Efectivo"){
        $valor="Efectivo";
    }
    if($op == "TC"){
        $valor="Targeta credito";
    }
    if($op == "TD"){
        $valor="Targeta debito";
    }
    $datos = array("formapago" => $valor.' - '.$valorP,
                   "totalcotizacion" => $totalCot,
                   "idcotizacion" => $idCot,
                   "fechamovimiento"=> $fechaVenciminetoCot,
                   "idusuario" => $_SESSION["idUsuario"],);
    $respuesta=ControladorCotizacion::CtrGuardarCotizacion($valor,$datos);
    return $respuesta;
}
function cotizacionDetalle($listaPr, $idCot){

    $valor="guardarcambios";
    $listaPr = json_decode($listaPr, true);
    foreach ($listaPr as $key => $value){
        $datos = array("cantidad" => $value['cantidad'],
                       "valorunitario" => $value['precio'],
                       "total" => $value['precio']*$value['cantidad'],
                       "idproducto" => $value['id'],
                       "idcotizacion" => $idCot);
        $respuesta=ControladorCotizacion::CtrGuardarCotizacion($valor,$datos);
    }
    return $respuesta;
}
//ingresar cliente seleccionado
if(isset($_POST["listaProductos"]) && isset($_POST["opcionCotizacion"]) && isset($_POST["idCotizacion"]) 
   && isset($_POST["totalCotizacion"]) && isset($_POST["valorP"]) && isset($_POST["fechaVenciminetoCot"])){

    $guardarCotizacion = new AjaxGuardarCot();
    $guardarCotizacion -> listaProductos = $_POST["listaProductos"];
    $guardarCotizacion -> opcionCotizacion = $_POST["opcionCotizacion"];
    $guardarCotizacion -> idCotizacion = $_POST["idCotizacion"];
    $guardarCotizacion -> totalCotizacion = $_POST["totalCotizacion"];
    $guardarCotizacion -> valorP = $_POST["valorP"];
    $guardarCotizacion -> fechaVenciminetoCot = $_POST["fechaVenciminetoCot"];
    $guardarCotizacion -> IngresarCotizacion();
}

?>