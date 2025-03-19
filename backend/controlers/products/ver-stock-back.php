<?php
session_start();
require_once '../../models/productos-modelo.php';
header('Content-Type: application/json');

// Verificar si la solicitud es GET
if ($_SERVER["REQUEST_METHOD"] !== "GET") {
    echo json_encode(["mensaje" => "Método no permitido.", "status" => "error"], JSON_UNESCAPED_UNICODE);
    exit;
}

// Validar si se recibió el ID
if (!isset($_GET["id_producto"]) || !is_numeric($_GET["id_producto"])) {
    echo json_encode(["mensaje" => "ID de producto inválido.", "status" => "error"], JSON_UNESCAPED_UNICODE);
    exit;
}

$id_producto = intval($_GET["id_producto"]);
$objProductos = new Productos();
$resultado = $objProductos->verStock($id_producto);

if ($fila = $resultado->fetch_assoc()) {
    echo json_encode(["stock" => intval($fila["stock_producto"])]);
   
} else {
    echo json_encode(["error" => "Profucto no encontrado"]);
}
?>
