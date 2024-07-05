<?php
require_once './models/Mesa.php';
require_once './interfaces/IApiUsable.php';

class MesaController extends Mesa implements IApiUsable
{
    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $codigo = $parametros['codigo'];
        $estado = $parametros['estado'];


        $mesa = new Mesa();
        $mesa->codigo = $codigo;
        $mesa->estado = $estado;
        $mesa->cargarMesa($codigo, $estado);

        $payload = json_encode(array("mensaje" => "Producto creado con exito"));

        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }


    public function TraerTodos($request, $response, $args)
    {
        $lista = Mesa::mostrarMesas();
        $payload = json_encode(array("listaMesa" => $lista));

        $response->getBody()->write($payload);
        return $response
        ->withHeader('Content-Type', 'application/json');
    }
    
    public function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $nombre = $parametros['nombre'];


        $payload = json_encode(array("mensaje" => "Producto modificado con exito"));

        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function Actualizar($request, $response, $args){
        $parametro= $request->getParsedBody();
        
        if(Mesa::ActualizarMesa($parametro['idMesa'])){
            $response->getBody()->write("Se actualizo el pedido");
        }else $response->getBody()->write("Algun pedido esta sin hacer ");
        return $response;
    }
    public function CerraMesa($request, $response, $args){
        $parametro= $request->getParsedBody();
        
        if(Mesa::CerrarMesa($parametro['idMesa'])){
            $response->getBody()->write("Se Cerro la mesa");
        }

        return $response;
    }
    

}