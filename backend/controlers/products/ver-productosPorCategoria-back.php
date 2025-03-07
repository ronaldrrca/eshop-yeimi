<?php
session_start();
require_once '../../models/productos-modelo.php';
header('Content-Type: application/json');

$respuesta = [];

// Verificar si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["mensaje" => "No se recibieron datos.", "status" => "error"], JSON_UNESCAPED_UNICODE);
    exit;
}

// Validar el nombre de la nueva categoría 
$categoria = ucwords(trim(filter_input(INPUT_POST, 'nombre_categoria', FILTER_SANITIZE_STRING)));

// Verificar si hay una sesión iniciada
if (!isset($_SESSION['rol_usuario'])) {
    echo json_encode(["mensaje" => "Usuario noo tiene permisos suficientes.", "status" => "error"], JSON_UNESCAPED_UNICODE);
    exit;
}

$objProductos = new Productos();
$resultado = $objProductos->verProductosPorCategoria($categoria);

if ($resultado) {
    $data = [];
    while ($fila = $resultado->fetch_assoc()) {
        $data[] = $fila;
    }

    $respuesta = [
        "mensaje" => "Proceso exitoso.",
        "status" => "succes",
        "data" => $data
    ];

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

} else {
    echo "No se recibieron datos.";
}


?>