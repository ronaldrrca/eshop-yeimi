<?php
session_start();
require_once '../../models/productos-modelo.php';
header('Content-Type: application/json');

$respuesta = [];
$id_producto = 0;

// Validemos que se cuente con los privilegios necesario con rol de admin o superadmin
if (isset($_SESSION['rol_usuario']) && $_SESSION['rol_usuario'] == 'superadmin' || $_SESSION['rol_usuario'] == ' admin') {

    // Verificando si se recibieron los datos 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_producto = trim($_POST['id_producto']);
        
    } else {
        $respuesta = [
            "mensaje" => "No se recibieron datos.",
            "status" => "error"
        ];
        
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  // Convertir array PHP a JSON
        // header("Location: formulario-registro-cliente.php");
        exit();
    }
    

    $objProducto = new Productos();
    $resultado = $objProducto->verProducto($id_producto);

    // Inicializar array del data
    $data = [];
    while ($fila = $resultado->fetch_assoc()) {
        $data[] = $fila;
    }

    // Verificar si el data está vacío
    if (empty($data)) {
        $respuesta = [
            "mensaje" => "ID no existe en la base de datos.",
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
        "mensaje" => "No tiene suficientes privilegio.",
        "status" => "error"
    ];

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  // Convertir array PHP a JSON
}


?>