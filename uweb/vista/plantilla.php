<?php
  session_start();
?>
<!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Inicio</title>
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <link rel="icon" href="vista/img/plantilla/index.png">
      <!-- plugins css -->
      <!-- Bootstrap -->
      <link rel="stylesheet" href="vista/bower_components/bootstrap/dist/css/bootstrap.min.css">
      <!-- Select2 -->
      <link rel="stylesheet" href="vista/bower_components/select2/dist/css/select2.min.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="vista/bower_components/font-awesome/css/font-awesome.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="vista/bower_components/Ionicons/css/ionicons.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="vista/dist/css/AdminLTE.css">
      <!-- AdminLTE Skins. Choose a skin from the css/skins
          folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="vista/dist/css/skins/_all-skins.min.css">
      <!-- Google Font -->
      <link rel="stylesheet" href="extensiones/css/fonts.css">
      <!-- DataTables -->
      <link rel="stylesheet" href="vista/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
      <link rel="stylesheet" href="vista/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
      <!-- estilos -->
      <link rel="stylesheet" href="vista/css/estilos.css">
      <!-- Daterange picker -->
      <link rel="stylesheet" href="vista/bower_components/bootstrap-daterangepicker/daterangepicker.css">
      <!-- bootstrap datepicker -->
      <link rel="stylesheet" href="vista/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
      <!-- Morris chart -->
      <link rel="stylesheet" href="vista/bower_components/morris.js/morris.css">
      <!-- plugins javascript -->
      <!-- jQuery 3 -->
      <script src="vista/bower_components/jquery/dist/jquery.min.js"></script>
      <!-- Select2 -->
      <script src="vista/bower_components/select2/dist/js/select2.full.min.js"></script>
      <!--jquery validator-->
      <script src="extensiones/js/jquery.validate.min.js"></script>
      <!-- Bootstrap 3.3.7 -->
      <script src="vista/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
      <!-- FastClick -->
      <script src="vista/bower_components/fastclick/lib/fastclick.js"></script>
      <!-- AdminLTE App -->
      <script src="vista/dist/js/adminlte.min.js"></script>
      <!-- DataTables -->
      <script src="vista/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
      <script src="vista/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
      <script src="vista/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
      <script src="vista/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>
      <!--sweetalert2-->
      <script src="vista/plugins/sweetalert2/sweetalert2.all.js"></script>
      <!--plugin coreJS para sweetalert2 para funcionar en internet explorer-->
      <script src="vista/plugins/sweetalert2IE/promise.min.js"></script>
      <script src="vista/plugins/sweetalert2IE/core.js"></script>
      <!--number(formato numerico)-->
      <script src="vista/plugins/jNumber/jquery.number.js"></script>
      <!-- daterangepicker -->
      <script src="vista/bower_components/moment/min/moment.min.js"></script>
      <script src="vista/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
      <!-- bootstrap datepicker -->
      <script src="vista/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
      <script src="vista/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.es.js"></script> 
      <!-- bootstrap color picker -->
      <script src="vista/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
      <!-- Morris.js charts -->
      <script src="vista/bower_components/raphael/raphael.min.js"></script>
      <script src="vista/bower_components/morris.js/morris.min.js"></script>
      <!-- ChartJS -->
      <script src="vista/bower_components/Chart.js/Chart.js"></script>
    </head>
    <!-- Cuerpo documento -->
    <body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">
      <!-- Site wrapper -->
      <?php
        if(isset($_SESSION["inicioSesion"]) && $_SESSION["inicioSesion"]=="ok"){
          echo '<div class="wrapper"> </div>';
          /*encabezado*/ 
          include "modulos/principal.php";
          /*menu*/
          include "modulos/menu.php";
          /*contenido*/
          if(isset($_GET["ruta"])){
            if($_GET["ruta"]=="inicio" ||
               $_GET["ruta"]=="agregarUsuario" ||
               $_GET["ruta"]=="VerUsuarios" ||
               $_GET["ruta"]=="agregarCliente" ||
               $_GET["ruta"]=="verClientes" ||
               $_GET["ruta"]=="verHistorial" ||
               $_GET["ruta"]=="tipoCliente" ||
               $_GET["ruta"]=="agregarProducto" ||
               $_GET["ruta"]=="producto" ||
               $_GET["ruta"]=="tipoProducto" ||
               $_GET["ruta"]=="cotizacion" ||
               $_GET["ruta"]=="cotizaciones" ||
               $_GET["ruta"]=="reporte" ||
               $_GET["ruta"]=="Cotizacionreporte" ||
               $_GET["ruta"]=="salir"){
              include "modulos/".$_GET["ruta"].".php ";
            }else{
              include "modulos/404.php";
            }
          }else{
            include "modulos/inicio.php";
          }
          /*footer */
          include "modulos/footer.php";
        }else{
          include "modulos/login.php";
        }
      ?>
      <!-- ./wrapper -->
      <script src="vista/js/plantilla.js"></script>
      <!--usuarios-->
      <script src="vista/js/usuarios/iniciosesionusuario.js"></script>
      <script src="vista/js/usuarios/agregarusuario.js"></script>
      <script src="vista/js/usuarios/subirimagen.js"></script>
      <script src="vista/js/usuarios/validarUsuario.js"></script>
      <script src="vista/js/usuarios/mostrarUsuarios.js"></script>
      <script src="vista/js/usuarios/editarUsuarioSel.js"></script>
      <script src="vista/js/usuarios/eliminarUsuario.js"></script>
      <script src="vista/js/usuarios/activarDesactivarUsuario.js"></script>
      <!--clientes-->
      <script src="vista/js/clientes/agregarCliente.js"></script>
      <script src="vista/js/clientes/validarCliente.js"></script>
      <script src="vista/js/clientes/verClientes.js"></script>
      <script src="vista/js/clientes/editarClienteSel.js"></script>
      <!--tipo clientes-->
      <script src="vista/js/tipocliente/verTipoCliente.js"></script>
      <script src="vista/js/tipocliente/nuevoTipoCliente.js"></script>
      <script src="vista/js/tipocliente/validarTipoCliente.js"></script>
      <script src="vista/js/tipocliente/editarTipoCliente.js"></script>
      <script src="vista/js/tipocliente/eliminarTipoCliente.js"></script>
      <!--producto-->
      <script src="vista/js/producto/agregarProducto.js"></script>
      <script src="vista/js/producto/validarProducto.js"></script>
      <script src="vista/js/producto/editarProductoSel.js"></script>
      <script src="vista/js/producto/Verproductos.js"></script>
      <!--tipo producto-->
      <script src="vista/js/tipoproducto/verTipoProudcto.js"></script>
      <script src="vista/js/tipoproducto/nuevoTipoProducto.js"></script>
      <script src="vista/js/tipoproducto/validarTipoProducto.js"></script>
      <script src="vista/js/tipoproducto/editarTipoProducto.js"></script>
      <script src="vista/js/tipoproducto/eliminarTipoProducto.js"></script>
      <!--cotizacion-->
      <script src="vista/js/cotizacion/verProductoVentaCot.js"></script>
      <script src="vista/js/cotizacion/nuevoCotizacion.js"></script>
      <script src="vista/js/cotizacion/verCotizaciones.js"></script>
      <script src="vista/js/cotizacion/editarCotizacion.js"></script>
      <script src="vista/js/cotizacion/detalleCotizacion.js"></script>
      <script src="vista/js/cotizacion/cotizacionPDF.js"></script>
      <script src="vista/js/cotizacion/eliminarCotizacion.js"></script>
      <!--reportes-->
      <script src="vista/js/reportes/reportes.js"></script>
      <!--historial-->
      <script src="vista/js/historial/verHistorial.js"></script>
      <script src="vista/js/historial/eliminarHistorial.js"></script>
    </body>
  </html>