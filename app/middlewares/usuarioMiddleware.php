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
        $metodo = $request->getUri()->getPath();
        
        //TODO VERIFICAR EL METODO Y PATH QUE SE ESTA SOLICITANDO PARA VERIFICAR SI EL USUARIO TIENE PERMISOS

        if (Usuario::verificarRolUsuario($nombreUsuario,"Socio")){
            $response = $handler->handle($request);
        }
        else{
            $response = new Response();
            $response->getBody()->write(json_encode(array("error" => "El usuario no es un socio")));
            return $response;
        }


        return $response;
    }
} 

