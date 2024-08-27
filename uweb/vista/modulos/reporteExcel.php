<?php
require_once "../../modelo/reportes.modelo.php";
require_once "../../controlador/reportes.controlador.php";
require_once "../../modelo/cliente.modelo.php";
require_once "../../controlador/cliente.controlador.php";
require_once "../../modelo/usuarios.modelo.php";
require_once "../../controlador/usuarios.controlador.php";

if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"]) && isset($_GET["opcion"])){

    $reporteExcel = ControladorReportes::CtrreorteExcel($_GET["fechaInicial"],$_GET["fechaFinal"],$_GET["opcion"]);
}else{

    $reporteExcel = ControladorReportes::CtrreorteExcel("","","");
}

$nombreArchivo = $_GET["reporteExcel"].'.xls';

header('Expires: 0');
header('Cache-control: private');
header("Content-type: application/vnd.ms-excel"); //Archivo  Excel
header("Cache-Control: cache, must-revalidate"); 
header('Content-Description: File Transfer');
header('Last-Modified: '.date('D, d M Y H:i:s'));
header("Pragma: public"); 
header('Content-Disposition:; filename="'.$nombreArchivo.'"');
header("Content-Transfer-Encoding: binary");

echo utf8_decode("<table border='0'> 

        <tr> 
        <td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO COTIZACIÓN</td> 
        <td style='font-weight:bold; border:1px solid #eee;'>CÉDULA</td> 
        <td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
        <td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
        <td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>	
        <td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
        <td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>		
        <td style='font-weight:bold; border:1px solid #eee;'>METODO DE PAGO</td>
        <td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>	
        </tr>");

foreach ($reporteExcel as $row => $valor){

    $clientes = ControladorCliente::ctrVerClientes("idcliente", $valor['idcliente']);
    $usuarios = ControladorUsuario::ctrVerUsuarios("idusuario", $valor['idusuario']);

    echo utf8_decode("<tr>
    <td style='border:1px solid #eee;'>".$valor["idcotizacion"]."</td> 
    <td style='border:1px solid #eee;'>".$clientes["cedula"]."</td> 
    <td style='border:1px solid #eee;'>".$clientes["nombres"].' '.$clientes["apellidos"]."</td>
    <td style='border:1px solid #eee;'>".$usuarios["nombres"].' '.$usuarios["apellidos"]."</td>
    <td style='border:1px solid #eee;'>");

    $productos = ControladorReportes::CtrCotizacionReporteVentasExcelProductods($valor["idcotizacion"]);
    
    foreach ($productos as $val => $cantidad) {
			 			
        echo utf8_decode($cantidad["detalle"]."<br>");

    }
    echo utf8_decode("</td><td style='border:1px solid #eee;'>");
    foreach ($productos as $val => $producto) {
			 			
        echo utf8_decode($producto["cantidad"]."<br>");
    }

    echo utf8_decode("</td>	
    <td style='border:1px solid #eee;'>$ ".number_format($valor["totalcotizacion"],2)."</td>
    <td style='border:1px solid #eee;'>".$valor["formapago"]."</td>
    <td style='border:1px solid #eee;'>".substr($valor["fechamovimiento"],0,10)."</td>
    </tr>");
}
echo "</table>";
?>