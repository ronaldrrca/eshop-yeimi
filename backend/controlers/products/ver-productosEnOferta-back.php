<?php
require_once './backend/models/productos-modelo.php';
$objProducto = new Productos();
$resultado_verProductosEnOferta = $objProducto->verProductosEnOferta();
?>