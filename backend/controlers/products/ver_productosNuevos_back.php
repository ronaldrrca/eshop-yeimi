<?php
session_start();
require_once '../../models/productos-modelo.php';
header('Content-Type: application/json');

$objProductos = new Productos();
$resultado = $objProductos->verProductosNuevos();

if ($resultado) {
    $data = [];
    while ($fila = $resultado->fetch_assoc()) {
        $data[] = $fila;
    }

    echo json_encode(["mensaje" => "Consulta exitosa.", "status" => "succes", "data" => $data], JSON_UNESCAPED_UNICODE);

} else {
    echo json_encode(["mensaje" => "No se recibieron datos.", "status" => "error"], JSON_UNESCAPED_UNICODE);
}
?>