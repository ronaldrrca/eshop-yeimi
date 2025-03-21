<?php
session_start();
require_once '../../models/productos-modelo.php';
header('Content-Type: application/json');

$objProducto = new Productos();
$resultado = $objProducto->verProductosFavoritosDelAdmin();

if ($resultado) {
    $data = [];

    while ($producto = $resultado->fetch_assoc()) {
        $data[] = $producto;
    }

    // Verificar si el data está vacío
    if (empty($data)) {
        echo json_encode(["mensaje" => "No se recibieron datos.", "status" => "error"], JSON_UNESCAPED_UNICODE);
        
    } else {
        echo json_encode(["mensaje" => "Productos obtenidos correctamente.", "status" => "success", "productos" => $data], JSON_UNESCAPED_UNICODE);  // Convertir array PHP a JSON
        
    }

} else {
    echo json_encode(["mensaje" => "No se recibieron datos.", "status" => "error"], JSON_UNESCAPED_UNICODE);
}

?>