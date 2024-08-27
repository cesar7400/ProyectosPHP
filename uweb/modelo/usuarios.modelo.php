<?php 
    require_once "conexion.php";
    class ModeloUsuarios{

        //actualizar ingreso(login) usuario
        static public function mdlActualizarLoginUsuario($tabla, $item, $valor, $idusuario){
            if(Conexion::conectar()!="errorConexion"){
                $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE idusuario = :idusuario");
                if($stmt == false){
                    return "errorActualizar";
                }else{
                    $stmt -> bindParam(":idusuario", $idusuario, PDO::PARAM_STR);
                    $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
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
    
        //nuevo usuario
        static public function MdlNuevoUsuarios($tabla,$datos){
            $db = Conexion::conectar();
            if($db !="errorConexion"){
                $stmt = $db -> prepare("INSERT INTO $tabla(nombres, apellidos, email, usuario, password, imagen, estado) VALUES (:nombres, :apellidos, :email, :usuario, :password, :imagen, :estado);");
                if($stmt == false){
                    return"errorAgregar";
                }else{
                    $stmt -> bindParam(":nombres",$datos["nombres"], PDO::PARAM_STR);
                    $stmt -> bindParam(":apellidos",$datos["apellidos"], PDO::PARAM_STR);
                    $stmt -> bindParam(":email",$datos["email"], PDO::PARAM_STR);
                    $stmt -> bindParam(":usuario",$datos["usuario"], PDO::PARAM_STR);
                    $stmt -> bindParam(":password",$datos["password"], PDO::PARAM_STR);
                    $stmt -> bindParam(":imagen",$datos["imagen"], PDO::PARAM_STR);
                    $stmt -> bindParam(":estado",$datos["estado"], PDO::PARAM_STR);
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
        //ver usuarios
        static public function MdlVerUsuarios($tabla,$item,$valor){
            if(Conexion::conectar() !="errorConexion"){
                if($item != null){
                    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
                    if($stmt == false){
                        return"errorConsulta";
                    }else{
                        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
                        $stmt -> execute();
                        return $stmt -> fetch();
                    }
                }else{
                    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
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
        //actualizar usuario seleccionado
        static public function MdleditarUsuarioSel($tabla,$datos){
            if(Conexion::conectar() !="errorConexion"){
                $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombres = :nombres, apellidos = :apellidos, email = :email, usuario = :usuario, password = :password, fechamodificacion = :fechamodificacion, imagen = :imagen WHERE idusuario = :idusuario");
                if($stmt == false){
                    return "errorActualizar";
                }else{
                    $stmt -> bindParam(":nombres",$datos["nombres"], PDO::PARAM_STR);
                    $stmt -> bindParam(":apellidos",$datos["apellidos"], PDO::PARAM_STR);
                    $stmt -> bindParam(":email",$datos["email"], PDO::PARAM_STR);
                    $stmt -> bindParam(":usuario",$datos["usuarioActual"], PDO::PARAM_STR);
                    $stmt -> bindParam(":password",$datos["password"], PDO::PARAM_STR);
                    $stmt -> bindParam(":fechamodificacion",$datos["fechamodificacion"], PDO::PARAM_STR);
                    $stmt -> bindParam(":imagen",$datos["imagenActual"], PDO::PARAM_STR);
                    $stmt -> bindParam(":idusuario",$datos["idusuario"], PDO::PARAM_STR);
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
        //borrar usuario
        static public function MdlEliminarUsuario($tabla,$datos){
            if(Conexion::conectar()!="errorConexion"){
                $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idusuario = :idusuario");
                if($stmt == false){
                    return "errorBorrar";
                }else{
                    $stmt -> bindParam(":idusuario", $datos["idusuario"], PDO::PARAM_STR);
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
        //activar-desactivar usuario
        static public function mdlActivarDesactivar($tabla, $item, $datos){
            if(Conexion::conectar() !="errorConexion"){
                $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE idusuario = :idusuario");
                if($stmt == false){
                    return "errorActualizar";
                }else{
                    $stmt -> bindParam(":idusuario", $datos["idusuario"], PDO::PARAM_STR);
                    $stmt -> bindParam(":".$item, $datos["estado"], PDO::PARAM_STR);
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
    }

?>