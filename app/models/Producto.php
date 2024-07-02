<?php

class Producto {

    public $id;
    public $nombre;
    public $responsable;
    public $precio;

    public static function cargarProducto($nombre, $responsable, $precio)
    {
        $accederDatos = AccesoDatos::obtenerInstancia();
        $sentencia = $accederDatos->prepararConsulta("INSERT INTO producto (nombre, responsable, precio) VALUES (:nombre, :responsable, :precio)");
        $sentencia->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $sentencia->bindValue(':responsable', $responsable, PDO::PARAM_INT);
        $sentencia->bindValue(':precio', $precio, PDO::PARAM_INT);

        $sentencia->execute();

        return $accederDatos->obtenerUltimoId();
    }

    public static function mostrarProductos()
    {

        $accederDatos = AccesoDatos::obtenerInstancia();
        $sentencia = $accederDatos->prepararConsulta("SELECT * FROM producto");
        $sentencia->execute();

        return $sentencia->fetchAll(PDO::FETCH_CLASS, 'Producto');
    }

    public function buscarProductoPorId($idProducto)
    {
        if(!$this->verificarProductoPorId($idProducto)){
            return 0;
        }
        else{

            $accederDatos = AccesoDatos::obtenerInstancia();
            $sentencia = $accederDatos->prepararConsulta("SELECT * FROM producto WHERE id = :id");
            $sentencia->bindValue(':id', $idProducto, PDO::PARAM_INT);
            $sentencia->execute();
    
            return $sentencia->fetchObject('Producto');
        }
    }

    
    public function modificarProducto($idProducto)
    {
        if(!$this->verificarProductoPorId($idProducto)){
            return 0;
        }
        else{

            $accederDatos = AccesoDatos::obtenerInstancia();
            $sentencia = $accederDatos->prepararConsulta("UPDATE producto SET nombre = :nombre, precio = :precio, responsable = :responsable WHERE id = :id");
            $sentencia->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
            $sentencia->bindValue(':precio', $this->precio, PDO::PARAM_INT);
            $sentencia->bindValue(':responsable', $this->responsable, PDO::PARAM_INT);
            $sentencia->bindValue(':id', $idProducto, PDO::PARAM_INT);
    
            return $sentencia->execute();
        }
    }

    public function borrarProducto($idProducto)
    {
        if(!$this->verificarProductoPorId($idProducto)){
            return 0;
        }
        else{
            $accederDatos = AccesoDatos::obtenerInstancia();
            $sentencia = $accederDatos->prepararConsulta("DELETE FROM producto WHERE id = :id");
            $sentencia->bindValue(':id', $idProducto, PDO::PARAM_INT);
    
            return $sentencia->execute();

        }
    }

    private function verificarProductoPorId($id)
    {

        $accederDatos = AccesoDatos::obtenerInstancia();
        $sentencia = $accederDatos->prepararConsulta("SELECT * FROM producto WHERE id = :id");
        $sentencia->bindValue(':id', $id, PDO::PARAM_INT);
        $sentencia->execute();
        if($sentencia->rowCount() > 0){
            return true;
        }
        
        return 0;
    }
}




