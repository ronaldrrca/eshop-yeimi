<?php
session_start();
require_once "../../models/carrito-modelo.php";
header('Content-Type: application/json');


// Verificar si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["mensaje" => "No se recibieron datos.", "status" => "error"], JSON_UNESCAPED_UNICODE);
    exit;
}

// Validar id_cliente
$id_cliente = filter_input(INPUT_POST, 'id_cliente', FILTER_VALIDATE_INT);

// Validar y filtrar arrays de productos y cantidades
$id_producto = filter_input(INPUT_POST, 'id_producto', FILTER_VALIDATE_INT);

// Verificar que no haya campos vacíos
if (empty($id_cliente) || empty($id_producto)) {
    echo json_encode(["mensaje" => "Hay campo(s) vacío(s) en el formulario.", "status" => "error"], JSON_UNESCAPED_UNICODE);
    exit;
}

// Verificar si hay una sesión iniciada
if (!isset($_SESSION['id_cliente'])) {
    echo json_encode(["mensaje" => "No hay sesión iniciada.", "status" => "error"], JSON_UNESCAPED_UNICODE);
    exit;
}

// Agregar productos al carrito
$objCarrito = new Carritos();
$eliminar = $objCarrito->eliminarDelCarrito($id_cliente, $id_producto);

if ($eliminar) {
    echo json_encode(["mensaje" => "Se eliminó el productos del carrito.", "status" => "success"], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(["mensaje" => "Ocurrió un error, no se generó el registro en la base de datos.", "status" => "error"], JSON_UNESCAPED_UNICODE);
}

?>
