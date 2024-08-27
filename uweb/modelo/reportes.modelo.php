<?php
    require_once "conexion.php";
    class ModeloReportes{

        //consular reporte ventas cotizacion
        static public function MdlCotizacionReporteVentas($fechaInicio,$fechaFin,$opcion){
            if(Conexion::conectar() !="errorConexion"){
                if($opcion == ""){
                    $sql = "select * from cotizacion where date(fechamovimiento) AND estado=1";
                }if($opcion == "fechaigual"){
                    $sql = "select * from cotizacion    
                            WHERE fechamovimiento LIKE '%$fechaFin%' AND estado=1";
                }
                if($opcion == "fechadiferente"){
                    $sql = "select * from cotizacion
                            WHERE date(fechamovimiento) BETWEEN '$fechaInicio' AND '$fechaFin' AND estado=1";
                }
                $stmt = Conexion::conectar()->prepare($sql);
                if($stmt == false){
                    return"errorConsulta";
                }else{
                    $stmt -> execute();
                    return $stmt -> fetchAll();
                }
                $stmt -> close();
                $stmt = null;
            }else{
                return "errorConexion";
            }
        }
        //consular reporte productos mas vendiso
        static public function MdlCotizacionReporteProductos(){
            if(Conexion::conectar() !="errorConexion"){
                $stmt = Conexion::conectar()->prepare("SELECT SUM(detallecotizacion.cantidad) as cantidad, productos.nombre FROM productos
                                                       INNER JOIN detallecotizacion ON productos.idproducto=detallecotizacion.idproducto
                                                       INNER JOIN cotizacion ON detallecotizacion.idcotizacion=cotizacion.idcotizacion
                                                       WHERE cotizacion.estado=1
                                                       GROUP BY detallecotizacion.detalle
                                                       ORDER BY SUM(detallecotizacion.cantidad) DESC");
                if($stmt == false){
                    return"errorConsulta";
                }else{
                    $stmt -> execute();
                    return $stmt -> fetchAll();
                }
                $stmt -> close();
                $stmt = null;
            }else{
                return "errorConexion";
            }
        }
        //consular reporte excel
        static public function MdlCotizacionReporteVentasExcel($fechaInicio,$fechaFin,$opcion){
            if(Conexion::conectar() !="errorConexion"){
                if($opcion == ""){
                    $sql = "SELECT cotizacion.idcotizacion, cotizacion.idcliente, cotizacion.idusuario,
                            cotizacion.formapago, cotizacion.fechamovimiento, cotizacion.totalcotizacion
                            from cotizacion 
                            INNER JOIN clientes on cotizacion.idcliente=clientes.idcliente
                            INNER JOIN usuarios on cotizacion.idusuario=usuarios.idusuario
                            WHERE cotizacion.estado=1 ORDER BY cotizacion.idcotizacion ASC";
                }if($opcion == "fechaigual"){
                    $sql = "SELECT cotizacion.idcotizacion, cotizacion.idcliente, cotizacion.idusuario,
                            cotizacion.formapago, cotizacion.fechamovimiento, cotizacion.totalcotizacion
                            from cotizacion 
                            INNER JOIN clientes on cotizacion.idcliente=clientes.idcliente
                            INNER JOIN usuarios on cotizacion.idusuario=usuarios.idusuario
                            WHERE cotizacion.estado=1 and cotizacion.fechamovimiento LIKE '%$fechaFin%'";
                }
                if($opcion == "fechadiferente"){
                    $sql = "SELECT cotizacion.idcotizacion, cotizacion.idcliente, cotizacion.idusuario,
                            cotizacion.formapago, cotizacion.fechamovimiento, cotizacion.totalcotizacion
                            from cotizacion 
                            INNER JOIN clientes on cotizacion.idcliente=clientes.idcliente
                            INNER JOIN usuarios on cotizacion.idusuario=usuarios.idusuario
                            WHERE cotizacion.estado=1 and date(cotizacion.fechamovimiento) BETWEEN '$fechaInicio' AND '$fechaFin'";
                }
                $stmt = Conexion::conectar()->prepare($sql);
                if($stmt == false){
                    return"errorConsulta";
                }else{
                    $stmt -> execute();
                    return $stmt -> fetchAll();
                }
                $stmt -> close();
                $stmt = null;
            }else{
                return "errorConexion";
            }
        }
        //consular reporte excel
        static public function MdlCotizacionReporteVentasExcelProductods($idcotizacion){
            if(Conexion::conectar() !="errorConexion"){
                $stmt = Conexion::conectar()->prepare("select * from detallecotizacion where idcotizacion='$idcotizacion'");
                if($stmt == false){
                    return"errorConsulta";
                }else{
                    $stmt -> execute();
                    return $stmt -> fetchAll();
                }
                $stmt -> close();
                $stmt = null;
            }else{
                return "errorConexion";
            }
        }
        //consular reporte excel
        static public function MdlcantidadReportes($tabla){
            if(Conexion::conectar() !="errorConexion"){
                if(Conexion::conectar() !="errorConexion"){
                    $stmt = Conexion::conectar()->prepare("SELECT count(idcotizacion)as cant FROM $tabla ");
                    if($stmt == false){
                        return"errorConsulta";
                    }else{
                        $stmt -> execute();
                        return $stmt -> fetch();
                    }
                    $stmt -> close();
                    $stmt = null;
                }else{
                    return "errorConexion";
                }
            }
        }
    }
    
?>