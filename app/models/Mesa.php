<?php


class Mesa
{
    public $codigo;

    public $estado;

    public function cargarMesa($codigo, $estado)
    {        
        $accederDatos = AccesoDatos::obtenerInstancia();
        $sentencia = $accederDatos->prepararConsulta("INSERT INTO mesa (estado, codigo) VALUES (:estado, :codigo)");
        $sentencia->bindValue(':estado', $estado, PDO::PARAM_STR);
        $sentencia->bindValue(':codigo', $codigo, PDO::PARAM_INT);

        $sentencia->execute();

        return $accederDatos->obtenerUltimoId();
    }

    public function mostrarMesas()
    {
        $accederDatos = AccesoDatos::obtenerInstancia();
        $sentencia = $accederDatos->prepararConsulta('SELECT * FROM mesa');
        $sentencia->execute();

        return $sentencia->fetchAll(PDO::FETCH_CLASS,'Mesa');
    }

}