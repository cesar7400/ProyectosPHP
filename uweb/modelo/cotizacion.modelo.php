<?php
    require_once "conexion.php";
    class ModeloCotizacion{

        //ver cotizaciones
        static public function MdlCotizaciones($tabla){
            if(Conexion::conectar() !="errorConexion"){
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idcliente='0' AND estado='0'");
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
        //cotizacion en estado cero (abierta) recuperar productos
        static public function MdlCotizacionEstado($tabla,$idCliente){
            if(Conexion::conectar() !="errorConexion"){
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idcliente=$idCliente AND estado='0'");
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

        //nuevo cotizacion
        static public function MdlNuevoCotizacion($tabla,$datos){
            $db = Conexion::conectar();
            if($db !="errorConexion"){
                $stmt = $db->prepare("INSERT INTO $tabla(idcliente, estado) VALUES (:idcliente, :estado)");
                if($stmt == false){
                    return"errorAgregar";
                }else{
                    $stmt -> bindParam(":idcliente",$datos["idcliente"], PDO::PARAM_STR);
                    $stmt -> bindParam(":estado",$datos["estado"], PDO::PARAM_STR);
                    if($stmt->execute()){
                        return $db -> lastInsertId();
                    }else{
                        return "errorAgregar";
                    }
                    $stmt -> close();
                    $stmt = null;
                }
            }else{
                return "errorConexion";
            }
        }
        //nuevo cotizacion
        static public function MdlNuevoCotizacionDetalle($tabla,$datos){
            $db = Conexion::conectar();
            if($db !="errorConexion"){
                $stmt = $db->prepare("INSERT INTO $tabla(idcotizacion, idproducto, detalle, cantidad, valorunitario, total) VALUES (:idcotizacion, :idproducto, :detalle, :cantidad, :valorunitario, :total)");
                if($stmt == false){
                    return"errorAgregar";
                }else{
                    $stmt -> bindParam(":idcotizacion",$datos["idcotizacion"], PDO::PARAM_STR);
                    $stmt -> bindParam(":idproducto",$datos["idproducto"], PDO::PARAM_STR);
                    $stmt -> bindParam(":detalle",$datos["detalle"], PDO::PARAM_STR);
                    $stmt -> bindParam(":cantidad",$datos["cantidad"], PDO::PARAM_STR);
                    $stmt -> bindParam(":valorunitario",$datos["valorunitario"], PDO::PARAM_STR);
                    $stmt -> bindParam(":total",$datos["total"], PDO::PARAM_STR);
                    if($stmt->execute()){
                        return "ok";
                    }else{
                        return "errorAgregar";
                    }
                    $stmt -> close();
                    $stmt = null;
                }
            }else{
                return "errorConexion";
            }
        }
        //eliminar productos cotizacion abierta
        static public function MdlEliminarCotizacion($tabla,$datos){
            if(Conexion::conectar()!="errorConexion"){
                $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idcotizacion = :idcotizacion AND idproducto = :idproducto");
                if($stmt == false){
                    return "errorBorrar";
                }else{
                    $stmt -> bindParam(":idcotizacion", $datos["idcotizacion"], PDO::PARAM_STR);
                    $stmt -> bindParam(":idproducto", $datos["idproducto"], PDO::PARAM_STR);
                    if($stmt->execute()){
                        return "ok";
                    }else{
                        return "errorBorrar";
                    }
                    $stmt -> close();
                    $stmt = null;
                }
            }else{
                return "errorConexion";
            }
        }
        //evitar producto 2 veces en la cotización
        static public function MdlCotizacionProdctoVer($tabla,$datos,$opcion){
            if(Conexion::conectar() !="errorConexion"){
                if($opcion=="1"){
                    $sql = "SELECT * FROM $tabla WHERE idcotizacion = :idcotizacion AND idproducto = :idproducto";
                }else{
                    $sql = "SELECT * FROM $tabla WHERE idcotizacion = :idcotizacion";
                }
                $stmt = Conexion::conectar()->prepare($sql);
                if($stmt == false){
                    return"errorConsulta";
                }else{
                    if($opcion == "1"){
                        $stmt -> bindParam(":idcotizacion", $datos["idcotizacion"], PDO::PARAM_STR);
                        $stmt -> bindParam(":idproducto", $datos["idproducto"], PDO::PARAM_STR);
                        $stmt -> execute();
                        return $stmt -> rowCount();
                    }else{
                        $stmt -> bindParam(":idcotizacion", $datos["idcotizacion"], PDO::PARAM_STR);
                        $stmt -> execute();
                        return $stmt -> fetchAll();
                    }
                }
                $stmt -> close();
                $stmt = null;
            }else{
                return "errorConexion";
            }
        }
        //guardar cotizacion
        static public function MdlGuardarCotizacion($tabla,$datos,$opcion){
            if(Conexion::conectar()!="errorConexion"){
                if($opcion=="guardarcambios"){
                    $sql="UPDATE $tabla SET cantidad = :cantidad, valorunitario = :valorunitario, total = :total WHERE idproducto = :idproducto AND idcotizacion = :idcotizacion";
                }else {
                    $sql="UPDATE $tabla SET idusuario = :idusuario, formapago = :formapago, fechamovimiento = :fechamovimiento, estado = '1',totalcotizacion = :totalcotizacion WHERE estado = '0' AND idcotizacion = :idcotizacion";
                }
                $stmt = Conexion::conectar()->prepare($sql);
                if($stmt == false){
                    return "errorActualizar";
                }else{
                    if($opcion=="guardarcambios"){
                        $stmt -> bindParam(":cantidad",$datos["cantidad"], PDO::PARAM_STR);
                        $stmt -> bindParam(":valorunitario",$datos["valorunitario"], PDO::PARAM_STR);
                        $stmt -> bindParam(":total",$datos["total"], PDO::PARAM_STR);
                        $stmt -> bindParam(":idproducto",$datos["idproducto"], PDO::PARAM_STR);
                        $stmt -> bindParam(":idcotizacion",$datos["idcotizacion"], PDO::PARAM_STR);
                    }else {
                        $stmt -> bindParam(":fechamovimiento",$datos["fechamovimiento"], PDO::PARAM_STR);
                        $stmt -> bindParam(":idusuario",$datos["idusuario"], PDO::PARAM_STR);
                        $stmt -> bindParam(":formapago",$datos["formapago"], PDO::PARAM_STR);
                        $stmt -> bindParam(":idcotizacion",$datos["idcotizacion"], PDO::PARAM_STR);
                        $stmt -> bindParam(":totalcotizacion",$datos["totalcotizacion"], PDO::PARAM_STR);
                    }
                    
                    if($stmt->execute()){
                        return "ok";
                    }else{
                        return "errorActualizar";
                    }
                    $stmt -> close();
                    $stmt = null;
                }
            }else{
                return "errorConexion";
            }
        }
        //ver cotizaciones
        static public function MdlCotizacionesVer($opcion,$idcotizacion){
            if(Conexion::conectar() !="errorConexion"){
                if($opcion == "cotizacion"){
                    $sql = "select cotizacion.idcotizacion, CONCAT(clientes.nombres,' ',clientes.apellidos) as cliente,
                            CONCAT(usuarios.nombres,' ',usuarios.apellidos)as vendedor,
                            cotizacion.formapago, cotizacion.totalcotizacion, date_format(cotizacion.fechainicial,  '%Y/%m/%d')as fechainicial,
                            date_format(cotizacion.fechamovimiento,  '%Y/%m/%d')as fechamovimiento, cotizacion.estado,cotizacion.idcliente
                            from cotizacion
                            INNER JOIN clientes on cotizacion.idcliente=clientes.idcliente
                            LEFT JOIN usuarios ON usuarios.idusuario=cotizacion.idusuario";
                }else {
                    $sql = "select * from detallecotizacion where idcotizacion=$idcotizacion";
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

        //consular ventas cotizacion
        static public function MdlCotizacionConsultarVentas($fechaInicio,$fechaFin,$opcion){
            if(Conexion::conectar() !="errorConexion"){
                if($opcion == ""){
                    $sql = "select cotizacion.idcotizacion, CONCAT(clientes.nombres,' ',clientes.apellidos) as cliente,
                            clientes.cedula,
                            CONCAT(usuarios.nombres,' ',usuarios.apellidos)as vendedor,
                            cotizacion.formapago, cotizacion.totalcotizacion, date_format(cotizacion.fechainicial,  '%Y/%m/%d')as fechainicial,
                            date_format(cotizacion.fechamovimiento,  '%Y/%m/%d')as fechamovimiento, cotizacion.estado,cotizacion.idcliente
                            from cotizacion
                            INNER JOIN clientes on cotizacion.idcliente=clientes.idcliente
                            LEFT JOIN usuarios ON usuarios.idusuario=cotizacion.idusuario
                            ORDER BY cotizacion.idcotizacion ASC"; 
                }if($opcion == "fechaigual"){
                    $sql = "select cotizacion.idcotizacion, CONCAT(clientes.nombres,' ',clientes.apellidos) as cliente,
                            clientes.cedula,
                            CONCAT(usuarios.nombres,' ',usuarios.apellidos)as vendedor,
                            cotizacion.formapago, cotizacion.totalcotizacion, date_format(cotizacion.fechainicial,  '%Y/%m/%d')as fechainicial,
                            date_format(cotizacion.fechamovimiento,  '%Y/%m/%d')as fechamovimiento, cotizacion.estado,cotizacion.idcliente
                            from cotizacion
                            INNER JOIN clientes on cotizacion.idcliente=clientes.idcliente
                            LEFT JOIN usuarios ON usuarios.idusuario=cotizacion.idusuario
                            WHERE cotizacion.fechainicial LIKE '%$fechaFin%'";
                }
                if($opcion == "fechadiferente"){
                    $sql = "select cotizacion.idcotizacion, CONCAT(clientes.nombres,' ',clientes.apellidos) as cliente,
                            clientes.cedula,        
                            CONCAT(usuarios.nombres,' ',usuarios.apellidos)as vendedor,
                            cotizacion.formapago, cotizacion.totalcotizacion, date_format(cotizacion.fechainicial,  '%Y/%m/%d')as fechainicial,
                            date_format(cotizacion.fechamovimiento,  '%Y/%m/%d')as fechamovimiento, cotizacion.estado,cotizacion.idcliente
                            from cotizacion
                            INNER JOIN clientes on cotizacion.idcliente=clientes.idcliente
                            LEFT JOIN usuarios ON usuarios.idusuario=cotizacion.idusuario
                            WHERE date(cotizacion.fechainicial) BETWEEN '$fechaInicio' AND '$fechaFin'";
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
        //ver cotizacion valores detalle
        static public function MdlCotizacionValorDetalle($tabla,$idcotizacion){
            if(Conexion::conectar() !="errorConexion"){
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idcotizacion=$idcotizacion");
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
        //eliminar cotizacion 
        static public function MdlEliminaCot($tabla,$datos){
            if(Conexion::conectar()!="errorConexion"){
                $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idcotizacion = :idcotizacion");
                if($stmt == false){
                    return "errorBorrar";
                }else{
                    $stmt -> bindParam(":idcotizacion", $datos["idcotizacion"], PDO::PARAM_STR);
                    if($stmt->execute()){
                        return "ok";
                    }else{
                        return "errorBorrar";
                    }
                    $stmt -> close();
                    $stmt = null;
                }
            }else{
                return "errorConexion";
            }
        }
        //ver total ventas
        static public function MdlCotizacionTotalVentas($tabla){
            if(Conexion::conectar() !="errorConexion"){
                $stmt = Conexion::conectar()->prepare("SELECT sum(totalcotizacion)as total FROM $tabla WHERE estado=1");
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
?>