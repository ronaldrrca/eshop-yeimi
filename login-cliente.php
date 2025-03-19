<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <!--Facebook y otras redes.-->
    <meta property="og:title" content="Tu Tienda Online - Encuentra lo Mejor">
    <meta property="og:description" content="Explora nuestra tienda y disfruta de grandes ofertas y envíos rápidos. ¡Compra ahora!">
    <meta property="og:image" content="URL_de_la_imagen_destacada">
    <meta property="og:url" content="https://www.tutienda.com">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <!--Para Compartir en Twitter/X-->
    <meta name="twitter:title" content="Tu Tienda Online - Encuentra lo Mejor">
    <meta name="twitter:description" content="Explora nuestra tienda y disfruta de grandes ofertas y envíos rápidos. ¡Compra ahora!">
    <meta name="twitter:image" content="URL_de_la_imagen_destacada">
    <link rel="canonical" href="https://www.tutienda.com/pagina-principal">
    <meta name="description" content="Descubre los mejores productos al mejor precio. Envíos rápidos, ofertas exclusivas y una experiencia de compra fácil y segura. ¡Compra ahora!">
    <title>Tu Tienda Online | Productos de Calidad al Mejor Precio</title>
    <link rel="shortcut icon" href="./assets/imgs-site/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./frontend/css/estilos-generales.css">
    <link rel="stylesheet" href="./frontend/css/estilos-headerTienda.css">
    <link rel="stylesheet" href="frontend/css/estilos-footer.css">
</head>
<body>
    <header><?php include_once './frontend/includes-front/header-tienda.php' ?></header>
    <main>
        <h2>Inicio de sesión</h2>
        <form id="formulario-login-cliente" class="formulario-login">
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" id="email" required autocomplete="email">
            <label for="password">Contraseña</label>
            <div class="password-container">
                <input type="password" name="password" id="password" placeholder="Contraseña">
                <button type="button" id="togglePassword">👁️</button>
                <div id="resultado-login"></div>
            </div>
            <input type="submit" value="Iniciar sesión">
        </form>
        <a class="formulario-login-registrarse" href="#">Registrarse</a>
    </main>
    <footer><?php include './frontend/includes-front/footer.php' ?></footer>
    <script src="./frontend/js/header-tienda.js"></script>
    <script src="./frontend/js/login-cliente.js"></script>
    <script src="./frontend/js/footer.js"></script>
</body>
</html>