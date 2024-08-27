<?php
class Conexion{
    static public function conectar(){
        try{
            $cnx = new PDO("mysql:host=localhost;dbname=bdsoluweb","root","");
            $cnx ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $cnx->exec("set names utf8");
            return $cnx;
        }catch (PDOException $e){
            return "errorConexion";
        }
    }
}
?>