<?php
session_start();
require_once '../../models/categoria.php';
header('Content-Type: application/json');

// Verificar si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["mensaje" => "No se recibieron datos.", "status" => "error"], JSON_UNESCAPED_UNICODE);
    exit;
}

// Validar el nombre de la nueva categoría 
$nombre = filter_input(INPUT_POST, 'nombre_categoria', FILTER_SANITIZE_STRING);

// Validar que no llegue campo vacío
if (empty($nombre)) {
    echo json_encode(["mensaje" => "Hay campo(s) vacío(s) en el formulario.", "status" => "error"], JSON_UNESCAPED_UNICODE);
    exit;
}

// Verificar si hay una sesión iniciada
if (!isset($_SESSION['rol_usuario'])) {
    echo json_encode(["mensaje" => "Usuario noo tiene permisos suficientes.", "status" => "error"], JSON_UNESCAPED_UNICODE);
    exit;
}

$objCategoria = new Categorias();
$crear = $objCategoria->crearCategoria($nombre);

if ($crear) {
    echo json_encode(["mensaje" => "Se creó una nueva categoría.", "status" => "success"], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(["mensaje" => "Ocurrió un error, no se generó el registro en la base de datos.", "status" => "error"], JSON_UNESCAPED_UNICODE);
}


?>