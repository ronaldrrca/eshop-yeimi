<?php
require_once './backend/models/productos-modelo.php';
$objProducto = new Productos();
$resultado_verProductosNuevos = $objProducto->verProductosNuevos();
?>