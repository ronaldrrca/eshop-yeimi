<?php
session_start();
require_once '../../models/categoria.php';
header('Content-Type: application/json');

// Verificar si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["mensaje" => "No se recibieron datos.", "status" => "error"], JSON_UNESCAPED_UNICODE);
    exit;
}

// Validar datos 
$id = filter_input(INPUT_POST, 'id_categoria', FILTER_VALIDATE_INT);
$nombre = ucwords(trim(filter_input(INPUT_POST, 'nombre_categoria', FILTER_SANITIZE_STRING)));

// Validar que no llegue campo vacío
if (empty($id) || empty($nombre)) {
    echo json_encode(["mensaje" => "Hay campo(s) vacío(s) en el formulario.", "status" => "error"], JSON_UNESCAPED_UNICODE);
    exit;
}

// Verificar si hay una sesión iniciada
if (!isset($_SESSION['rol_usuario'])) {
    echo json_encode(["mensaje" => "Usuario noo tiene permisos suficientes.", "status" => "error"], JSON_UNESCAPED_UNICODE);
    exit;
}

$objCategoria = new Categorias();
$editar = $objCategoria->editarCategoria($id, $nombre);

if ($editar) {
    echo json_encode(["mensaje" => "Se editó correctamente la categoría.", "status" => "success"], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(["mensaje" => "Ocurrió un error, no se generó el registro en la base de datos.", "status" => "error"], JSON_UNESCAPED_UNICODE);
}


?>