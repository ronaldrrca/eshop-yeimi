<?php
session_start();
require_once "../../models/clientes-modelo.php"; 
header('Content-Type: application/json');  

//Verificamos si el id recibido es el mismo de la sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $respuesta = [];
    $id = trim($_POST["id"]);
        
    if (isset($_SESSION['id_cliente']) && $_SESSION['id_cliente'] == $id) {
            $email_actual = trim($_POST["email_actual"]);// Lo recibimos como campo oculto del html, el valor original para comparlo con el que llegó por el formulario
            $email_nuevo = trim($_POST["email_nuevo"]); 
            $email_confirmacion = trim($_POST['email_confirmacion']);
            $telefono = isset($_POST['telefono']) ? trim($_POST["telefono"]) : "";
            $password = trim($_POST['password']);
                        
            // Validar que los campos no estén vací­os
            if (empty($id) || empty($telefono) || empty($email_nuevo) || empty($email_actual) || empty($email_confirmacion)|| empty($password)) {
                $respuesta = [
                    "mensaje" => "Hay campo(s) vacío(s) en el formulario.",
                    "status" => "error"
                ];
                
                echo json_encode($respuesta, JSON_UNESCAPED_UNICODE); 
                exit();
            }
        
        
            // Validar que los emails ingresados sean iguales
            if ($email_nuevo != $email_confirmacion) {
                $respuesta = [
                    "mensaje" => "Los emails son diferentes.",
                    "status" => "error"
                ];
                
                echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  
                exit();
            }

            
            // Verificamos las credenciales del cliente   
            $objetoClientes = new Clientes();
            $consultaAtenticacion = $objetoClientes->loginCliente($email_actual);
            
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
            if (password_verify($password, $resultadoAutenticacion["password_cliente"])) {

                // Validamos si el email actual (que viene como campo oculto) y el nuevo, son diferentes, para consultar si el nuevo se encuentra o no registrado
                if ($email_actual != $email_nuevo) {

                    // Verificar si el email ya está registrado
                    $consultaEmail = $objetoClientes->validarEmail($email_actual);
                    
                    if ($consultaEmail) {

                        $respuesta = [
                            "mensaje" => "El correo ya se encuentra registrado.",
                            "status" => "error"
                        ];
                        
                        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  
                        exit();
                    }
            
                }
                        
                $actualizacion = $objetoClientes->actualizarCliente($id, $telefono, $email_nuevo);                    
                // Actualizar el cliente en la base de datos
                if ($actualizacion) {
                    $respuesta = [
                        "mensaje" => "Usuario actualizado con éxito.",
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
