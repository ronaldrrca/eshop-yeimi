<?php
session_start();
require_once '../../models/productos-modelo.php';
header('Content-Type: application/json');

$respuesta = [];

// Validemos que se cuente con los privilegios necesario con rol de admin o superadmin
if (isset($_SESSION['rol_usuario']) && $_SESSION['rol_usuario'] == 'superadmin' || $_SESSION['rol_usuario'] == 'admin') {
            
    // Validamos que se reciban datos por POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_producto = trim($_POST['id_producto']);
           
    } else {
        $respuesta = [
            "mensaje" => "No se recibieron datos.",
            "status" => "error"
        ];
        
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  
        exit();
    }

    // Validamos que se reciban todos los datos necesarios
    if (empty($id_producto)) {
        $respuesta = [
            "mensaje" => "No se recibió el ID del producto a eliminar.",
            "status" => "error"
        ];
            
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE); 
        exit();
    }

    $objProducto = new Productos();
    $consulta = $objProducto->revisarPosiblesVentas($id_producto);
    
    if ($consulta->num_rows > 0) {
        $respuesta = [
            "mensaje" => "Producto ya tiene ventas, no se puede eliminar.",
            "status" => "error"
        ];

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        exit;

    } else {
        $eliminar = $objProducto->eliminarProducto($id_producto);

        if ($eliminar) {
            $respuesta = [
                "mensaje" => "Producto eliminado con éxito.",
                "status" => "success"
            ];

        } else {
            $respuesta = [
                "mensaje" => "Error en la ejecución: " . $stmt->error,
                "status" => "error"
            ];
        }
        
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

} else {
    $respuesta = [
        "mensaje" => "No tiene suficientes privilegio.",
        "status" => "error"
    ];

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  
}


?>
