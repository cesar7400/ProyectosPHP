<?php

require_once "../../modelo/cliente.modelo.php";
require_once "../../controlador/cliente.controlador.php";
require_once "../../modelo/cotizacion.modelo.php";
require_once "../../controlador/cotizacion.controlador.php";
class DetalleCotizacion{

    public function verDetalleCotizacion(){

        $item = "idcliente";
        $valor = $this->IdClienteCotVer;
        $clientes = ControladorCliente::ctrVerClientes($item, $valor);
        $respuesta = ControladorCotizacion::CtrCotizacionValorDetalle($this->idverCotizacion);
        echo json_encode(array_merge($clientes,$respuesta));
    }
    public function verDetalleCotizacionProductos(){

        $datos = array("idcotizacion" => $this->idCotizacion);
        $cotProducto = ControladorCotizacion::CtrCotizacionProdctoVer($datos,"2");
        if(count($cotProducto)>0){
            echo'{
                "data": [';
                for($i=0; $i <count($cotProducto)-1; $i++){
                    echo '[
                        "'.($i+1).'",
                        "'.$cotProducto[$i]["detalle"].'",
                        "'.$cotProducto[$i]["cantidad"].'",
                        "'.$cotProducto[$i]["valorunitario"].'",
                        "'.$cotProducto[$i]["total"].'"
                    ],';
                }
                echo '[
                    "'.count($cotProducto).'",
                    "'.$cotProducto[count($cotProducto)-1]["detalle"].'",
                    "'.$cotProducto[count($cotProducto)-1]["cantidad"].'",
                    "'.$cotProducto[count($cotProducto)-1]["valorunitario"].'",
                    "'.$cotProducto[count($cotProducto)-1]["total"].'"
                    ]
               ]
            }';
        }else{
            echo'{"data": []}';
        }
    }
}

//detalle cotización cliente
if(isset($_POST['IdClienteCotVer']) && isset($_POST['postDetCot'])){
    $detalleCot = new DetalleCotizacion();
    $detalleCot -> IdClienteCotVer = $_POST["IdClienteCotVer"];
    $detalleCot -> idverCotizacion = $_POST["idverCotizacion"];
    $detalleCot -> verDetalleCotizacion();
}

//detalle cotización productos cliente
if(isset($_POST['idCotizacion'])){
    $detalleCotProdcto = new DetalleCotizacion();
    $detalleCotProdcto -> idCotizacion = $_POST["idCotizacion"];
    $detalleCotProdcto -> verDetalleCotizacionProductos();
}
?>