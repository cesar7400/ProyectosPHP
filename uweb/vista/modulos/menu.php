<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <?php
                    $loginImagen = new ControladorUsuario();
                    $loginImagen -> imagenLoginUsuario($_SESSION["idUsuario"]);
                    if(file_exists($_SESSION["imagen"])){
                        echo '<img src="'.$_SESSION["imagen"].'" class="img-rounded" alt="User Image">';
                    }else{
                        echo '<img src="vista/img/usuarios/default user.png" class="img-rounded" alt="User Image">';
                    }
                ?>
            </div>
            <div class="pull-left info">
                <p><span class="hidden-xs"><?php echo $_SESSION["nombres"].' '.$_SESSION["apellidos"]?></span></p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Conectado</a>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="inicio">
                    <i class="fa fa-home"></i>
                    <span>Inicio</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Usuarios</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="agregarUsuario">
                            <i class="fa fa-user-plus"></i>
                            <span>Nuevo usuario</span>
                        </a>
                        <a href="VerUsuarios">
                            <i class="fa fa-search"></i>
                            <span>Ver usuarios</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Clientes</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="agregarCliente">
                            <i class="fa fa-user-plus"></i>
                            <span>Nuevo cliente</span>
                        </a>
                        <a href="tipoCliente">
                            <i class="fa fa-user-circle"></i>
                            <span>Tipo cliente</span>
                        </a>
                        <a href="verClientes">
                            <i class="fa fa-search"></i>
                            <span>Ver clientes</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-product-hunt"></i>
                    <span>Producto</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="agregarProducto">
                            <i class="fa fa-cube"></i>
                            <span>Nuevo producto</span>
                        </a>
                        <a href="tipoProducto">
                            <i class="fa fa fa-th"></i>
                            <span>Tipo producto</span>
                        </a>
                        <a href="producto">
                            <i class="fa fa-search"></i>
                            <span>Ver productos</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list-ul"></i>
                    <span>Cotización</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="cotizaciones">
                            <i class="fa fa-circle-o"></i>
                            <span>Cotizaciones</span>
                        </a>
                        <a href="cotizacion">
                            <i class="fa fa-circle-o"></i>
                            <span>Nueva cotización</span>
                        </a>
                        <a href="reporte">
                            <i class="fa fa-circle-o"></i>
                            <span>Reporte cotizaciones</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-history"></i>
                    <span>Historial</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="verHistorial">
                            <i class="fa fa-history"></i>
                            <span>Historial</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
</aside>