<?php
include './backend/controlers/products/ver-productos-SinAutenticacion_back.php';

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
    <link rel="stylesheet" href="frontend/css/estilos-productos.css">
    <link rel="stylesheet" href="frontend/css/estilos-footer.css">
</head>
<body>
    <header><?php include_once './frontend/includes-front/header-tienda.php' ?></header>
    <main>
        <h2>NUESTROS PRODUCTOS</h2>
        <?php
            foreach ($productosPorCategoria as $categoria => $productos) { ?>
                <h3><?= $categoria ?></h3>
                <div class="productos_categorias">
                    <?php foreach ($productos as $producto) { ?>
                    <div class="card" data-id="<?= $producto['id_producto'] ?>">
                        <a href="#" class="card_link_producto">
                            <div class="card_contenedor_imagen"><img class="imagen_card" src="<?= $producto['src_producto'] ?>" alt="<?= $producto['altImg_producto'] ?>"></div>
                            <div class="card_contenedor_info">
                                <h3><?= $producto['nombre_producto'] ?></h3>
                                <span class="card_marca"><?= $producto['marca_producto'] ?></span>
                                <div class="card_precio">
                                    <?php if ($producto['oferta_producto']) { ?>
                                    <div class="card_precioOferta">
                                        <span class="card_precioOferta_precio" style="<?php echo $producto['oferta_producto'] ? 'text-decoration: line-through;' : 'margin-bottom: 1.9rem'; ?>" class="card_precioFull_precioInicial"><?= "$ " . number_format($producto['precio_producto'], 0, ",", "."); ?> </span>
                                        <span class="card_precioOferta_descuento" class="porcentaje_oferta_producto">-<?=  $producto['porcentaje_oferta_producto'] . "%" ?></span>
                                    </div>
                                    <?php } ?>
                                    <span class="card_precioFinal"><?= "$ " . number_format($producto['precio_producto'] - ($producto['precio_producto'] * $producto['porcentaje_oferta_producto'] / 100), 0, ",", ".") ?></span>
                                </div>
                                
                            </div>
                            
                            <?php if ($producto['oferta_producto']) { ?>
                                <span class="etiqueta_oferta">Oferta</span>
                            <?php }  ?>
                        </a>
                        <div class="card_extras">
                                <button id="<?= $producto['id_producto'] ?>" class="card_button">Agregar al carrito</button>
                                <p class="mensajeCarrito"></p>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            <?php } ?>
              
    </main>
    <footer><?php include './frontend/includes-front/footer.php' ?></footer>
    <script src="./frontend/js/header-tienda.js"></script>
    <!-- <script src="./frontend/js/index.js"></script> -->
    <script src="./frontend/js/cards.js"></script>
    <script src="./frontend/js/footer.js"></script>
</body>
</html>