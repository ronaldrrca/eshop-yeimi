<?php
session_start();
require_once '../../models/categoria.php';
header('Content-Type: application/json');

//-----------------------------------------------
$_SESSION['rol_admin'] = "superadmin";//solo para pruebas, eliminar al final
//-----------------------------------------------

$respuesta = [];

// Verificar si hay una sesión iniciada
if (!isset($_SESSION['rol_usuario'])) {
    echo json_encode(["mensaje" => "Usuario noo tiene permisos suficientes.", "status" => "error"], JSON_UNESCAPED_UNICODE);
    exit;
}

$objCategoria = new Categorias();
$resultado = $objCategoria->verCategorias();

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