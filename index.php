<?php
include_once './backend/controlers/products/ver-productosDestacados-back.php';
include_once './backend/controlers/products/ver-productosNuevos-back.php';
include_once './backend/controlers/products/ver-productosEnOferta-back.php';
 
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
            <div id="productos_destacados_contenido">
                <?php while ($fila = $resultado_verProductosDestacados->fetch_assoc()) { ?>
                    <div class="card" data-id="<?= $fila['id_producto'] ?>">
                        <a href="#" class="card_link_producto">
                            <div class="card_contenedor_imagen"><img class="imagen_card" src="<?= $fila['src_producto'] ?>" alt="<?= $fila['altImg_producto'] ?>"></div>
                            <div class="card_contenedor_info">
                                <h3><?= $fila['nombre_producto'] ?></h3>
                                <span class="card_marca"><?= $fila['marca_producto'] ?></span>
                                <span class="card_precioFinal"><?= "$ " . number_format($fila['precio_producto'] - ($fila['precio_producto'] * $fila['porcentaje_oferta_producto'] / 100), 0, ",", ".") ?></span>
                            </div>
                            <div class="card_extras">
                                <button id="<?= $fila['id_producto'] ?>" class="card_button">Agregar al carrito</button>
                                <p class="mensajeCarrito"></p>
                        </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </section>

        <section class="index-section">
            <h2>Ofertas</h2>
            <div id="productos_oferta_contenido">
            <?php while ($fila = $resultado_verProductosEnOferta->fetch_assoc()) { ?>
                    <div class="card" data-id="<?= $fila['id_producto'] ?>">
                        <a href="#" class="card_link_producto">
                            <div class="card_contenedor_imagen"><img class="imagen_card" src="<?= $fila['src_producto'] ?>" alt="<?= $fila['altImg_producto'] ?>"></div>
                            <div class="card_contenedor_info">
                                <h3><?= $fila['nombre_producto'] ?></h3>
                                <span class="card_marca"><?= $fila['marca_producto'] ?></span>
                                <div class="card_precio">
                                    <?php if ($fila['oferta_producto']) { ?>
                                    <div class="card_precioOferta">
                                        <span class="card_precioOferta_precio" style="<?php echo $fila['oferta_producto'] ? 'text-decoration: line-through;' : 'margin-bottom: 1.9rem'; ?>" class="card_precioFull_precioInicial"><?= "$ " . number_format($fila['precio_producto'], 0, ",", "."); ?> </span>
                                        <span class="card_precioOferta_descuento" class="porcentaje_oferta_producto">-<?=  $fila['porcentaje_oferta_producto'] . "%" ?></span>
                                    </div>
                                    <?php } ?>
                                    <span class="card_precioFinal"><?= "$ " . number_format($fila['precio_producto'] - ($fila['precio_producto'] * $fila['porcentaje_oferta_producto'] / 100), 0, ",", ".") ?></span>
                                </div>
                                
                            </div>
                            
                            <?php if ($fila['oferta_producto']) { ?>
                                <span class="etiqueta_oferta">Oferta</span>
                            <?php }  ?>
                        </a>
                        <div class="card_extras">
                                <button id="<?= $fila['id_producto'] ?>" class="card_button">Agregar al carrito</button>
                                <p class="mensajeCarrito"></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>

        <section class="index-section">
            <h2>Lo que ofrecemos</h2>
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
           
        <section class="index-section">   
            <h2>Lo nuevo</h2>
            <div id="productos_nuevos_contenido">
                <?php while ($fila = $resultado_verProductosNuevos->fetch_assoc()) { ?>
                    <div class="card" data-id="<?= $fila['id_producto'] ?>">
                        <a href="#" class="card_link_producto">
                            <div class="card_contenedor_imagen"><img class="imagen_card" src="<?= $fila['src_producto'] ?>" alt="<?= $fila['altImg_producto'] ?>"></div>
                            <div class="card_contenedor_info">
                                <h3><?= $fila['nombre_producto'] ?></h3>
                                <span class="card_marca"><?= $fila['marca_producto'] ?></span>
                                <span class="card_precioFinal"><?= "$ " . number_format($fila['precio_producto'] - ($fila['precio_producto'] * $fila['porcentaje_oferta_producto'] / 100), 0, ",", ".") ?></span>
                            </div>
                            <div class="card_extras">
                                <button id="<?= $fila['id_producto'] ?>" class="card_button">Agregar al carrito</button>
                                <p class="mensajeCarrito"></p>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </section>
            
        <section class="index-section index-section-blog">
            <div class="index-section-blog_seccion">
                <h2>Blog</h2>
                <p>
                    Bienvenida a nuestro Blog: Belleza que te Empodera. Porque sabemos que la belleza es más que maquillaje, aquí encontrarás 
                    los mejores consejos para realzar tu esencia y resaltar lo mejor de ti. Desde rutinas de skincare hasta tips de maquillaje 
                    para cada ocasión, queremos acompañarte en tu camino hacia una piel radiante y un look impecable.
                    Descubre tendencias, secretos de expertos y productos que transformarán tu rutina de belleza. ¡Porque cuidar de ti no es un lujo, es un acto de amor propio!
                    ¿Lista para brillar? Explora nuestros artículos y encuentra la inspiración que necesitas. 
                </p>
            </div>

            <div class="index-section-blog_seccion">
                <h3>Consejos y tendencias</h3>
                <div class="index-section-blog_consejo">
                    <p><strong>Skincare minimalista: Menos es más.</strong></p>
                    <p class="index-section-blog_consejo_texto">El 2025 sigue apostando por una rutina de cuidado de la piel más simple y efectiva. En lugar de usar demasiados productos, opta por una rutina básica pero poderosa: 
                    Un buen limpiador facial.</p>
                    <div class=""><span class="index-section-blog_vineta"></span> <p>Hidratación profunda con ingredientes naturales.</p></div>
                    <div class=""><span class="index-section-blog_vineta"></span> <p>Protector solar todos los días (¡sí, incluso en invierno!).</p></div>
                </div>
                
                <div class="index-section-blog_consejo">
                    <p><strong>Maquillaje "Clean Girl Look": Belleza natural y fresca.</strong></p>
                    <p class="index-section-blog_consejo_texto">Esta tendencia resalta la belleza natural con un maquillaje ligero y saludable. Logra el look con:</p>
                    <div class=""><span class="index-section-blog_vineta"></span><p>Base ligera o BB Cream para un acabado natural.</p></div>
                    <div class=""><span class="index-section-blog_vineta"></span><p>Rubor en crema para un efecto de piel saludable.</p></div>
                    <div class=""><span class="index-section-blog_vineta"></span><p>Labios con efecto "glossy" y cejas naturales y bien definidas.</p></div>
                </div>

                <div class="index-section-blog_consejo">
                    <p><strong>Labios efecto "Cherry Cola".</strong></p>
                    <p class="index-section-blog_consejo_texto">Los labios en tonos marrón rojizo con un toque de gloss siguen dominando. Este estilo, inspirado en los años 90, le da un aire sofisticado y moderno a cualquier look.  </p>
                </div>
                <div class="index-section-blog_consejo">
                    <p><strong>Piel Glow: Iluminación estratégica.</strong></p>
                    <p class="index-section-blog_consejo_texto">El maquillaje efecto "dewy skin" sigue en tendencia. Para lograrlo:</p>
                    <div class=""><span class="index-section-blog_vineta"></span><p>Usa iluminadores líquidos o en crema en los puntos altos del rostro.</p></div>
                    <div class=""><span class="index-section-blog_vineta"></span><p>Prefiere bases hidratantes en lugar de las mate.</p></div>
                    <div class=""><span class="index-section-blog_vineta"></span><p>Aplica un poco de vaselina en los párpados para un brillo natural.</p></div>
                </div>
                <div class="index-section-blog_consejo">
                    <p><strong>Productos multifunción:</strong></p>
                    <p class="index-section-blog_consejo_texto">Ahorra tiempo y espacio. Cada vez más mujeres buscan simplificar su rutina de belleza. Los productos "todo en uno" son perfectos para esto:</p>
                    <div class=""><span class="index-section-blog_vineta"></span><p>Rubores en crema que también sirven como labial.</p></div>
                    <div class=""><span class="index-section-blog_vineta"></span><p>Sombras de ojos en barra que se difuminan fácilmente.</p></div>
                    <div class=""><span class="index-section-blog_vineta"></span><p>Serums con color que hidratan y aportan cobertura ligera.</p></div>
                </div>
                <div class="index-section-blog_consejo">
                    <p><strong>Maquillaje sostenible y cruelty-free.</strong></p>
                    <p class="index-section-blog_consejo_texto">Las consumidoras están cada vez más conscientes de lo que usan en su piel. Elige productos que sean:</p>
                    <div class=""><span class="index-section-blog_vineta"></span><p>Libres de parabenos y sulfatos.</p></div>
                    <div class=""><span class="index-section-blog_vineta"></span><p>No testados en animales.</p></div>
                    <div class=""><span class="index-section-blog_vineta"></span><p>Con ingredientes naturales y empaques reciclables.</p></div>
                </div>
                <div class="index-section-blog_consejo">
                    <p><strong>Peinados effortless:</strong>Belleza sin esfuerzo.</p>
                    <p class="index-section-blog_consejo_texto">Las ondas suaves y el cabello con textura natural son el must del año. Para lograrlo:</p>
                    <div class=""><span class="index-section-blog_vineta"></span><p>Usa un texturizador en spray para un look despeinado chic.</p></div>
                    <div class=""><span class="index-section-blog_vineta"></span><p>Opta por accesorios minimalistas como pinzas y cintillos.</p></div>
                    <div class=""><span class="index-section-blog_vineta"></span><p>Prueba la tendencia "heatless curls" para ondas sin calor.</p></div>
                </div>
            </div>
        <section>
            
        <div class="index-section_otros">
            <section class="index-section">
                <h2>Suscripciones a Newsletter</h2>
                <p>Suscríbete a nuestra comunidad, tu rutina de belleza empieza aquí. Recibe las últimas tendencias en belleza, ofertas exclusivas y tips para resaltar tu belleza natural.</p>
                <form id="formulario_newsletter" action="./backend/controlers/clients/registrar-enNewsLetter-back.php" method="post">
                    <input type="text" name="nombre" id="nombre_newsLetter" placeholder="Nombre">
                    <input type="email" name="email" id="email_newsLetter" placeholder="Correo electrónico">
                    <input type="submit" value="Suscribirse">
                </form>
            </section>
            
            <section class="index-section">
                <h2>Tienda física y envíos nacionales</h2>
                <p>Visítanos en nuestra tienda física. Descubre los mejores productos de belleza en persona, o compra en línea y recibe tus productos favoritos en tu hogar.</p>
                <picture class="index-section_imagenTienda"><img src="./assets/imgs-site/imagen-tienda.webp" alt="tienda de cosméticos"></picture>
            </section>  
        </div>  
                           
        <div class="cta-container"><a href="#productos" class="cta">Explora nuestros productos</a></div>
        <div id="sesion" data-id="<?=  $_SESSION['redirect_to'] ?? ''; ?>"></div>
        
    </main>
    <footer><?php include './frontend/includes-front/footer.php' ?></footer>
    <script src="./frontend/js/header-tienda.js"></script>
    <script src="./frontend/js/index.js"></script>
    <script src="./frontend/js/footer.js"></script>
</body>
</html>