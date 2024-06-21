<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

class usuarioMiddleware
{
    public function __invoke(Request $request, RequestHandler $handler): ResponseInterface
    {
        $params = $request->getQueryParams();
        $nombreUsuario = $params['usuario'];
        $ruta = $request->getUri()->getPath();
        $rolUsuario = Usuario::obtenerRolPorUsuario($nombreUsuario);

        if($ruta == "/pedido/modificacion" && $request->getMethod() == "POST")
        {
            if($rolUsuario == "Cocinero" || $rolUsuario == "Bartender" || $rolUsuario == "Cervecero" || $rolUsuario == "Mozo")
            {
                $response = $handler->handle($request);
            }
            else
            {
                $response = new Response();
                $response->getBody()->write(json_encode(array("error" => "El usuario no tiene permiso")));
                return $response->withHeader('Content-Type', 'application/json');
            }
        }
        elseif ($ruta == '/pedido/alta' && $request->getMethod() == 'POST')
        {
            if($rolUsuario == "Mozo")
            {
                $response = $handler->handle($request);
            }
            else
            {
                $response = new Response();
                $response->getBody()->write(json_encode(array("error" => "El usuario no tiene permiso")));
                return $response->withHeader('Content-Type', 'application/json');
            }
        }
        elseif($ruta == '/pedido/' && $request->getMethod() == 'GET')
        {
            if($rolUsuario == "Cocinero" || $rolUsuario == "Bartender" || $rolUsuario == "Cervecero" || $rolUsuario == "Mozo" || $rolUsuario == "Socio")
            {
                $response = $handler->handle($request);
            }
            else
            {
                $response = new Response();
                $response->getBody()->write(json_encode(array("error" => "El usuario no tiene permiso")));
                return $response->withHeader('Content-Type', 'application/json');
            }
        }
        return $response;
        
        //TODO PROFUNDIZAR EL PATH QUE SE ESTA SOLICITANDO PARA VERIFICAR SI EL USUARIO TIENE PERMISOS


    }
} 

