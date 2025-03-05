<?php
session_start();
require_once "../../models/clientes-modelo.php"; 
header('Content-Type: application/json');  

//Verificamos si el id recibido es el mismo de la sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $respuesta = [];
    $id = trim($_POST["id"]);
        
    if (isset($_SESSION['id_cliente']) && $_SESSION['id_cliente'] == $id) {
                                       
        // Validar que los campos no estén vací­os
        if (empty($id)) {
            $respuesta = [
                "mensaje" => "Hay campo(s) vacío(s) en el formulario.",
                "status" => "error"
            ];
                
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE); 
            exit();
        }
        
        
        $objetoClientes = new Clientes();
        $eliminar = $objetoClientes->eliminarDireccionCliente($id);                    
            
        // Eliminar el cliente en la base de datos
        if ($eliminar) {
            $respuesta = [
                 "mensaje" => "Dirección eliminada con éxito.",
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
