<?php
session_start();
require_once "../../models/clientes-modelo.php"; 
header('Content-Type: application/json');  

//Verificamos si el id recibido es el mismo de la sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $respuesta = [];
    $id = trim($_POST["id"]);
        
    if (isset($_SESSION['id_cliente']) && $_SESSION['id_cliente'] == $id) {
        $id = trim($_POST["id"]);
        $email = trim($_POST['email']);
        $password_actual = trim($_POST['password_actual']);
        $password_nuevo = trim($_POST['password_nuevo']);
        $password_confirmacion = trim($_POST['password_confirmacion']);
        $passwordHasheada = password_hash($password_nuevo, PASSWORD_DEFAULT);

                        
            // Validar que los campos no estén vací­os
            if (empty($id) || empty($email) || empty($password_actual) || empty($password_nuevo)  || empty($password_confirmacion)) {
                $respuesta = [
                    "mensaje" => "Hay campo(s) vacío(s) en el formulario.",
                    "status" => "error"
                ];
                
                echo json_encode($respuesta, JSON_UNESCAPED_UNICODE); 
                exit();
            }


            // Validar que el password de confirmación sea igual al password
            if ($password_nuevo != $password_confirmacion) {
                $respuesta = [
                    "mensaje" => "Las contraseñas no coindicen.",
                    "status" => "error"
                ];
                
                echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  // Convertir array PHP a JSON
                // header("Location: formulario-registro-cliente.php");
                exit();
            }

            
            // Validar que las contraseñas tengan el número de caracteres requerido
            if (strlen($password_nuevo) < 6 || strlen($password_nuevo) > 8) {
                $respuesta = [
                    "mensaje" => "La contraseña debe tener entre 6 y 8 caracteres.",
                    "status" => "error"
                ];
                
                echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  // Convertir array PHP a JSON
                // header("Location: formulario-registro-cliente.php");
                exit();
            }
                
        
            // Verificamos las credenciales del cliente   
            $objetoClientes = new Clientes();
            $consultaAtenticacion = $objetoClientes->loginCliente($email);
            
            $resultadoAutenticacion = $consultaAtenticacion->fetch_assoc(); 

            if (!$consultaAtenticacion) {
                $respuesta = [
                    "mensaje" => "El email ingresado no está registrado en el sistema.",
                    "status" => "error"
                ];
                
                echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  
                exit();
            }
            

            // Validamos la contraseña del cliente
            if (password_verify($password_actual, $resultadoAutenticacion["password_cliente"])) {

                $cambio = $objetoClientes->cambiarPasswordCliente($id, $email, $passwordHasheada);                    
                // Actualizar el cliente en la base de datos
                if ($cambio) {
                    $respuesta = [
                        "mensaje" => "Contraseña cambiada con éxito.",
                        "status" => "success"
                    ];
                        
                    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  

                } else {
                    $respuesta = [
                        "mensaje" => "Se produjo un error.",
                        "status" => "error"
                    ];
                        
                    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE); 
                }
                    
            } else {
                $respuesta = [
                    "mensaje" => "Contraseña inválida.",
                    "status" => "error"
                ];
                    
                echo json_encode($respuesta, JSON_UNESCAPED_UNICODE); 
                exit();
            }
        
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
