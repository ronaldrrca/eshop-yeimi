<?php
session_start();
require_once '../../models/productos-modelo.php';
header('Content-Type: application/json');

// Verificar si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["mensaje" => "No se recibieron datos.", "status" => "error"], JSON_UNESCAPED_UNICODE);
    exit;
}

$id = filter_input(INPUT_POST, 'id_producto', FILTER_VALIDATE_INT);

if (empty($id)) {
    echo json_encode(["mensaje" => "Hay campo(s) vacío(s) en el formulario.", "status" => "error"], JSON_UNESCAPED_UNICODE);
    exit;
}

// Verificar si hay una sesión iniciada
if (!isset($_SESSION['rol_usuario'])) {
    echo json_encode(["mensaje" => "Usuario noo tiene permisos suficientes.", "status" => "error"], JSON_UNESCAPED_UNICODE);
    exit;
}

$objProducto = new Productos();
$consulta = $objProducto->gestionarFavoritoDelAdmin($id);
    
if ($consulta) {
    echo "Proceso exitoso.";
        
} else {
        echo "Error en la ejecución: " . $stmt->error;  
    }
        
   
 



?>
