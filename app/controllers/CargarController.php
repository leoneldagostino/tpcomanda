<?php

require_once './models/Usuario.php';
require_once './models/Mesa.php';
require_once './models/Pedido.php';
require_once './models/Producto.php';


class CargarController
{
    // public static function cargarProductos($rutaArchivo) {
    //     $archivo = fopen($rutaArchivo, 'r');
    //     while (($datos = fgetcsv($archivo, 1000, ',')) !== FALSE) {
    //         $nombre = $datos[0];
    //         $precio = $datos[1];
    //         $tipo = $datos[2];
    //         Producto::cargarProducto($nombre, $precio, $tipo);
    //     }
    //     fclose($archivo);
    // }

    // public static function cargarUsuarios($rutaArchivo) {
    //     $archivo = fopen($rutaArchivo, 'r');
    //     while (($datos = fgetcsv($archivo, 1000, ',')) !== FALSE) {
    //         $usuario = new Usuario();
    //         $usuario->usuario = $datos[0];
    //         $usuario->clave = $datos[1];
    //         $usuario->tipo = $datos[2];
    //         $usuario->crearUsuario();
    //     }
    //     fclose($archivo);
    // }

    // public static function cargarPedidos($rutaArchivo) {
    //     $archivo = fopen($rutaArchivo, 'r');
    //     while (($datos = fgetcsv($archivo, 1000, ',')) !== FALSE) {
    //         $idMozo = $datos[0];
    //         $idMesa = $datos[1];
    //         $idProducto = $datos[2];
    //         $codigo = $datos[3];
    //         $tiempo = $datos[4];
    //         $cantidad = $datos[5];
    //         $estado = $datos[6];
    //         Pedido::cargarPedido($idMozo, $idMesa, $idProducto, $codigo, $tiempo, $cantidad, $estado);
    //     }
    //     fclose($archivo);
    // }

    public static function cargarMesa($request,$response){
        $archivo = "./csv/mesa.csv";
        if(($lector= fopen($archivo, 'r')) !== false){
            $fila= fgetcsv($lector);
            while(($fila=fgetcsv($lector)) !== false){
                $estado = $fila[0];
                $codigo = $fila[1];
                Mesa::cargarMesa($codigo,$estado);
            }
            fclose($lector);
        }

        $response->getBody()->write("Se cargaron las mesas correctamente.");
        return $response;
    }

    public static function cargarUsuarios( $request,  $response, $args){
        $archivo= "./csv/usuarios.csv";

        if(($lector= fopen($archivo, 'r')) !== false){
            $fila= fgetcsv($lector);
            while(($fila=fgetcsv($lector)) !== false){
                $usuario = new Usuario();
                $usuario->usuario= $fila[0];
                $usuario->clave = $fila[1];
                $usuario->tipo = $fila[2];
                $usuario->crearUsuario();
            }
            fclose($lector);
        }
        $response->getBody()->write("Se cargo correctamente");
        return $response;
    }


    public static function cargarPedidos()
    {
        $rutaArchivo = "./csv/pedidos.csv";
        try {
            $archivo = fopen($rutaArchivo, 'r');
            if (!$archivo) {
                throw new Exception("No se pudo abrir el archivo CSV.");
            }

            while (($datos = fgetcsv($archivo, 1000, ',')) !== FALSE) {
                // Asegurarse de tener los datos correctos en el orden esperado según tu CSV
                $idMozo = $datos[1];
                $idMesa = $datos[2];
                $idProducto = $datos[3];
                $tiempo = $datos[4];
                $codigo = $datos[5];
                $cantidad = $datos[6];
                $estado = $datos[7];

                // Llamar al método estático de Pedido para cargar el pedido
                Pedido::cargarPedido($idMozo, $idMesa, $idProducto, $codigo,$tiempo, $cantidad, $estado);
            }

            fclose($archivo);
            return true; // Indicar que la carga fue exitosa
        } catch (Exception $e) {
            throw new Exception("Error al cargar pedidos desde CSV: " . $e->getMessage());
        }
    }

    public static function CargarProductos( $request,  $response, $args){
        $archivo= "./csv/productos.csv";

        if(($lector= fopen($archivo, 'r')) !== false){
            $fila= fgetcsv($lector);
            while(($fila=fgetcsv($lector)) !== false){
                Producto::cargarProducto($fila[0], $fila[1], $fila[2]);

            }
            fclose($lector);
        }
        $response->getBody()->write("Se cargo correctamente");
        return $response;
    }

}

