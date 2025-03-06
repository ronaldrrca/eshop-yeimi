<?php
session_start();
require_once '../../models/productos-modelo.php';
header('Content-Type: application/json');

$respuesta = [];

// Validemos que se cuente con los privilegios necesario con rol de admin o superadmin
if (isset($_SESSION['rol_usuario']) && $_SESSION['rol_usuario'] == 'superadmin' || $_SESSION['rol_usuario'] == 'admin') {
    // Se inicializan las variables para que estén disponibles
    $id_producto = 0;
    $nombre_producto = "";
    $descripcion_producto = "";
    $categoria_producto = "";
    $marca_producto = "";
    $precio_producto = 0;
    $stock_producto = 0; 

    // Validamos que se reciban datos por POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_producto = trim($_POST['id_producto']);
        $nombre_producto = trim($_POST['nombre_producto']);
        $descripcion_producto = trim($_POST['descripcion_producto']);
        $categoria_producto = trim($_POST['categoria_producto']);
        $marca_producto = trim($_POST['marca_producto']);
        $precio_producto = trim($_POST['precio_producto']);
        $stock_producto = trim($_POST['stock_producto']);
    
    } else {
        $respuesta = [
            "mensaje" => "No se recibieron datos.",
            "status" => "error"
        ];
        
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  // Convertir array PHP a JSON
        // header("Location: formulario-registro-cliente.php");
        exit();
    }

    // Validamos que se reciban todos los datos necesarios
    if (empty($id_producto) || empty($nombre_producto) || empty($descripcion_producto) || empty($categoria_producto) || empty($marca_producto) || empty($precio_producto) || empty($stock_producto)) {
        $respuesta = [
            "mensaje" => "Hay campo(s) vacío(s) en el formulario.",
            "status" => "error"
        ];
            
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  // Convertir array PHP a JSON
        // header("Location: formulario-registro-cliente.php");
        exit();
    }

    $objProducto = new Productos();
    $edicion = $objProducto->editarProducto($id_producto, $nombre_producto, $descripcion_producto, $categoria_producto, $marca_producto, $precio_producto, $stock_producto);

    if ($edicion) {
        $respuesta = [
            "mensaje" => "Producto editado con éxito.",
            "status" => "success"
        ];
    } else {
        $respuesta = [
            "mensaje" => "Error en la ejecución: " . $stmt->error,
            "status" => "error"
        ];
    }
        
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

} else {
    $respuesta = [
        "mensaje" => "No tiene suficientes privilegio.",
        "status" => "error"
    ];

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  // Convertir array PHP a JSON
        // header("Location: formulario-registro-cliente.php");
        exit();
}


?>
