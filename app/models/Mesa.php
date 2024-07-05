<?php


class Mesa
{
    public $codigo;

    public $estado;

    public static function cargarMesa($codigo, $estado)
    {        
        $accederDatos = AccesoDatos::obtenerInstancia();
        $sentencia = $accederDatos->prepararConsulta("INSERT INTO mesa (estado, codigo) VALUES (:estado, :codigo)");
        $sentencia->bindValue(':estado', $estado, PDO::PARAM_INT);
        $sentencia->bindValue(':codigo', $codigo, PDO::PARAM_INT);

        $sentencia->execute();

        return $accederDatos->obtenerUltimoId();
    }

    public static function mostrarMesas()
    {
        $accederDatos = AccesoDatos::obtenerInstancia();
        $sentencia = $accederDatos->prepararConsulta('SELECT * FROM mesa');
        $sentencia->execute();

        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }
    public function ComprobarCodigo($codigo){ 
        $accederDatos = AccesoDatos::obtenerInstancia();
        $consulta = $accederDatos->prepararConsulta("SELECT * FROM mesa where codigo = :codigo");
        $consulta->bindValue(':codigo', $codigo);
        $consulta->execute();

        if($consulta->rowCount() > 0)return false;
        else return true;
    }

    public static function ActualizarMesa($id){
        $accederDatos = AccesoDatos::obtenerInstancia();
        $consulta = $accederDatos->prepararConsulta("SELECT pedidos.estado FROM pedidos INNER JOIN mesas on pedidos.idMesa= mesas.id where pedidos.idMesa = '$id' and pedidos.estado != 'Cobrado'");
        $consulta->execute();
        $flag=false;
        
        while($mesa= $consulta->fetch(PDO::FETCH_ASSOC)){
            if($mesa['estado']!= "Listo"){
                $flag= true;
                break;
            }
        }
        if(!$flag) {
            $accederDatos = AccesoDatos::obtenerInstancia();
            $consulta = $accederDatos->prepararConsulta("UPDATE mesas SET estado= 'Comiendo' where id = '$id'");
            $consulta->execute();
            return true;
        }
        return false;
    }
    public static function CerrarMesa($id){
        $accederDatos = AccesoDatos::obtenerInstancia();
        $consulta = $accederDatos->prepararConsulta("UPDATE mesas set estado= 'Cerrada' where id = '$id'");
        $consulta->execute();
        return true;
    }
}