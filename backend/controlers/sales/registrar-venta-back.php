<?php
session_start();
require_once '../../models/ventas-modelo.php';
header('Content-Type: application/json');

$respuesta = [];

// Validar permisos
if (!isset($_SESSION['rol_usuario']) || ($_SESSION['rol_usuario'] !== 'superadmin' && $_SESSION['rol_usuario'] !== 'admin')) {
    echo json_encode(["status" => "error", "mensaje" => "No tiene suficientes privilegios."]);
    exit();
}

// Validar método POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["status" => "error", "mensaje" => "No se recibieron datos."]);
    exit();
}

// Validar datos recibidos
$id_cliente = trim($_POST['id_cliente'] ?? '');
$medio_pago = trim($_POST['medio_pago'] ?? '');
$numero_referencia = trim($_POST['numero_referencia_pago'] ?? '');
$id_producto = $_POST['id_producto'] ?? [];
$cantidad = $_POST['cantidad'] ?? [];
$precio_venta = $_POST['precio'] ?? [];

if (empty($id_cliente) || empty($medio_pago) || empty($numero_referencia) || empty($id_producto) || empty($cantidad) || empty($precio_venta)) {
    echo json_encode(["status" => "error", "mensaje" => "Hay campo(s) vacío(s) en el formulario."]);
    exit();
}

// Instanciar la clase y registrar la venta
$venta = new Ventas();
$respuesta = $venta->registrarVenta($id_cliente, $medio_pago, $numero_referencia, $id_producto, $cantidad, $precio_venta);

// Devolver respuesta en formato JSON
echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
?>
