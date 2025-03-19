<?php
session_start();
// $_SESSION['id_cliente'] = 5;
require_once "../../models/carrito.php";
require_once "../../models/productos-modelo.php";
header('Content-Type: application/json');

// Verificar si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["mensaje" => "No se recibieron datos.", "status" => "error"], JSON_UNESCAPED_UNICODE);
    exit;
}

// Verificar si hay una sesión iniciada
if (!isset($_SESSION['id_cliente'])) {
    echo json_encode(["mensaje" => "No hay sesión iniciada.", "status" => "error"], JSON_UNESCAPED_UNICODE);
    exit;
}

// Validar id_cliente y obtener datos del JSON
$id_cliente = intval($_SESSION['id_cliente']);
// $id_producto = intval( $_POST['id_producto']);
$data = json_decode(file_get_contents("php://input"), true);
$id_producto = $data["id_producto"] ?? null;
$cantidad = $data["cantidad"] ?? 1;

// Verificar que los datos no sean nulos o vacíos
if (!$id_cliente || !$id_producto) {
    echo json_encode(["mensaje" => "Hay campo(s) vacío(s) en el formulario.", "status" => "error"], JSON_UNESCAPED_UNICODE);
    exit;
}

// Consultar el stock del producto 
$objProductos = new Productos();
$resultado = $objProductos->consultarDisponibilidad($id_cliente, $id_producto);

if ($resultado) {
    $fila = $resultado->fetch_assoc();
    
    if ($fila) {
        
        if ($fila['stock_disponible'] >= ($fila['cantidad_en_carrito'] + $cantidad)){ // Verificar si hay suficiente stock
            // Agregar productos al carrito
            $objCarrito = new Carritos();
            $agregar = $objCarrito->agregarItem($id_cliente, $id_producto, $cantidad);

            if ($agregar) {
                echo json_encode(["mensaje" => "Se agregaron productos al carrito.", "status" => "success"], JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode(["mensaje" => "Ocurrió un error, no se generó el registro en la base de datos.", "status" => "error"], JSON_UNESCAPED_UNICODE);
            }
        } else {
            echo json_encode(["mensaje" => "Producto sin existencias suficientes.", "status" => "error"], JSON_UNESCAPED_UNICODE);
        }
    } else {
        echo json_encode(["mensaje" => "No se encontró el producto.", "status" => "error"], JSON_UNESCAPED_UNICODE);
    }
} else {
    echo json_encode(["mensaje" => "Error en la consulta a la base de datos.", "status" => "error"], JSON_UNESCAPED_UNICODE);
}
?>
