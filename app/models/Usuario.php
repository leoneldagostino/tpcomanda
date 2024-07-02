<?php

class Usuario
{
    public $id;
    public $usuario;
    public $clave;
    public $tipo;

    public function crearUsuario()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();

        
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO usuario (usuario, clave, tipo) VALUES (:usuario, :clave, :tipo)");
        $claveHash = password_hash($this->clave, PASSWORD_DEFAULT);
        $consulta->bindValue(':usuario', $this->usuario, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $claveHash, PDO::PARAM_STR);
        $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
        $consulta->execute();

        return $objAccesoDatos->obtenerUltimoId();
    }

    public static function obtenerTodos()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM usuario");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Usuario');
    }

    public static function obtenerUsuario($usuario)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT id, usuario, clave, tipo FROM usuario WHERE usuario = :usuario");
        $consulta->bindValue(':usuario', $usuario, PDO::PARAM_STR);
        $consulta->execute();

        return $consulta->fetchObject('Usuario');
    }

    public static function modificarUsuario($objeo)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE usuarios SET usuario = :usuario, clave = :clave WHERE id = :id");
        $consulta->bindValue(':usuario', $objeo->usuario, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $objeo->clave, PDO::PARAM_STR);
        $consulta->bindValue(':id', $objeo->id, PDO::PARAM_INT);
        $consulta->execute();
    }

    public static function borrarUsuario($usuario)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE usuarios SET fechaBaja = :fechaBaja WHERE id = :id");
        $fecha = new DateTime(date("d-m-Y"));
        $consulta->bindValue(':id', $usuario, PDO::PARAM_INT);
        $consulta->bindValue(':fechaBaja', date_format($fecha, 'Y-m-d H:i:s'));
        $consulta->execute();
    }

    /**
     * Funcion que busca el rol del usuario en la base de datos
     * @param string $usuario el nombre del usuario a buscar
     * 
     * @return string el id del rol del usuario
     */
    public static function obtenerRolPorUsuario($usuario)
    {
        $usuarioObj = Usuario::obtenerUsuario($usuario);
        $tipoUsuario = Usuario::obtenerRolUsuario($usuarioObj->tipo);

        return $tipoUsuario;
    }
//! descontinuada -> se reemplaza por la funcion obtenerRolPorUsuario -> se dejara por si se necesita en un futuro caso contrario eliminamos
    public static function verificarRolUsuario($usuario, $rolUsuario)
    {
        $datosUsuario = Usuario::obtenerUsuario($usuario);
        
        if($datosUsuario == null)
        {
            return false;
        }
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("SELECT id FROM tipo_usuario WHERE nombre = :nombre");
        $consulta->bindValue(':nombre', $rolUsuario, PDO::PARAM_STR);
        if($consulta->execute())
        {
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

            if($resultado['id'] == $datosUsuario->tipo)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        return false;
    }

    /**
     * Funcion que busca el rol del usuario en la base de datos
     * @param int $rol el id del rol a buscar
     * 
     * @return string el nombre del rol del usuario
     */
    private static function obtenerRolUsuario($rol)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("SELECT nombre FROM tipo_usuario WHERE id = :id");
        $consulta->bindValue(':id', $rol, PDO::PARAM_INT);
        if($consulta->execute())
        {
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
            return $resultado['nombre'];
        }
        else
        {
            throw new Exception('Error al buscar el rol del usuario');

        }
    }

        


    //? IMPLEMENTAR LA FUNCION PARA QUE EL USUARIO PUEDA LOGEARSE
    

    //TODO IMPLEMENTAR LA FUNCION PARA QUE EL USUARIO PUEDA VER EL ESTADO DE UN PEDIDO


}