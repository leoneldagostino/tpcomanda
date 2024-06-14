<?php
require_once './models/Pedido.php';
require_once './interfaces/IApiUsable.php';


class PedidoController extends Pedido implements IApiUsable
{
    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $idMesa = $parametros['idMesa'];
        $idProducto = $parametros['idProducto'];
        $idMozo = $parametros['idMozo'];
        $codigo = $parametros['codigo'];
        $tiempo = $parametros['tiempo'];
        $cantidad = $parametros['cantidad'];

        // Creamos el pedido
        
        $pedido = new Pedido();
        $pedido->idMesa = $parametros['idMesa'];
        $pedido->idProducto = $parametros['idProducto'];
        $pedido->idMozo = $parametros['idMozo'];
        $pedido->codigo = $parametros['codigo'];
        $pedido->tiempo = $parametros['tiempo'];
        $pedido->cantidad = $parametros['cantidad'];

        $pedido->cargarPedido($idMesa, $idProducto, $idMozo,$codigo, $tiempo, $cantidad);

        $payload = json_encode(array("mensaje" => "Pedido creado con exito"));

        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args)
    {
        // Buscamos producto por id
        // $id = $args['id'];
        // // $producto = Producto::obtenerProducto($id);
        // // $payload = json_encode($producto);

        // $response->getBody()->write($payload);
        // return $response->withHeader('Content-Type', 'application/json');
    }

    public function TraerTodos($request, $response, $args)
    {
        $lista = Pedido::mostrarPedidos();
        $payload = json_encode(array("listaPedidos" => $lista));

        $response->getBody()->write($payload);
        return $response
        ->withHeader('Content-Type', 'application/json');
    }
    
    public function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $nombre = $parametros['nombre'];
        // Producto::modificarProducto($nombre);

        $payload = json_encode(array("mensaje" => "Producto modificado con exito"));

        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
    
    public function BorrarUno($request, $response, $args)
    {
        $id = $args['id'];
        // Producto::borrarProducto($id);

        $payload = json_encode(array("mensaje" => "Producto eliminado con exito"));

        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
}