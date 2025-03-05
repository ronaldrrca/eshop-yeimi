<?php
require_once 'conexion.php';

class Clientes {
    private $id;
    private $nombre;
    private $telefono;
    private $email;
    private $password;
    private $departamento;
    private $ciudad;
    private $barrio;
    private $direccion_envio;

    // Constructor con valores predeterminados
    // public function __construct($id = null, $nombre = null, $telefono = null, $email = null, $password = null, $departamento = null, 
    // $ciudad = null, $barrio = null, $direccion_envio = null) {
    //     $this->id = $id;
    //     $this->nombre = $nombre;
    //     $this->telefono = $telefono;
    //     $this->email = $email;
    //     $this->password = $password;
    //     $this->departamento = $departamento;
    //     $this->ciudad = $ciudad;
    //     $this->barrio = $barrio;
    //     $this->direccion_envio = $direccion_envio;
    // }
    

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


    public function validarEmail($email) {
        $this->email = $email;

        $objConexion = new Conexion();
        $conexion = $objConexion->conectarse();
        $sql = "CALL validarEmail(?)";
        $stmt = $conexion->prepare($sql);

        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }

        // Enlazar parámetros
        $stmt->bind_param("s", $this->email);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener resultado
        $stmt->get_result();

        if ($stmt->num_rows > 0) {
            return true;  
        } else {
            return false; 
        }
    }


    public function registrarCliente($nombre, $telefono, $email, $password) {
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->password = $password;
    
        $objConexion = new Conexion();
        $conexion = $objConexion->conectarse();
        
        $sql = "CALL registrarCliente(?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
    
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }
    
        // Enlazar parámetros
        $stmt->bind_param("ssss", $this->nombre, $this->telefono, $this->email, $this->password);
    
        // Ejecutar la consulta
        if (!$stmt->execute()) {
            die("Error en la ejecución de la consulta: " . $stmt->error);
        }
    
        // Obtener el resultado del procedimiento almacenado
        $stmt->store_result();
        $stmt->bind_result($idInsertado);
    
        if ($stmt->fetch()) {
            $stmt->close();
            $conexion->close();
            return $idInsertado; // Devuelve el ID obtenido del procedimiento almacenado
        } else {
            $stmt->close();
            $conexion->close();
            return 0; // Si no hay resultado, devuelve 0
        }
    }
    
    

    public function actualizarCliente($id, $telefono, $email) {
        $this->id = $id;
        $this->telefono = $telefono;
        $this->email = $email;

        $objConexion = new Conexion();
        $conexion = $objConexion->conectarse();
        $sql = "CALL actualizarCliente(?, ?, ?)";
        $stmt = $conexion->prepare($sql);
    
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }
    
        $stmt->bind_param("iss", $this->id, $this->telefono, $this->email);
    
        // Ejecutar y validar la consulta
        $resultado = $stmt->execute();
        
        $stmt->close();
        $conexion->close();
    
        return $resultado;  // Devuelve true si se ejecutó correctamente, false en caso de error
    }


    public function agregarEditarDireccionCliente($id, $departamento, $ciudad, $barrio, $direccion_envio) {
        $this->id = $id;
        $this->departamento = $departamento; 
        $this->ciudad = $ciudad;
        $this->barrio = $barrio;
        $this->direccion_envio = $direccion_envio;

        $objConexion = new Conexion();
        $conexion = $objConexion->conectarse();
        $sql = "CALL agregarDireccionCliente(?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);

        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }

        $stmt->bind_param("issss", $this->id, $this->departamento, $this->ciudad, $this->barrio, $this->direccion_envio);

        // Ejecutar y validar la consulta
        $resultado = $stmt->execute();
        
        $stmt->close();
        $conexion->close();
    
        return $resultado;  // Devuelve true si se ejecutó correctamente, false en caso de error
    }
    

    public function cambiarPasswordCliente($id, $email, $password)  {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;

        $objConexion = new Conexion();
        $conexion = $objConexion->conectarse();
        $sql = "CALL cambiarPasswordCliente(?, ?, ?)";
        $stmt = $conexion->prepare($sql);

        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }

        $stmt->bind_param("iss", $this->id, $this->email, $this->password);

        // Ejecutar y validar la consulta
        $resultado = $stmt->execute();
        
        $stmt->close();
        $conexion->close();
    
        return $resultado;  // Devuelve true si se ejecutó correctamente, false en caso de error
    }
}


?>
