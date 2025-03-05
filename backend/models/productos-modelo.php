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


}





?>