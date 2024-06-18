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
        if (isset($params['usuario'])){
            $response = $handler->handle($request);
        }
        else{
            $response = new Response();
            $response->getBody()->write(json_encode(array("error" => "No se ha ingresado un usuario")));
            return $response;
        }


        return $response;
    }
} 
?>
