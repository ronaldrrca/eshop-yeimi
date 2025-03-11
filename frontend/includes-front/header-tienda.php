<div class="header_contenedor_varios">
    <div class="social-icons">
        <a href="#" class="social-icon twitter" target="_blank">
            <svg viewBox="0 0 24 24"><path d="M22 5.8a8.3 8.3 0 0 1-2.3.6 4 4 0 0 0 1.8-2.2 8.1 8.1 0 0 1-2.6 1A4 4 0 0 0 11 9a11.3 11.3 0 0 1-8.2-4.2A4 4 0 0 0 5 10.5a4 4 0 0 1-1.8-.5v.1a4 4 0 0 0 3.2 4 4 4 0 0 1-1.8 0 4 4 0 0 0 3.7 2.8A8.2 8.2 0 0 1 2 18.2a11.4 11.4 0 0 0 6 1.8c7.2 0 11.2-6 11.2-11.2V8a8 8 0 0 0 2-2.2Z"/></svg>
        </a>

        <a href="#" class="social-icon facebook" target="_blank">
            <svg viewBox="0 0 24 24"><path d="M9 8H6v4h3v12h5V12h3.6L18 8h-4V6.3c0-.9.2-1.3 1.3-1.3H18V0h-3c-3.2 0-5 1.5-5 4.4V8Z"/></svg>
        </a>

        <a href="#" class="social-icon instagram" target="_blank">
            <svg viewBox="0 0 24 24"><path d="M7 2C4.2 2 2 4.2 2 7v10c0 2.8 2.2 5 5 5h10c2.8 0 5-2.2 5-5V7c0-2.8-2.2-5-5-5H7Zm10 2c1.7 0 3 1.3 3 3v10c0 1.7-1.3 3-3 3H7c-1.7 0-3-1.3-3-3V7c0-1.7 1.3-3 3-3h10ZM12 7a5 5 0 1 0 0 10 5 5 0 0 0 0-10Zm0 2a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm4.5-3a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3Z"/></svg>
        </a>

        <a href="#" class="social-icon youtube" target="_blank">
            <svg viewBox="0 0 24 24"><path d="M10 15.5V8.5L16 12l-6 3.5ZM23 7s-.2-1.6-.8-2.3a3.2 3.2 0 0 0-2.3-.8c-3.2-.2-8-.2-8-.2s-4.8 0-8 .2a3.2 3.2 0 0 0-2.3.8C1.2 5.4 1 7 1 7S.8 8.6.8 10v4c0 1.4.2 3 .8 3.7a3.2 3.2 0 0 0 2.3.8c3.2.2 8 .2 8 .2s4.8 0 8-.2a3.2 3.2 0 0 0 2.3-.8c.6-.7.8-2.3.8-3.7v-4c0-1.4-.2-3-.8-3.7Z"/></svg>
        </a>

        <a href="#" class="social-icon pinterest" target="_blank">
            <svg width="100%" height="100%" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 0C5.373 0 0 5.373 0 12c0 5.188 3.303 9.605 7.912 11.239-.11-.955-.202-2.423.04-3.467.219-.939 1.414-5.974 1.414-5.974s-.361-.723-.361-1.793c0-1.678.974-2.931 2.187-2.931 1.032 0 1.532.775 1.532 1.705 0 1.038-.661 2.591-1.002 4.027-.284 1.199.6 2.177 1.782 2.177 2.138 0 3.784-2.255 3.784-5.506 0-2.88-2.069-4.892-5.029-4.892-3.43 0-5.447 2.57-5.447 5.229 0 1.038.4 2.152.9 2.756.099.118.113.221.084.34-.09.375-.296 1.199-.336 1.365-.053.22-.177.267-.41.161-1.535-.64-2.491-2.64-2.491-4.251 0-3.457 2.51-6.634 7.238-6.634 3.799 0 6.756 2.706 6.756 6.322 0 3.772-2.38 6.811-5.689 6.811-1.11 0-2.151-.575-2.506-1.251l-.681 2.598c-.246.952-.907 2.144-1.349 2.868.972.301 2.001.464 3.067.464 6.627 0 12-5.373 12-12S18.627 0 12 0z"/></svg>

        </a>
</div>

<div class="header_identidad_marca">
        <img class="logo" src="assets/imgs-site/logo.svg" alt="logo">
        <h1 class="texto-gris">Sharyam Makeup</h1>
    </div>
    <div class="header_iconos_varios">
        <div id="header_usuario" class="header_usuario">
            <span><?php 
                if (isset($_SESSION['nombre_cliente'])) { ?>
                    <span class="header_usuario_nombreCliente"><?php echo $_SESSION['nombre_cliente']; ?></span>
                    <ul id="header_menu_datosUsuario" class="header_menu_datosUsuario">
                        <li><a href="#">Mis datos</a></li>
                        <li><a href="#">Mis compras</a></li>
                        <li><a href="#">Cambiar contraseña</a></li>
                    </ul>
                <?php } ?>
            </span>
            <img class="icono_usuario" src="assets/imgs-site/usuario-icono.svg" alt="icono de usuario">
            
        </div>
        <img class="icono_carrito" src="assets/imgs-site/carrito-icono.svg" alt="icono del carrito de compras">
        <img id="icono_menu" class="icono_menu" src="assets/imgs-site/menu-icono.svg" alt="icono menu">
    </div>
</div>

<nav id="nav" class="nav">
    <img id="icono_cerrar_menu" class="icono_cerrar_menu" src="assets/imgs-site/cerrar-menu-icono.svg" alt="icono cerrar menu">
    <ul>
        <li><a href="#">Inicio</a></li>
        <li><a href="#">Productos</a></li>
        <li><a href="#">Sobre Nosotros</a></li>
        <li><a href="#">Contacto</a></li>
        <?php
            if (isset($_SESSION['id_cliente'])) { ?>
                <li class="header_menu_ocultables"><a href="#">Mis datos</a></li>
                <li class="header_menu_ocultables"><a href="#">Mis compras</a></li>
                <li class="header_menu_ocultables"><a href="#">Cambiar contraseña</a></li>
                <li><a href="#">Cerrar sesión</a></li>
           <?php } else { ?>
            <li><a href="#">Login</a></li>
            <?php } ?>
    </ul>
</nav>

