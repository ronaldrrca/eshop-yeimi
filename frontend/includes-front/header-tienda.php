
<div class="header_identidad_marca">
            <a href="">
                <img class="logo" src="assets/imgs-site/logo.svg" alt="logo">
                <h1 class="texto-gris">Sharyam<br><span>Makeup</span> </h1>
            </a>
</div>

<nav id="nav" class="nav">
    <img id="icono_cerrar_menu" class="icono_cerrar_menu" src="assets/imgs-site/cerrar-menu-icono.svg" alt="icono cerrar menu">
    <ul>
        <li><a href="index.php">Inicio</a></li>
        <li><a href="productos.php">Productos</a></li>
        <li><a href="#">Sobre Nosotros</a></li>
        <li><a href="#">Contacto</a></li>
        <?php
            if (isset($_SESSION['id_cliente'])) { ?>
                <li class="header_menu_ocultables"><a href="#">Mis datos</a></li>
                <li class="header_menu_ocultables"><a href="#">Mis compras</a></li>
                <li class="header_menu_ocultables"><a href="#">Cambiar contraseña</a></li>
                <li><a href="backend/controlers/authentications/logout.php">Cerrar sesión</a></li>
           <?php } else { ?>
            <li><a href="login-cliente.php">Login</a></li>
            <?php } ?>
    </ul>
</nav>

<div class="header_iconos_varios">
<img class="icono_usuario" src="assets/imgs-site/usuario-icono.svg" alt="icono de usuario">
    <div id="header_usuario" class="header_usuario">
        <span><?php 
            if (isset($_SESSION['cliente'])) { ?>
                <span class="header_usuario_nombreCliente"><?php echo $_SESSION['cliente']; ?></span>
                <ul id="header_menu_datosUsuario" class="header_menu_datosUsuario">
                    <li><a href="#">Mis datos</a></li>
                    <li><a href="#">Mis compras</a></li>
                    <li><a href="#">Cambiar contraseña</a></li>
                </ul>
            <?php } ?>
        </span>
    </div>
    
    <img class="icono_carrito" src="assets/imgs-site/carrito-icono.svg" alt="icono del carrito de compras">
    <img id="icono_menu" class="icono_menu" src="assets/imgs-site/menu-icono.svg" alt="icono menu">
</div>




