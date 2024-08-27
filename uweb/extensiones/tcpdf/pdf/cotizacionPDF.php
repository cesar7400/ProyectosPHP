<?php
require_once "../../../modelo/cliente.modelo.php";
require_once "../../../controlador/cliente.controlador.php";
require_once "../../../modelo/cotizacion.modelo.php";
require_once "../../../controlador/cotizacion.controlador.php";
class cotizacionPDF{

public $id;

public function cotPDF(){

    $respuesta = ControladorCotizacion::CtrCotizacionValorDetalle($this->id);
    $numeroCotizacion = $respuesta['idcotizacion'];
    $fecha = substr($respuesta['fechainicial'],0,-8);
    $fechaVencimiento = substr($respuesta['fechamovimiento'],0,-8);
    if($respuesta['totalcotizacion']==0){
        $totalcotizacion = "Sin cancelar";
    }else{
        $totalcotizacion = number_format($respuesta['totalcotizacion'],0);

    }
    $item = "idcliente";
    $clientes = ControladorCliente::ctrVerClientes($item, $respuesta['idcliente']);
    $nombreCliente = $clientes['nombres'].' '.$clientes['apellidos'];
    $nit = $clientes['nit'];
    $telefono = $clientes['telefono'];
    $direccion = $clientes['direccion'];
    $ciudad = $clientes['ciudad'];

//libreria PDF
require_once('tcpdf_include.php');
// creacion nuevo documento PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//grupo de páginas
$pdf->startPageGroup();
//agregar página
$pdf->AddPage();

// -- set new background ---
// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = K_PATH_IMAGES.'fondo.png';
$pdf->Image($img_file, -1, -1, 213, 303, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();
//imagen logo
$pdf->setImageScale(1.22);
$pdf->SetXY(20, 27.10);
$pdf->Image('images/logo.png');
$documento = <<<EOF
<table>
    <tr>
        <td style="width:420px; height:30"></td>
        <td style="font-style:normal;font-weight:bold;font-size:14pt;font-family:Calibri;color:#000000">COTIZACIÓN N°: $numeroCotizacion</td>
    </tr>
    <tr>
        <td style="width:420px; height:30"></td>
        <td style="font-style:normal;font-weight:bold;font-size:14pt;font-family:Calibri;color:#000000">Fecha: $fecha</td>
    </tr>
    <tr>
        <td style="width:420px; height:30"></td>
        <td style="font-style:normal;font-weight:bold;font-size:14pt;font-family:Calibri;color:#000000">Vence: $fechaVencimiento</td>
    </tr>
</table>

EOF;
$pdf->writeHTML($documento, false, false, false, false,'');

$documento1 = <<<EOF
<br><br><br>
<table ​style="width:100%"> 
<tr style="line-height:37px;text-align:center;background-color:#18c4f4; font-style:normal;font-weight:bold;font-size:14pt;font-family:Calibri;color:#ffffff"> 
    <th style="width:30%">CLIENTE</th>
    <th style="width:20%">NIT</th>
    <th style="width:15%">TELÉFONO</th>
    <th style="width:20%">DIRECCIÓN</th>
    <th style="width:15%">CIUDAD</th>
</tr> 
<tr style="line-height:37px;text-align:center; font-style:normal;font-size:10pt;font-family:Calibri;color:black"> 
    <th style="width:30%">$nombreCliente</th>
    <th style="width:20%">$nit</th>
    <th style="width:15%">$telefono</th>
    <th style="width:20%">$direccion</th>
    <th style="width:15%">$ciudad</th>
</tr>
<tr style="line-height:37px;text-align:center;background-color:#18c4f4; font-style:normal;font-weight:bold;font-size:14pt;font-family:Calibri;color:#ffffff"> 
    <th style="width:40%">DETALLE</th>
    <th style="width:20%">CANTIDAD</th>
    <th style="width:20%">VL. UNITARIO</th>
    <th style="width:20%">VL. TOTAL</th>
</tr>
</table>

EOF;
$pdf->writeHTML($documento1, false, false, false, false,'');
/**************************************************************************************/
$datos = array("idcotizacion" => $this->id);
$cotProducto = ControladorCotizacion::CtrCotizacionProdctoVer($datos,"2");

foreach($cotProducto as $key=>$valor){
$valPro=number_format($valor['valorunitario'],0);
$valTotal=number_format($valor['total'],0);
$documento2 = <<<EOF

    <table ​style="width:100%">
        <tr style="line-height:37px;text-align:center; font-style:normal;font-size:10pt;font-family:Calibri;color:black"> 
            <th style="width:40%">$valor[detalle]</th>
            <th style="width:20%">$valor[cantidad]</th>
            <th style="width:20%">$valPro</th>
            <th style="width:20%">$valTotal</th>
        </tr> 
    </table>
EOF;

$pdf->writeHTML($documento2, false, false, false, false,'');
}

/**********************************************************************************************************/
$documento3 = <<<EOF

    <table ​style="width:100%">
        <tr style="line-height:18px;text-align:left;background-color:#18c4f4; font-style:normal;font-weight:bold;font-size:12pt;font-family:Calibri;color:#ffffff"> 
            <th style="width:50%"></th>
            <th style="width:30%">SUBTOTAL:</th>
            <th style="width:20%">$totalcotizacion</th>
        </tr>
        <tr style="line-height:18px;text-align:left;background-color:#18c4f4; font-style:normal;font-weight:bold;font-size:12pt;font-family:Calibri;color:#ffffff"> 
            <th style="width:50%"></th>
            <th style="width:30%">TOTAL A PAGAR:</th>
            <th style="width:20%">$totalcotizacion</th>
        </tr> 
    </table>

EOF;
$pdf->writeHTML($documento3, false, false, false, false,'');
/*********************************************************************************************************/
$documento4 = <<<EOF
    <br><br><br><br><br><br>
    <table>
        <tr style="line-height:18px;text-align:left; font-style:normal;font-size:11pt;font-family:Calibri;color:black"> 
            <th>FIRMA EMISOR</th>
        </tr>
        <tr style="line-height:18px;text-align:left; font-style:normal;font-size:11pt;font-family:Calibri;color:black"> 
            <th>TEL. 322 853 96 48</th>
        </tr>
        <tr style="line-height:18px;text-align:left; font-style:normal;font-size:11pt;font-family:Calibri;color:black"> 
            <th>USOLUWEB@GMAIL.COM</th>
        </tr>
        <tr style="line-height:18px;text-align:left; font-style:normal;font-size:11pt;font-family:Calibri;color:black"> 
            <th>MEDELLÍN, COLOMBIA</th>
        </tr>
    </table>

EOF;
$pdf->writeHTML($documento4, false, false, false, false,'');
//salida del archivo PDF
$pdf->Output('cotizacion.pdf');
}
} 
$cotPDF = new cotizacionPDF();
$cotPDF -> id = $_GET['id'];
$cotPDF -> cotPDF();
?>