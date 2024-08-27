<?php
require_once "conexion.php";

class ModeloTipocliente{

    //crear tipo cliente
    static public function mdlIngresarTipoCliente($tabla,$datos){
        $db = Conexion::conectar();
        if($db !="errorConexion"){
            $stmt = $db->prepare("INSERT INTO $tabla (tipocliente) VALUES (:tipocliente)");
            if($stmt == false){
                return"errorAgregar";
            }else{
                $stmt -> bindParam(":tipocliente",$datos, PDO::PARAM_STR);
                if($stmt->execute()){
                    $_SESSION['idTp'] = $db -> lastInsertId();
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
    //mostrar tipo clientes
    static public function MdlMostrarTipoCliente($tabla,$item,$valor){
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
    //editar tipo cliente
    static public function mdlEditarTipoCliente($tabla,$datos){
        if(Conexion::conectar()!="errorConexion"){
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla set tipocliente =:tipocliente WHERE idtipocliente=:idtipocliente");
            if($stmt == false){
                return"errorAgregar";
            }else{
                $stmt -> bindParam(":idtipocliente",$datos["idtipocliente"], PDO::PARAM_STR);
                $stmt -> bindParam(":tipocliente",$datos["tipocliente"], PDO::PARAM_STR);
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
    //eliminar categoria
    static public function mdlEliminarTipoCliente($tabla,$datos){
        if(Conexion::conectar()!="errorConexion"){
            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idtipocliente=:idtipocliente");
            if($stmt == false){
                return"errorEliminar";
            }else{
                $stmt -> bindParam(":idtipocliente",$datos["idtipocliente"], PDO::PARAM_STR);
                if($stmt->execute()){
                    return "ok";
                }else{
                    return "errorEliminar";
                }
                $stmt -> close();
                $stmt = null;
            }
        }else{
            return "errorConexion";
        }
    }
}