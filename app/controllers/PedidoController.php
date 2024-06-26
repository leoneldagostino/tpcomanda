<?php
require_once './models/Pedido.php';
require_once './interfaces/IApiUsable.php';


class PedidoController extends Pedido implements IApiUsable
{
    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $idMozo = $parametros['mozo'];
        $idProducto = $parametros['producto'];
        $idMesa = $parametros['mesa'];
        $tiempo = $parametros['tiempo'];
        $codigo = $parametros['codigo'];
        $cantidad = $parametros['cantidad'];
        
        // Creamos el pedido
        
        $pedido = new Pedido();
        // $pedido->idMesa = $parametros['mesa'];
        // $pedido->idProducto = $parametros['producto'];
        // $pedido->idMozo = $parametros['mozo'];
        // $pedido->codigo = $parametros['codigo'];
        // $pedido->tiempo = $parametros['tiempo'];
        // $pedido->cantidad = $parametros['cantidad'];

        $nroPedido = $pedido->cargarPedido($idMozo, $idMesa, $idProducto,$codigo, $tiempo, $cantidad, 1);

        $payload = json_encode(array("mensaje" => "Pedido creado con exito, el numero del pedido es $nroPedido"));

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
        $idPedido = $parametros['codigo'];
        $modificacionEstado = $parametros['estado'];

        Pedido::modificarPedido($idPedido, $modificacionEstado);

        $payload = json_encode(array("mensaje" => "Producto modificado con exito, el pedido se encuentra '$modificacionEstado'"));

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