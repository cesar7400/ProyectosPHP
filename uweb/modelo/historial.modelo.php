<?php
    require_once "conexion.php";
    class ModeloHistorial{

        //nuevo movimiento
        static public function MdlNuevoHistorial($tabla,$datos){
            if(Conexion::conectar()!="errorConexion"){
                $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idusuario, tipomovimiento, estado_actual, id) VALUES (:idusuario, :tipomovimiento, :estado_actual, :id)");
                if($stmt == false){
                    return"errorAgregar";
                }else{
                    $stmt -> bindParam(":idusuario",$datos['idusuario'], PDO::PARAM_STR);
                    $stmt -> bindParam(":tipomovimiento",$datos['tipomovimiento'], PDO::PARAM_STR);
                    $stmt -> bindParam(":estado_actual",$datos['estado_actual'], PDO::PARAM_STR);
                    $stmt -> bindParam(":id",$datos['id'], PDO::PARAM_STR);
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

        //borrar historial
        static public function MdlEliminarHistorial($tabla){
            if(Conexion::conectar()!="errorConexion"){
                $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla");
                if($stmt == false){
                    return "errorBorrar";
                }else{
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
        //ver usuarios
        static public function MdlVerHistorial(){
            if(Conexion::conectar() !="errorConexion"){
                $stmt = Conexion::conectar()->prepare("SELECT concat(u1.nombres,' ',u1.apellidos) as Usuario,
                                                       historial.estado_actual as tipo_movimiento,
                                                       concat(u2.nombres, ' ', u2.apellidos) as Usuario_movimiento,
                                                       historial.fechamovimiento as fecha
                                                       from historial
                                                       RIGHT JOIN usuarios as u1 on historial.idusuario=u1.idusuario
                                                       LEFT JOIN usuarios as u2 on historial.id=u2.idusuario
                                                       WHERE historial.tipomovimiento='usuario'
                                                       UNION
                                                       SELECT concat(usuarios.nombres,' ',usuarios.apellidos) as Usuario, 
                                                       historial.estado_actual as tipo_movimiento,
                                                       concat(clientes.nombres, ' ', clientes.apellidos) as Usuario_movimiento,
                                                       historial.fechamovimiento as fecha
                                                       FROM historial
                                                       RIGHT JOIN usuarios ON historial.idusuario=usuarios.idusuario
                                                       LEFT JOIN clientes on historial.id=clientes.idcliente
                                                       WHERE historial.tipomovimiento='cliente'
                                                       UNION
                                                       SELECT concat(usuarios.nombres,' ',usuarios.apellidos) as usuario,
                                                       historial.estado_actual as tipo_movimiento,
                                                       tipocliente.tipocliente as Usuario_movimiento,
                                                       historial.fechamovimiento as fecha
                                                       FROM historial
                                                       LEFT JOIN tipocliente ON historial.id = tipocliente.idtipocliente
                                                       RIGHT JOIN usuarios ON historial.idusuario = usuarios.idusuario
                                                       WHERE historial.tipomovimiento='tipocliente'
                                                       UNION
                                                       SELECT concat(usuarios.nombres,' ',usuarios.apellidos) as usuario,
                                                       historial.estado_actual as tipo_movimiento,
                                                       CONCAT(productos.codigo,' ',productos.nombre)as Usuario_movimiento,
                                                       historial.fechamovimiento as fecha
                                                       FROM historial
                                                       RIGHT JOIN usuarios ON historial.idusuario=usuarios.idusuario
                                                       LEFT JOIN productos ON historial.id=productos.idproducto
                                                       WHERE historial.tipomovimiento='producto'
                                                       UNION
                                                       SELECT concat(usuarios.nombres,' ',usuarios.apellidos) as usuario,
                                                       historial.estado_actual as tipo_movimiento,
                                                       tipoproducto.tipoproducto as Usuario_movimiento,
                                                       historial.fechamovimiento as fecha
                                                       FROM historial
                                                       LEFT JOIN tipoproducto ON historial.id = tipoproducto.idtipoproducto
                                                       RIGHT JOIN usuarios ON historial.idusuario = usuarios.idusuario
                                                       WHERE historial.tipomovimiento='tipoproducto'
                                                       UNION
                                                       SELECT concat(usuarios.nombres,' ',usuarios.apellidos) as Usuario, 
                                                       historial.estado_actual as tipo_movimiento,
                                                       concat('numero cotizacion: ',cotizacion.idcotizacion,'-', clientes.nombres,' ',clientes.apellidos) as Usuario_movimiento,
                                                       historial.fechamovimiento as fecha
                                                       FROM historial
                                                       RIGHT JOIN usuarios ON historial.idusuario=usuarios.idusuario
                                                       LEFT JOIN cotizacion on historial.id=cotizacion.idcotizacion
                                                       LEFT JOIN clientes on cotizacion.idcliente=clientes.idcliente
                                                       WHERE historial.tipomovimiento='cotizacion'");
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
    }
?>