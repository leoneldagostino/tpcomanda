<?php

class Pedido 
{
    public $idMesa;
    public $idProducto;
    public $idMozo;
    public $codigo;
    public $tiempo;
    public $cantidad;

    public function cargarPedido($idMesa,$idProducto,$idMozo,$codigo,$tiempo,$cantidad)
    {
        $accederDatos = AccesoDatos::obtenerInstancia();
        $sentencia = $accederDatos->prepararConsulta("INSERT INTO pedido (id_mesa, id_prod, id_mozo, codigo, tiempo, cantidad) VALUES (:idMesa, :idProducto, :idMozo, :codigo, :tiempo, :cantidad)");
        $sentencia->bindValue(':idMesa', $idMesa, PDO::PARAM_INT);
        $sentencia->bindValue(':idProducto', $idProducto, PDO::PARAM_INT);
        $sentencia->bindValue(':idMozo', $idMozo,PDO::PARAM_INT);
        $sentencia->bindValue(':codigo', $codigo, PDO::PARAM_INT);
        $sentencia->bindValue(':tiempo', $tiempo, PDO::PARAM_INT);
        $sentencia->bindValue(':cantidad', $cantidad, PDO::PARAM_INT);

        $sentencia->execute();

        return $accederDatos->obtenerUltimoId();

    }

    public function mostrarPedidos()
    {
        $accederDatos = AccesoDatos::obtenerInstancia();
        $sentencia = $accederDatos->prepararConsulta('SELECT * FROM pedido');
        $sentencia->execute();

        return $sentencia->fetchAll(PDO::FETCH_CLASS,'Pedido');
    }
}