<?php
require_once 'conexion.php';

class Productos {
    private $id;
    private $nombre;
    private $descripcion;
    private $categoria;
    private $codigo_barras;
    private $marca;
    private $precio;
    private $stock;
    private $favorito;


    //Getters

    //Setters

    //Funciones

    public function crearProducto($nombre, $descripcion, $categoria, $codigo_barras, $marca, $precio, $stock) {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->categoria = $categoria;
        $this->codigo_barras = $codigo_barras;
        $this->marca = $marca;
        $this->precio = $precio;
        $this->stock = $stock;
        
        $objConexion = new Conexion();
        $conexion = $objConexion->conectarse();

        $sql = "CALL crearProducto(?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
           
        // Enlazar parámetros
        $stmt->bind_param("sssssii", $this->nombre, $this->descripcion, $this->categoria, $this->codigo_barras, $this->marca, $this->precio, $this->stock);
    
        // Ejecutar y validar la consulta
        $resultado = $stmt->execute();
        
        $stmt->close();
        $conexion->close();
    
        return $resultado;  // Devuelve true si se ejecutó correctamente, false en caso de error
    }


    public function validarCodigoBarras($codigo_barras) {
        $this->codigo_barras = $codigo_barras;

        $objConexion = new Conexion();
        $conexion = $objConexion->conectarse();

        $sql = "CALL validarCodigoDeBarras(?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $this->codigo_barras);

        // Ejecutar y validar la consulta
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        $stmt->close();
        $conexion->close();
    
        return $resultado;  // Devuelve true si se ejecutó correctamente, false en caso de error
    }


    public function editarProducto($id, $nombre, $descripcion, $categoria, $marca, $precio, $stock) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->categoria = $categoria;
        $this->marca = $marca;
        $this->precio = $precio;
        $this->stock = $stock;

        $objConexion = new Conexion();
        $conexion = $objConexion->conectarse();

        $sql = "CALL editarProducto(?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("issssii", $this->id, $this->nombre, $this->descripcion, $this->categoria, $this->marca, $this->precio, $this->stock);

        // Ejecutar y validar la consulta
        $resultado = $stmt->execute();

        $stmt->close();
        $conexion->close();
    
        return $resultado;  // Devuelve true si se ejecutó correctamente, false en caso de error
    }


    public function eliminarProducto($id) {
        $this->id = $id;

        $objConexion = new Conexion();
        $conexion = $objConexion->conectarse();

        $sql = "CALL eliminarProducto(?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $this->id);

        // Ejecutar y validar la consulta
        $resultado = $stmt->execute();

        $stmt->close();
        $conexion->close();
    
        return $resultado;  // Devuelve true si se ejecutó correctamente, false en caso de error
    }


    public function revisarPosiblesVentas($id) {
        $this->id = $id;

        $objConexion = new Conexion();
        $conexion = $objConexion->conectarse();

        $sql = "CALL revisarPosiblesVentas(?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $this->id);

        $stmt->execute();
        $resultado = $stmt->get_result();

        $stmt->close();
        $conexion->close();
    
        return $resultado;  // Devuelve true si se ejecutó correctamente, false en caso de error
    }


    public function verProducto($id) {
        $this->id = $id;

        $objConexion = new Conexion();
        $conexion = $objConexion->conectarse();

        $sql = "CALL verProductoPorId(?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $this->id);

        $stmt->execute();
        $resultado = $stmt->get_result();

        $stmt->close();
        $conexion->close();
    
        return $resultado;  // Devuelve true si se ejecutó correctamente, false en caso de error
    }


    public function verProductos() {
        $objConexion = new Conexion();
        $conexion = $objConexion->conectarse();
        $sql = "CALL verTodosLosProductos()";
        $stmt = $conexion->prepare($sql);
    
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }
    
        // Ejecutar y validar la consulta
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        $stmt->close();
        $conexion->close();
    
        return $resultado;  // Devuelve true si se ejecutó correctamente, false en caso de error
    }


    public function verProductosDestacados() {
        $objConexion = new Conexion();
        $conexion = $objConexion->conectarse();
        $sql = "CALL verProductosDestacados()";
        $stmt = $conexion->prepare($sql);
    
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }
    
        // Ejecutar y validar la consulta
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        $stmt->close();
        $conexion->close();
    
        return $resultado;  // Devuelve true si se ejecutó correctamente, false en caso de error
    }


    public function gestionarFavoritoDelAdmin($id) {
        $this->id = $id;

        $objConexion = new Conexion();
        $conexion = $objConexion->conectarse();
        $sql = "CALL gestionarFavoritoDelAdmin(?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $this->id);
    
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }
    
        // Ejecutar y validar la consulta
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            $stmt->close();
            $conexion->close();
            return true;
        } else {
            $stmt->close();
            $conexion->close();
            return false;
        }

    }


    public function consultarDisponibilidad($id_cliente, $id_producto) { 
        $this->id = $id_producto;

        $objConexion = new Conexion();
        $conexion = $objConexion->conectarse();
        $sql = "CALL consultarDisponibilidad(?, ?)";
        $stmt = $conexion->prepare($sql);
    
        if (!$stmt) {
            die(json_encode(["error" => "Error en la preparación de la consulta: " . $conexion->error]));
        }
    
        $stmt->bind_param("ii", $id_cliente, $this->id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        $stmt->close();
        $conexion->close();
    
        return ($resultado->num_rows > 0) ? $resultado : null;
    }



    public function verStock($id) {
        $this->id = $id;
    
        $objConexion = new Conexion();
        $conexion = $objConexion->conectarse();
        $sql = "CALL verStock(?)";
        $stmt = $conexion->prepare($sql);
    
        if (!$stmt) {
            die(json_encode(["error" => "Error en la preparación de la consulta: " . $conexion->error]));
        }
    
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        $stmt->close();
        $conexion->close();
    
        return ($resultado->num_rows > 0) ? $resultado : null;
    }


    public function actualizarStock($id, $stock) {
        $this->id = $id;
        $this->stock = $stock;

        $objConexion = new Conexion();
        $conexion = $objConexion->conectarse();

        $sql = "CALL actualizarStock(?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ii", $this->id, $this->stock);

        // Ejecutar y validar la consulta
        $resultado = $stmt->execute();

        $stmt->close();
        $conexion->close();
    
        return $resultado;  // Devuelve true si se ejecutó correctamente, false en caso de error
    }
    


    public function verProductosPorCategoria($categoria) {
        $this->categoria = $categoria;

        $objConexion = new Conexion();
        $conexion = $objConexion->conectarse();
        $sql = "CALL verProductosPorCategoria(?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $this->categoria);
    
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }
    
        // Ejecutar y validar la consulta
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        $stmt->close();
        $conexion->close();
    
        return $resultado;  // Devuelve true si se ejecutó correctamente, false en caso de error
    }


    public function verProductosNuevos() {
        $objConexion = new Conexion();
        $conexion = $objConexion->conectarse();
        $sql = "CALL verProductosNuevos()";
        $stmt = $conexion->prepare($sql);
            
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }
    
        // Ejecutar y validar la consulta
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        $stmt->close();
        $conexion->close();
    
        return $resultado;  // Devuelve true si se ejecutó correctamente, false en caso de error
    }


    public function verProductosEnOferta() {
        $objConexion = new Conexion();
        $conexion = $objConexion->conectarse();
        $sql = "CALL verProductosEnOferta()";
        $stmt = $conexion->prepare($sql);
            
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }
    
        // Ejecutar y validar la consulta
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        $stmt->close();
        $conexion->close();
    
        return $resultado;  // Devuelve true si se ejecutó correctamente, false en caso de error
    }
}





?>