<?php
    require_once "conexion.php";
    class ModeloCliente{

        //mostrar tipo cliente
        static public function MdlMostrarTipoCliente($tabla){
            if(Conexion::conectar() !="errorConexion"){
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
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
        //mostrar uso idtipocliente(verificar)
        static public function MdlVerfTipoCliente($tabla,$datos){
            if(Conexion::conectar() !="errorConexion"){
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idtipocliente = $datos");
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
        //mostrar cliente(s)
        static public function MdlVerClientes($tabla,$item,$valor){
            if(Conexion::conectar() !="errorConexion"){
                if($item != null){
                    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla
                                                           INNER JOIN tipocliente ON clientes.idtipocliente = tipocliente.idtipocliente 
                                                           WHERE $item = :$item");
                    if($stmt == false){
                        return"errorConsulta";
                    }else{
                        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
                        $stmt -> execute();
                        return $stmt -> fetch();
                    }
                }else{
                    $stmt = Conexion::conectar()->prepare("SELECT clientes.nombres, clientes.apellidos, clientes.cedula, clientes.nit, clientes.email, tipocliente.tipocliente, clientes.telefono, clientes.celular, clientes.ciudad, clientes.direccion, clientes.idcliente
                                                           FROM clientes
                                                           INNER JOIN tipocliente ON clientes.idtipocliente = tipocliente.idtipocliente");
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
        //nuevo cliente
        static public function MdlNuevoCliente($tabla,$datos){
            $db = Conexion::conectar();
            if($db !="errorConexion"){
                $stmt = $db->prepare("INSERT INTO $tabla(nombres, apellidos, cedula, nit, email, idtipocliente, telefono, celular, ciudad, direccion) VALUES (:nombres, :apellidos, :cedula, :nit, :email, :idtipocliente, :telefono, :celular, :ciudad, :direccion)");
                if($stmt == false){
                    return"errorAgregar";
                }else{
                    $stmt -> bindParam(":nombres",$datos["nombres"], PDO::PARAM_STR);
                    $stmt -> bindParam(":apellidos",$datos["apellidos"], PDO::PARAM_STR);
                    $stmt -> bindParam(":cedula",$datos["cedula"], PDO::PARAM_STR);
                    $stmt -> bindParam(":nit",$datos["nit"], PDO::PARAM_STR);
                    $stmt -> bindParam(":email",$datos["email"], PDO::PARAM_STR);
                    $stmt -> bindParam(":idtipocliente",$datos["idtipocliente"], PDO::PARAM_STR);
                    $stmt -> bindParam(":telefono",$datos["telefono"], PDO::PARAM_STR);
                    $stmt -> bindParam(":celular",$datos["celular"], PDO::PARAM_STR);
                    $stmt -> bindParam(":ciudad",$datos["ciudad"], PDO::PARAM_STR);
                    $stmt -> bindParam(":direccion",$datos["direccion"], PDO::PARAM_STR);
                    if($stmt->execute()){
                        $_SESSION['insertID'] = $db -> lastInsertId();
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
        //actualizar cliente seleccionado
        static public function MdleditarClienteSel($tabla,$datos){
            if(Conexion::conectar()!="errorConexion"){
                $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombres = :nombres, apellidos = :apellidos, cedula = :cedula, nit = :nit, email = :email, idtipocliente = :idtipocliente, telefono = :telefono, celular = :celular, ciudad = :ciudad, direccion = :direccion, fechamodificacion = :fechamodificacion WHERE idcliente = :idcliente");
                if($stmt == false){
                    return "errorActualizar";
                }else{
                    $stmt -> bindParam(":nombres",$datos["nombres"], PDO::PARAM_STR);
                    $stmt -> bindParam(":apellidos",$datos["apellidos"], PDO::PARAM_STR);
                    $stmt -> bindParam(":cedula",$datos["cedula"], PDO::PARAM_STR);
                    $stmt -> bindParam(":nit",$datos["nit"], PDO::PARAM_STR);
                    $stmt -> bindParam(":email",$datos["email"], PDO::PARAM_STR);
                    $stmt -> bindParam(":idtipocliente",$datos["idtipocliente"], PDO::PARAM_STR);
                    $stmt -> bindParam(":telefono",$datos["telefono"], PDO::PARAM_STR);
                    $stmt -> bindParam(":celular",$datos["celular"], PDO::PARAM_STR);
                    $stmt -> bindParam(":ciudad",$datos["ciudad"], PDO::PARAM_STR);
                    $stmt -> bindParam(":direccion",$datos["direccion"], PDO::PARAM_STR);
                    $stmt -> bindParam(":fechamodificacion",$datos["fechamodificacion"], PDO::PARAM_STR);
                    $stmt -> bindParam(":idcliente",$datos["idcliente"], PDO::PARAM_STR);
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
        //mostrar tipo cliente
        static public function MdlCantlientes($tabla){
            if(Conexion::conectar() !="errorConexion"){
                $stmt = Conexion::conectar()->prepare("SELECT count(idcliente)as cantClientes FROM $tabla");
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