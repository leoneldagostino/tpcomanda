<?php

class Producto {
    public $nombre;
    public $precio;
    public $tipo;

    public function cargarProducto($nombre, $precio, $tipo)
    {
        $accederDatos = AccesoDatos::obtenerInstancia();
        $sentencia = $accederDatos->prepararConsulta("INSERT INTO producto (nombre, precio, tipo) VALUES (:nombre, :precio, :tipo)");
        $sentencia->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $sentencia->bindValue(':precio', $precio, PDO::PARAM_INT);
        $sentencia->bindValue(':tipo', $tipo, PDO::PARAM_STR);

        $sentencia->execute();

        return $accederDatos->obtenerUltimoId();
    }

    public function mostrarProductos()
    {
        $accederDatos = AccesoDatos::obtenerInstancia();
        $sentencia = $accederDatos->prepararConsulta("SELECT * FROM producto");
        $sentencia->execute();

        return $sentencia->fetchAll(PDO::FETCH_CLASS, 'Producto');
    }

    
    
}




