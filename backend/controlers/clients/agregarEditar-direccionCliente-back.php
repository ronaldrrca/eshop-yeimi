<?php
session_start();
require_once "../../models/clientes-modelo.php"; 
header('Content-Type: application/json');  

//Verificamos si el id recibido es el mismo de la sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $respuesta = [];
    $id = trim($_POST["id"]);
        
    if (isset($_SESSION['id_cliente']) && $_SESSION['id_cliente'] == $id) {
        $departamento = trim($_POST['departamento']);
        $ciudad = trim($_POST['ciudad']);
        $barrio = trim($_POST['barrio']);
        $direccion_envio = trim($_POST['direccion_envio']);
                               
        // Validar que los campos no estén vací­os
        if (empty($id) || empty($departamento) || empty($ciudad) || empty($barrio) || empty($direccion_envio)) {
            $respuesta = [
                "mensaje" => "Hay campo(s) vacío(s) en el formulario.",
                "status" => "error"
            ];
                
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE); 
            exit();
        }
        
        
        $objetoClientes = new Clientes();
        $agregar = $objetoClientes->agregarEditarDireccionCliente($id, $departamento, $ciudad, $barrio, $direccion_envio);                    
            
        // Actualizar el cliente en la base de datos
        if ($agregar) {
            $respuesta = [
                 "mensaje" => "Dirección actualizada con éxito.",
                "status" => "success"
            ];
                        
        } else {
                $respuesta = [
                    "mensaje" => "Se produjo un error.",
                    "status" => "error"
                ];
            }

            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE); 
                    
    } else {
            $respuesta = [
            "mensaje" => "No existe un asesión iniciada, o el id enviado no corresponde al id de la sesión.",
            "status" => "error"
            ];

            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
    
} else {
    echo 'No se recibieron datos';
}
?>
