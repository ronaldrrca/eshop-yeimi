<?php
require_once './backend/models/productos-modelo.php';
$objProducto = new Productos();
$resultado = $objProducto->verProductosSinAutenticacion();

$productosPorCategoria = [];

while ($fila = $resultado->fetch_assoc()) {
    $categoria = $fila['nombre_categoria'];
    $productosPorCategoria[$categoria][] = $fila; // Agrupamos por categoría
}


?>