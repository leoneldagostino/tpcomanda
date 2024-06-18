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

    public function modificarPedido($idPedido, $estado)
    {
        $idEstado = $this->verificarEstado($estado);
        if(!$this->verificarPedidoPorId($idPedido) && $idEstado != 0){
            return 0;
        }
        else{
            
            $accederDatos = AccesoDatos::obtenerInstancia();
            $sentencia = $accederDatos->prepararConsulta("UPDATE pedido SET estado = :estado WHERE id = :id");
            $sentencia->bindValue(':estado', $estado, PDO::PARAM_STR);
            $sentencia->bindValue(':id', $idPedido, PDO::PARAM_INT);

            return $sentencia->execute();
        }
    }

    private function verificarPedidoPorId($id)
    {
        $accederDatos = AccesoDatos::obtenerInstancia();
        $sentencia = $accederDatos->prepararConsulta("SELECT * FROM pedido WHERE id = :id");
        $sentencia->bindValue(':id', $id, PDO::PARAM_INT);
        $sentencia->execute();
        
        if($sentencia->rowCount() > 0)
        {
            return true;
        }
        return false;
        
    }

    private function verificarEstado($estado)
    {
        $accederDatos = AccesoDatos::obtenerInstancia();
        $sentencia = $accederDatos->prepararConsulta("SELECT id FROM mesa_estado WHERE nombre = :estado");
        $sentencia->bindValue(':estado',$estado,PDO::PARAM_STR);
        $sentencia->execute();

        if($sentencia->rowCount() > 0)
        {
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado['id'];
        }
        else {
            return 0;
        }

    }
}