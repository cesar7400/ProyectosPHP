<?php

    class ControladorUsuario{
        //login usuario
        static public function ctrLoginUsuario(){
            if(isset($_POST["loginUsuario"]) && isset($_POST["LoginContrasena"])){
                if(preg_match('/^[a-zA-Z0-9.]+@[a-zA-Z0-9]+\.[a-z]{2,}$/', $_POST["loginUsuario"])){
                    $item = "email";
                }else{
                    $item = "usuario";
                }
                $encriptar = crypt($_POST["LoginContrasena"],'$2a$07$usesomesillystringforsalt$');
                $tabla = "usuarios";
                $valor = $_POST["loginUsuario"];
                $respuesta = ModeloUsuarios::MdlVerUsuarios($tabla,$item,$valor);
                if($respuesta != "errorConexion"){
                    if($item == "usuario"){
                        $rpta = $respuesta["usuario"];
                    }else{
                        $rpta = $respuesta["email"];
                    }
                    if($rpta == $_POST["loginUsuario"] && $respuesta["password"] == $encriptar){
                        if($respuesta["estado"] == 1){
                            $_SESSION["inicioSesion"] = "ok";
                            $_SESSION["idUsuario"] = $respuesta["idusuario"];
                            $idUsuario = $respuesta["idusuario"];
                            //registro fecha ultimo login
                            date_default_timezone_set('America/Bogota');
                            $fecha = date('Y-m-d');
                            $hora = date('H:i:s');
                            $fechaActual = $fecha.' '.$hora;
                            $ultimoLogin = ModeloUsuarios::mdlActualizarLoginUsuario($tabla, "ultimo_login", $fechaActual, $respuesta["idusuario"]);
                            if($ultimoLogin == "ok"){
                                $datos = array("idusuario" => $_SESSION["idUsuario"],
                                               "tipomovimiento" => "usuario",
                                               "estado_actual" => "ingreso sistema",
                                               "id" => $_SESSION["idUsuario"]);
                                ControladorHistorial::ctrNuevoHistorial($datos);
                                echo '<script> window.location = "inicio"; </script>';
                            }else{
                                session_destroy();
                                echo '<br><div class="alert alert-danger">Error al ingresar.</br>Intentar de nuevo.</div>';
                            }
                        }else{
                            echo '<div id="loginError" class="alert alert-info">El usuario no está activado</div>';
                        }
                    }else{
                        echo '<div id="loginError" class="alert alert-danger">Usuario y/o contraseña no validos</div>';
                    }
                }else{
                    echo '<div id="loginError" class="alert alert-danger">No es posible la conexión con el servidor.</div>';
                }
            }
        }
        //carga imagen usuario al iniciar sesión
        static public function imagenLoginUsuario($idUsuario){
            if(isset($idUsuario)){
                $tabla = "usuarios";
                $item = "idusuario";
                $valor = $idUsuario;
                $respuesta = ModeloUsuarios::MdlVerUsuarios($tabla,$item,$valor);
                if($respuesta != "errorConexion"){
                    $_SESSION["imagen"] = $respuesta["imagen"];
                    $_SESSION["nombres"] = $respuesta["nombres"];
                    $_SESSION["apellidos"] = $respuesta["apellidos"];
                }else{
                    echo '<img src="vista/img/usuarios/default user.png" class="img-circle" alt="User Image">';
                }
            }
        }
        //nuevo usuario
        static public function ctrNuevoUsuario($datos){
            $tabla = "usuarios";
            //validar imagen
            $ruta = "";
            $directorio = "";
            if(isset($datos["imagen"]['tmp_name'])){
                list($ancho, $alto) = getimagesize($datos["imagen"]['tmp_name']);
                $nuevoAncho = 500;
                $nuevoAlto = 500;
                //crear directorio donde se almacena la imagen del usuario
                $directorio = "../../vista/img/usuarios/".$datos["usuario"];
                //si el directorio no existe, se procede a crearlo
                if (!file_exists($directorio)){
                    mkdir($directorio, 0755);
                }
                //de acuerdo al tipo de imagen se aplican las funciones por defecto de php
                if($datos["imagen"]["type"] == "image/jpeg"){
                    //almacena imagen en el directorio
                    $aleatorio = mt_rand(100,999);
                    $ruta = "../../vista/img/usuarios/".$datos["usuario"]."/".$aleatorio.".jpg";
                    $origen = imagecreatefromjpeg($datos["imagen"]['tmp_name']);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagejpeg($destino,$ruta);
                }
                if($datos["imagen"]["type"] == "image/png"){
                    //almacena imagen en el directorio
                    $aleatorio = mt_rand(100,999);
                    $ruta = "../../vista/img/usuarios/".$datos["usuario"]."/".$aleatorio.".png";
                    $origen = imagecreatefrompng($datos["imagen"]['tmp_name']);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagejpeg($destino,$ruta);
                }
            }
            $encriptar = crypt($datos["password"],'$2a$07$usesomesillystringforsalt$');
            $reemplazo = array("password" => $encriptar);
            if($ruta == ""){
                $r = "";
            }else{
                $r=array('imagen' => substr($ruta,6),);
            }
            $resultado = array_merge((array)$datos,(array)$r);
            $rpta = array_replace($resultado, $reemplazo);
            $tabla="usuarios";
            $respuesta = ModeloUsuarios::MdlNuevoUsuarios($tabla,$rpta);
            $datos = array("idusuario" => $_SESSION["idUsuario"],
                           "tipomovimiento" => "usuario",
                           "estado_actual" => "Nuevo usuario",
                           "id" => $_SESSION["insertID"]);
            ControladorHistorial::ctrNuevoHistorial($datos);
            return $respuesta;
        }

        //mostrar usuarios
        static public function ctrVerUsuarios($item,$valor){
            $tabla="usuarios";
            $respuesta = ModeloUsuarios::MdlVerUsuarios($tabla,$item,$valor);
            return $respuesta;
        }
        /*Editar usuario*/
        static public function ctrEditarUsuario($datos){

            $tabla = "usuarios";
            //validar imagen
            $ruta = "";
            $directorio = "";
            if(isset($datos["imagenEditar"]['tmp_name'])){
                list($ancho, $alto) = getimagesize($datos["imagenEditar"]['tmp_name']);
                $nuevoAncho = 500;
                $nuevoAlto = 500;
                //crear directorio donde se almacena la imagen del usuario
                $directorio = "../../vista/img/usuarios/".$datos["usuarioActual"];
                if($datos["usuarioActual"] != $datos["editaUsuario"]){
                    if(file_exists($directorio)){
                        rename($directorio,"../../vista/img/usuarios/".$datos["editaUsuario"]);
                        $directorio = "../../vista/img/usuarios/".$datos["editaUsuario"];
                        $rutaEliminar = str_replace($datos["usuarioActual"],$datos["editaUsuario"],$datos["imagenActual"]);
                        $datos["usuarioActual"] = $datos["editaUsuario"];
                    }
                }else{
                    $directorio = "../../vista/img/usuarios/".$datos["usuarioActual"];
                    $rutaEliminar = $datos["imagenActual"];
                }
                //preguntar si existe foto de usuario en la BD
                if($rutaEliminar != ""){
                    
                    unlink("../../".$rutaEliminar);
                }else{
                    if(file_exists($directorio) == false){
                        mkdir($directorio, 0755);
                    }
                }
                //de acuerdo al tipo de imagen se aplican las funciones por defecto de php
                if($datos["imagenEditar"]["type"] == "image/jpeg"){
                    //almacena imagen en el directorio
                    $aleatorio = mt_rand(100,999);
                    $ruta = "../../vista/img/usuarios/".$datos["usuarioActual"]."/".$aleatorio.".jpg";
                    $origen = imagecreatefromjpeg($datos["imagenEditar"]['tmp_name']);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagejpeg($destino,$ruta);
                }
                if($datos["imagenEditar"]["type"] == "image/png"){
                    //almacena imagen en el directorio
                    $aleatorio = mt_rand(100,999);
                    $ruta = "../../vista/img/usuarios/".$datos["usuarioActual"]."/".$aleatorio.".png";
                    $origen = imagecreatefrompng($datos["imagenEditar"]['tmp_name']);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagejpeg($destino,$ruta);
                }
            }
            if(($datos["usuarioActual"] != $datos["editaUsuario"]) && ($datos["imagenActual"] != "") && (isset($datos["imagenEditar"]['tmp_name']) == false)){
                
                rename("../../vista/img/usuarios/".$datos["usuarioActual"],"../../vista/img/usuarios/".$datos["editaUsuario"]);
                $rutaActual = str_replace($datos["usuarioActual"],$datos["editaUsuario"],$datos["imagenActual"]);
                $datos["imagenActual"] = $rutaActual;
                $datos["usuarioActual"] = $datos["editaUsuario"];
            }
            if($datos["editarPassword"] != ""){
                $encriptar = crypt($datos["editarPassword"],'$2a$07$usesomesillystringforsalt$');
            }else{
                $encriptar = $datos["passworActual"];
            }
            $reemplazo = array("password" => $encriptar);
            if($ruta == ""){
                $r = $datos["imagenActual"];
            }else{
                $r=array('imagenActual' => substr($ruta,6),);
            }
            $resultado = array_merge((array)$datos,(array)$r);
            $rpta = array_replace($resultado, $reemplazo);
            $tabla="usuarios";
            $respuesta = ModeloUsuarios::MdleditarUsuarioSel($tabla,$rpta);
            $datos = array("idusuario" => $_SESSION["idUsuario"],
                           "tipomovimiento" => "usuario",
                           "estado_actual" => "Edito usuario",
                           "id" => $rpta['idusuario']);
            ControladorHistorial::ctrNuevoHistorial($datos);
            return $respuesta;
        }
        //eliminar usuario
        static public function ctrEliminarUsuario($datos){
            $tabla = "usuarios";
            $respuesta = ModeloUsuarios::MdlEliminarUsuario($tabla,$datos);
            if($respuesta == "ok"){
                if(($datos["imagen"]) != ""){
                    unlink('../../'.$datos["imagen"]);
                    rmdir('../../vista/img/usuarios/'.$datos["usuario"]);
                }
                $datos = array("idusuario" => $_SESSION["idUsuario"],
                               "tipomovimiento" => "usuario",
                               "estado_actual" => "Elimino usuario: '".$datos["usuario"]."'",
                               "id" => $datos["idusuario"]);
                ControladorHistorial::ctrNuevoHistorial($datos);
            }
            return $respuesta;
        }
        //actualiza estado usuario
        static public function ctrActivarDesactivar($item, $datos){
            $tabla = "usuarios";
            $respuesta = ModeloUsuarios::mdlActivarDesactivar($tabla, $item, $datos);
            if($respuesta == "ok"){
                $datos = array("idusuario" => $_SESSION["idUsuario"],
                               "tipomovimiento" => "usuario",
                               "estado_actual" => "Cambio estado usuario",
                               "id" => $datos['idusuario']);
                ControladorHistorial::ctrNuevoHistorial($datos);
            }
            return $respuesta;
        }
    }

?>