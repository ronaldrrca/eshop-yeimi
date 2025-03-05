<?php
session_start();
require_once '../../models/clientes-modelo.php';
header("Content-Type: application/json");

// Determinar el ID del cliente
$id = (isset($_POST['id']) ? trim($_POST['id']) : "");

//Verificamos si el id recibido es el mismo de la sesión
if (isset($_SESSION['id_cliente']) && $_SESSION['id_cliente'] == $id) {
    $respuesta = [];
    
    $objetoClientes = new Clientes();
    $ver =$objetoClientes->verCarrito($id);

    // Inicializar array del data
    $data = [];
    while ($fila = $ver->fetch_assoc()) {
        $data[] = $fila;
    }

    // Verificar si el data está vacío
    if (empty($data)) {
        $respuesta = [
            "mensaje" => "No hay productos en el carrito.",
            "status" => "error"
        ];

    } else {
        $respuesta = [
            "mensaje" => "Productos del carritos obtenidos correctamente.",
            "status" => "success",
            "data" => $data
        ];
    }

    // Enviar respuesta en JSON
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    
} else {
    $respuesta = [
        "mensaje" => "No existe una sesión iniciada, o el id enviado no corresponde al id de la sesión.",
        "status" => "error",
    ];

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}

?>


