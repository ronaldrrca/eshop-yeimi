<?php
session_start();
require_once '../../models/productos-modelo.php';
header('Content-Type: application/json');

$respuesta = [];

// Verificar si hay una sesión iniciada
if (!isset($_SESSION['rol_usuario'])) {
    echo json_encode(["mensaje" => "Usuario no tiene permisos suficientes.", "status" => "error"], JSON_UNESCAPED_UNICODE);
    exit;
}

$objProducto = new Productos();
$resultado = $objProducto->verProductosFavoritosDelAdmin();

if ($resultado) {
    $data = [];

    while ($producto = $resultado->fetch_assoc()) {
        $data[] = $producto;
    }

    // Verificar si el data está vacío
    if (empty($data)) {
        $respuesta = [
            "mensaje" => "No se recibieron los productos favoritos.",
            "status" => "error"
        ];

    } else {
        $respuesta = [
            "mensaje" => "Productos obtenidos correctamente.",
            "status" => "success",
            "data" => $data
        ];
    }

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  // Convertir array PHP a JSON

} else {
    $respuesta = [
        "mensaje" => "Error en la ejecución: " . $stmt->error,
        "status" => "error"
    ];
}

?>