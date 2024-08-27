<?php
require_once "conexion.php";

class ModeloTipoProducto{

    //crear tipo cliente
    static public function mdlIngresarTipoProducto($tabla,$datos){
        $db = Conexion::conectar();
        if($db !="errorConexion"){
            $stmt = $db->prepare("INSERT INTO $tabla (tipoproducto) VALUES (:tipoproducto)");
            if($stmt == false){
                return"errorAgregar";
            }else{
                $stmt -> bindParam(":tipoproducto",$datos, PDO::PARAM_STR);
                if($stmt->execute()){
                    $_SESSION['idTpr'] = $db -> lastInsertId();
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
    static public function MdlMostrarTipoProducto($tabla,$item,$valor){
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
    static public function mdlEditarTipoProducto($tabla,$datos){
        if(Conexion::conectar()!="errorConexion"){
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla set tipoproducto =:tipoproducto WHERE idtipoproducto=:idtipoproducto");
            if($stmt == false){
                return"errorAgregar";
            }else{
                $stmt -> bindParam(":idtipoproducto",$datos["idtipoproducto"], PDO::PARAM_STR);
                $stmt -> bindParam(":tipoproducto",$datos["tipoproducto"], PDO::PARAM_STR);
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
    static public function mdlEliminarTipoProducto($tabla,$datos){
        if(Conexion::conectar()!="errorConexion"){
            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idtipoproducto=:idtipoproducto");
            if($stmt == false){
                return"errorEliminar";
            }else{
                $stmt -> bindParam(":idtipoproducto",$datos["idtipoproducto"], PDO::PARAM_STR);
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