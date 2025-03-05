<?php
session_start();
require_once '../../models/clientes-modelo.php';
header("Content-Type: application/json");

// Determinar el ID del cliente
$id = (isset($_POST['id']) ? trim($_POST['id']) : "");

//Verificamos si el id recibido es el mismo de la sesión
if (isset($_SESSION['id_cliente']) && $_SESSION['id_cliente'] == $id ) {
    $respuesta = [];
    
    // Volvemos a verificar, si hay un resultado, que el id recibido es el mismo de la sesión
    if (isset($_SESSION['id_cliente']) && $_SESSION['id_cliente'] == $id) {

        $objetoClientes = new Clientes();
        $ver =$objetoClientes->verInfoCliente($id);
        
        // Inicializar array del data
        $data = [];
        while ($fila = $ver->fetch_assoc()) {
            $data[] = $fila;
        }

        $respuesta = [
            "mensaje" => "Cliente encontrado.",
            "status" => "success",
            "data" => $data
        ];
        
    } else {// Redundancia de seguridas, suponiendo que en el condicional padre no debió pasar la condición para llegar hasta acá.
        $respuesta = [
            "mensaje" => "No existe un asesión iniciada, o el id enviado no corresponde al id de la sesión..",
            "status" => "error",
        ];
    }

} else {
    $respuesta = [
        "mensaje" => "No existe un asesión iniciada, o el id enviado no corresponde al id de la sesión.",
        "status" => "error",
    ];

    exit();
}

echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);


?>


