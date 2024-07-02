<?php

require_once './models/Usuario.php';
require_once './models/Mesa.php';
require_once './models/Pedido.php';
require_once './models/Producto.php';

class GuardarController
{
    public function guardarUsuario($request, $response)
    {
        try{
            $usuariosDatos = Usuario::obtenerTodos();
            $archivo = fopen("./csv/usuarios.csv", "w");

            $datos = array('id','nombre','tipo');
            fputcsv($archivo, $datos);

            foreach($usuariosDatos as $usuario)
            {
                $fila = get_object_vars($usuario);
                fputcsv($archivo, $fila);
            }

            $response->getBody()->write(json_encode(array("mensaje" => "Usuarios guardados en csv")));

        }catch(Exception $e){
            $response->getBody()->write(json_encode(array("error" => $e->getMessage())));
        }finally{
            fclose($archivo);
        }
        return $response;
    }

    public function GuardarMesas($request,$response)
    {
        try{
            $mesasDatos = Mesa::mostrarMesas();
            $archivo = fopen("./csv/mesas.csv", "w");

            $datos = array('id','codigo','estado');
            fputcsv($archivo, $datos);

            foreach($mesasDatos as $mesa)
            {
                $fila = get_object_vars($mesa);
                fputcsv($archivo, $fila);
            }

            $response->getBody()->write(json_encode(array("mensaje" => "Mesas guardadas en csv")));

        }catch(Exception $e){
            $response->getBody()->write(json_encode(array("error" => $e->getMessage())));
        }finally{
            fclose($archivo);
        }
        return $response;
    }

    public function GuardarPedidos($request,$response)
    {
        try{
            $rutaArchivo = "./csv/pedidos.csv";
            $pedidosDatos = Pedido::mostrarPedidos();
            $archivo = fopen("./csv/pedidos.csv", "w");

            $datos = array('id','id_mesa','id_producto','id_usuario','cantidad','fecha');
            fputcsv($archivo, $datos);

            foreach($pedidosDatos as $pedido)
            {
                $fila = get_object_vars($pedido);
                fputcsv($archivo, $fila);
            }
            fclose($archivo);

            $response = $response->withHeader('Content-Type', 'text/csv');
            $response = $response->withHeader('Content-Disposition', 'attachment; filename=pedidos.csv');
            $response->getBody()->write(file_get_contents($rutaArchivo));

        }catch(Exception $e){
            $response->getBody()->write(json_encode(array("error" => $e->getMessage())));
        }
        return $response;
    }

    public function GuardarProductos($request,$response)
    {
        try{
            $productosDatos = Producto::mostrarProductos();
            $archivo = fopen("./csv/productos.csv", "w");

            $datos = array('id','nombre','precio','tipo');
            fputcsv($archivo, $datos);

            foreach($productosDatos as $producto)
            {
                $fila = get_object_vars($producto);
                fputcsv($archivo, $fila);
            }

            $response->getBody()->write(json_encode(array("mensaje" => "Productos guardados en csv")));

        }catch(Exception $e){
            $response->getBody()->write(json_encode(array("error" => $e->getMessage())));
        }finally{
            fclose($archivo);
        }
        return $response;
    }

}

