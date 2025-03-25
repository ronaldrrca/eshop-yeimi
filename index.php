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
    <main id="main_index">
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
            
        <section class="index-section index-section-blog">
            <h2>Blog</h2>
            <p>
                ✨ Bienvenida a nuestro Blog: Belleza que te Empodera ✨. Porque sabemos que la belleza es más que maquillaje, aquí encontrarás 
                los mejores consejos para realzar tu esencia y resaltar lo mejor de ti. Desde rutinas de skincare hasta tips de maquillaje 
                para cada ocasión, queremos acompañarte en tu camino hacia una piel radiante y un look impecable.
                Descubre tendencias, secretos de expertos y productos que transformarán tu rutina de belleza. ¡Porque cuidar de ti no es un lujo, es un acto de amor propio!
                ¿Lista para brillar? Explora nuestros artículos y encuentra la inspiración que necesitas. 
            </p>

            <h3>Consejo y tendencias</h3>
            <p>
                <img src="./assets/imgs-site/check-icono.svg" alt="icono de check"><strong>Skincare minimalista: Menos es más.</strong>
                El 2025 sigue apostando por una rutina de cuidado de la piel más simple y efectiva. En lugar de usar demasiados productos, opta por una rutina básica pero poderosa: <br>
                &nbsp;&nbsp;&nbsp;&nbsp;🔥 Un buen limpiador facial.<br>
                &nbsp;&nbsp;&nbsp;&nbsp;🔥 Hidratación profunda con ingredientes naturales.<br>
                &nbsp;&nbsp;&nbsp;&nbsp;🔥 Protector solar todos los días (¡sí, incluso en invierno!).<br>
            </p>
            
            <p>
                <img src="./assets/imgs-site/check-icono.svg" alt="icono de check"><strong>Maquillaje "Clean Girl Look": Belleza natural y fresca.</strong> Esta tendencia resalta la belleza natural con un maquillaje ligero y saludable. Logra el look con:<br>
                &nbsp;&nbsp;&nbsp;&nbsp;🔥 Base ligera o BB Cream para un acabado natural.<br>
                &nbsp;&nbsp;&nbsp;&nbsp;🔥 Rubor en crema para un efecto de piel saludable.<br>
                &nbsp;&nbsp;&nbsp;&nbsp;🔥 Labios con efecto "glossy" y cejas naturales y bien definidas.<br>
            </p>
            <br>
            <p>
                <img src="./assets/imgs-site/check-icono.svg" alt="icono de check"><strong>Labios efecto "Cherry Cola".</strong>
                Los labios en tonos marrón rojizo con un toque de gloss siguen dominando. Este estilo, inspirado en los años 90, le da un aire sofisticado y moderno a cualquier look.  
            </p>
            <br>
            <p>
                <img src="./assets/imgs-site/check-icono.svg" alt="icono de check"><strong>Piel Glow: Iluminación estratégica.</strong> El maquillaje efecto "dewy skin" sigue en tendencia. Para lograrlo:<br>
                &nbsp;&nbsp;&nbsp;&nbsp;🔥 Usa iluminadores líquidos o en crema en los puntos altos del rostro.<br>
                &nbsp;&nbsp;&nbsp;&nbsp;🔥 Prefiere bases hidratantes en lugar de las mate.<br>
                &nbsp;&nbsp;&nbsp;&nbsp;🔥 Aplica un poco de vaselina en los párpados para un brillo natural.<br>
            </p>
            <br>
            <p>
                <img src="./assets/imgs-site/check-icono.svg" alt="icono de check"><strong>Productos multifunción:</strong> Ahorra tiempo y espacio. Cada vez más mujeres buscan simplificar su rutina de belleza. Los productos "todo en uno" son perfectos para esto:<br>
                &nbsp;&nbsp;&nbsp;&nbsp;🔥 Rubores en crema que también sirven como labial.<br>
                &nbsp;&nbsp;&nbsp;&nbsp;🔥 Sombras de ojos en barra que se difuminan fácilmente.<br>
                &nbsp;&nbsp;&nbsp;&nbsp;🔥 Serums con color que hidratan y aportan cobertura ligera.<br>
            </p>
            <br>
            <p>
                <img src="./assets/imgs-site/check-icono.svg" alt="icono de check"><strong>Maquillaje sostenible y cruelty-free</strong> 🐰. Las consumidoras están cada vez más conscientes de lo que usan en su piel. Elige productos que sean:<br>
                &nbsp;&nbsp;&nbsp;&nbsp;🌱 Libres de parabenos y sulfatos.<br>
                &nbsp;&nbsp;&nbsp;&nbsp;🌱 No testados en animales.<br>
                &nbsp;&nbsp;&nbsp;&nbsp;🌱 Con ingredientes naturales y empaques reciclables.<br>
            </p>
            <br>
            <p>
                <img src="./assets/imgs-site/check-icono.svg" alt="icono de check"><strong>Peinados effortless:</strong> Belleza sin esfuerzo.<br>
                Las ondas suaves y el cabello con textura natural son el must del año. Para lograrlo:<br>
                &nbsp;&nbsp;&nbsp;&nbsp;🔥 Usa un texturizador en spray para un look despeinado chic.<br>
                &nbsp;&nbsp;&nbsp;&nbsp;🔥 Opta por accesorios minimalistas como pinzas y cintillos.<br>
                &nbsp;&nbsp;&nbsp;&nbsp;🔥 Prueba la tendencia "heatless curls" para ondas sin calor.<br>
            </p>


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