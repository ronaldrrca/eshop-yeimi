<?php 
session_start();
if (!isset($_SESSION['id_cliente'])) {
    $_SESSION['redirect_to'] = basename($_SERVER['PHP_SELF']);
} 
?>

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
    <link rel="stylesheet" href="frontend/css/estilos-index.css">
    <link rel="stylesheet" href="frontend/css/estilos-footer.css">
</head>
<body>
    <header><?php include_once './frontend/includes-front/header-tienda.php' ?></header>
    <main>
        <section class="hero">
            <div class="hero_frase">
                <span>Colores, texturas y magia para tu piel.</span>
                <span>Transforma tu rutina, descubre tu mejor versión.</span>
            </div>
            <img src="./assets/imgs-site/hero.webp" alt="modelo maqillada rodeada de flores, con elementos y utencilios de maquillaje">
        </section>

        <section class="index-section">
            <h2>Destacados</h2>
            <div id="productos_destacados_contenido"></div>
        </section>

        <section class="index-section">
            <h2>Lo nuevo</h2>
            <div id="productos_nuevos_contenido"></div>
        </section>

        <section class="index-section">
            <h2>Propuesta de valor</h2>
                <div class="index-beneficios-contenedor">
                    <div class="index-contenedor-beneficio">
                        <div class="index-beneficios-beneficio z a b">
                            <img src="./assets/imgs-site/beneficios-comprasOnline.png" alt="">
                        </div>
                        <span>Compra en línea</span>
                    </div>
                    <div class="index-contenedor-beneficio">
                        <div class="index-beneficios-beneficio z a b">
                            <img src="./assets/imgs-site/beneficio-pago.png" alt="">
                        </div>
                        <span>Pago seguro</span>
                    </div>
                    <div class="index-contenedor-beneficio">
                        <div class="index-beneficios-beneficio z a b">
                            <img src="./assets/imgs-site/beneficios-envio.png" alt="">
                        </div>
                        <span>Envíos nacionales</span>
                    </div>
                    <div class="index-contenedor-beneficio">
                        <div class="index-beneficios-beneficio z a b">
                        <img src="./assets/imgs-site/beneficios-oferta.png" alt="">
                    </div>
                    <span>Las mejores ofertas</span>
                    </div>
                    <div class="index-contenedor-beneficio">
                        <div class="index-beneficios-beneficio z a b">
                        <img src="./assets/imgs-site/beneficios-calidad.png" alt="">
                    </div>
                    <span>Productos de calidad</span>
                    </div>
                </div>
        </section>
           
        <section>   
            <h2>Ofertas</h2>
        </section>
            
        <section>
            <h2>Blog o contenido útil (opcional)</h2>
        </section>

        <section>
            <h2>Consejos, tendencias o cómo usar los productos</h2>
        </section>
            
        <section>
            <h2>Suscripciones a Newsletter (formulario)</h2>
        </section>

        <section>
            <h2>Tienda física y envíos nacinales</h2>
        </section>
            
            
        <div class="cta-container"><a href="#productos" class="cta">Explora nuestros productos</a></div>
        <div id="sesion" data-id="<?=  $_SESSION['redirect_to'] ?? ''; ?>"></div>

        
    </main>
    <footer><?php include './frontend/includes-front/footer.php' ?></footer>
    <script src="./frontend/js/header-tienda.js"></script>
    <script src="./frontend/js/index.js"></script>
    <script src="./frontend/js/footer.js"></script>
</body>
</html>