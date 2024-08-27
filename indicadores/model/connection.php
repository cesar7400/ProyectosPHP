<?php
class Connection{
    static public function connecting(){
        try{
            $cnx = new PDO("mysql:host=localhost;dbname=moodle","root","");
            $cnx ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $cnx->exec("set names utf8");
            return $cnx;
        }catch (PDOException $e){
            return "connectionError";
        }
    }
}
?>