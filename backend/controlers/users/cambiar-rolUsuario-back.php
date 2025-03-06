<?php
session_start();
require_once "../../models/usuarios-modelo.php"; 
header('Content-Type: application/json');  


//Verificamos si se reciben los datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $respuesta = [];
    $id = trim($_POST["id"]);
    $rol_actual = trim($_POST['rol_actual']);
    $rol_nuevo = trim($_POST['rol_nuevo']);
} else {
    echo 'No se recibieron datos';
    exit;
}   

// Veridicamos los privilegios
if (!isset($_SESSION['rol_usuario']) || $_SESSION['rol_usuario'] != "superadmin") {
    echo "Usuario no tiene suficientes privilegios";
    exit;
}    

// Verificamos si se recibe el ID del usuario a editar
if (empty($id)) {
    echo "Falta el ID del usuario a editar.";
    exit;
}  

// Verificamos que no se pueda cambiar el rol del superadmin
if ($rol_actual === "superadmin") {
    echo "No se puede cambiar el rol del superadmin";
    exit;
}


$objUsuarios = new Usuarios();
$cambiar = $objUsuarios->cambiaRolUsuario($id, $rol_nuevo);

if ($cambiar) {
    $respuesta = [
        "mensaje" => "Rol de usuario cambiado con éxito.",
        "status" => "success"
    ];
    
} else {
    $respuesta = [
        "mensaje" => "Ocurrió un error.",
        "status" => "error"
    ];
}

echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  // Convertir array PHP a JSON

?>           
        
        
        

    


    