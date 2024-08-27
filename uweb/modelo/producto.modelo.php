<?php
    require_once "conexion.php";
    class ModeloProducto{

        //nuevo producto
        static public function MdlNuevoProducto($tabla,$datos){
            $db = Conexion::conectar();
            if($db !="errorConexion"){
                $stmt = $db->prepare("INSERT INTO $tabla(codigo, nombre, descripcion, valor, iva, valoriva, idtipoproducto) VALUES (:codigo, :nombre, :descripcion, :valor, :iva, :valoriva, :idtipoproducto)");
                if($stmt == false){
                    return"errorAgregar";
                }else{
                    $stmt -> bindParam(":codigo",$datos["codigo"], PDO::PARAM_STR);
                    $stmt -> bindParam(":nombre",$datos["nombre"], PDO::PARAM_STR);
                    $stmt -> bindParam(":descripcion",$datos["descripcion"], PDO::PARAM_STR);
                    $stmt -> bindParam(":valor",$datos["valor"], PDO::PARAM_STR);
                    $stmt -> bindParam(":iva",$datos["iva"], PDO::PARAM_STR);
                    $stmt -> bindParam(":valoriva",$datos["valoriva"], PDO::PARAM_STR);
                    $stmt -> bindParam(":idtipoproducto",$datos["idtipoproducto"], PDO::PARAM_STR);
                    if($stmt->execute()){
                        $_SESSION['IDPrd'] = $db -> lastInsertId();
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
        //mostrar producto(s)
        static public function MdlVerProductos($tabla,$item,$valor){
            if(Conexion::conectar() !="errorConexion"){
                if($item != null){
                    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla
                                                           INNER JOIN tipoproducto ON productos.idtipoproducto = tipoproducto.idtipoproducto 
                                                           WHERE $item = :$item");
                    if($stmt == false){
                        return"errorConsulta";
                    }else{
                        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
                        $stmt -> execute();
                        return $stmt -> fetch();
                    }
                }else{
                    $stmt = Conexion::conectar()->prepare("SELECT productos.idproducto, productos.codigo, productos.nombre, productos.descripcion, productos.valor, productos.iva, productos.valoriva, tipoproducto.tipoproducto, productos.fechaingreso, productos.fechamodificacion
                                                           FROM productos
                                                           INNER JOIN tipoproducto ON productos.idtipoproducto = tipoproducto.idtipoproducto");
                    if($stmt == false){
                        return"errorConsulta";
                        }else{
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
        //actualizar producto seleccionado
        static public function MdleditarProductoSel($tabla,$datos){
            if(Conexion::conectar()!="errorConexion"){
                $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET codigo = :codigo, nombre = :nombre, descripcion = :descripcion, valor = :valor, iva = :iva, valoriva = :valoriva, idtipoproducto = :idtipoproducto, fechamodificacion = :fechamodificacion WHERE idproducto = :idproducto");
                if($stmt == false){
                    return "errorActualizar";
                }else{
                    $stmt -> bindParam(":codigo",$datos["codigo"], PDO::PARAM_STR);
                    $stmt -> bindParam(":nombre",$datos["nombre"], PDO::PARAM_STR);
                    $stmt -> bindParam(":descripcion",$datos["descripcion"], PDO::PARAM_STR);
                    $stmt -> bindParam(":valor",$datos["valor"], PDO::PARAM_STR);
                    $stmt -> bindParam(":iva",$datos["iva"], PDO::PARAM_STR);
                    $stmt -> bindParam(":valoriva",$datos["valoriva"], PDO::PARAM_STR);
                    $stmt -> bindParam(":fechamodificacion",$datos["fechamodificacion"], PDO::PARAM_STR);
                    $stmt -> bindParam(":idtipoproducto",$datos["idtipoproducto"], PDO::PARAM_STR);
                    $stmt -> bindParam(":idproducto",$datos["idproducto"], PDO::PARAM_STR);
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
        //mostrar uso idtipoproducto(verificar)
        static public function MdlVerfTipoProducto($tabla,$datos){
            if(Conexion::conectar() !="errorConexion"){
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idtipoproducto = $datos");
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
        //cantidad productos
        static public function MdlCantProducto($tabla){
            if(Conexion::conectar() !="errorConexion"){
                $stmt = Conexion::conectar()->prepare("SELECT count(idproducto)as cantProductos FROM $tabla");
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