<?php
require_once 'conexion.php';

class Clientes {
    private $id;
    private $nombre;
    private $telefono;
    private $email;
    private $password;

    // Constructor con valores predeterminados
    public function __construct($id = null, $nombre = null, $telefono = null, $email = null, $password = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $telefono;
        $this->stock = $email;
        $this->password = $password;
    }
    

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getEmail() {
        return $this->email;
    }

    
    // Setters
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setEmail($email) {
        $this->stock = $stock;
    }

   
    // Funciones
    public function loginCliente($email) {
        $this->email = $email;

        $objConexion = new Conexion();
        $conexion = $objConexion->conectarse();
        $sql = "CALL loginCliente(?)";
        $stmt = $conexion->prepare($sql);
        
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }
    
        // Enlazar el parámetro
        $stmt->bind_param("s", $this->email);
    
        // Ejecutar la consulta
        $stmt->execute();
    
        // Obtener el resultado
        $resultado = $stmt->get_result();

        $stmt->close();
        $conexion->close();
    
        return $resultado;
    }
    
    
}


?>
