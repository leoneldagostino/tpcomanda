<?php
// Error Handling
error_reporting(-1);
ini_set('display_errors', 1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Slim\Routing\RouteContext;

require __DIR__ . '/../vendor/autoload.php';

require_once './db/AccesoDatos.php';
// require_once './middlewares/Logger.php';

// llamado de MW

require_once './middlewares/usuarioMiddleware.php';

//llamado modelos

require_once './controllers/UsuarioController.php';
require_once './controllers/ProductoController.php';
require_once './controllers/MesaController.php';
require_once './controllers/PedidoController.php';
require_once './controllers/GuardarController.php';
require_once './controllers/CargarController.php';

// Load ENV
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Instantiate App
$app = AppFactory::create();

// Add error middleware
$app->addErrorMiddleware(true, true, true);

// Add parse body
$app->addBodyParsingMiddleware();

// Routes
$app->group('/usuarios', function (RouteCollectorProxy $group) {
    $group->get('[/]', \UsuarioController::class . ':TraerTodos');
    $group->get('/{usuario}', \UsuarioController::class . ':TraerUno');
    $group->post('/alta', \UsuarioController::class . ':CargarUno');
  });

$app->group('/productos', function (RouteCollectorProxy $group) {
  $group->get('/{id}', \ProductoController::class . ':TraerUno');
  $group->get('[/]', \ProductoController::class . ':TraerTodos');
  $group->post('/alta', \ProductoController::class . ':CargarUno');
  });

$app->group('/mesa', function (RouteCollectorProxy $group) {
  $group->get('[/]', \MesaController::class . ':TraerTodos'); 
  $group->post('/alta', \MesaController::class . ':CargarUno'); 

});

$app->group('/pedido', function (RouteCollectorProxy $group) {
  $group->get('[/]', \PedidoController::class . ':TraerTodos')->add(new usuarioMiddleware()); 
  $group->post('/alta', \PedidoController::class . ':CargarUno')->add(new usuarioMiddleware()); 
  $group->post('/modificacion', \PedidoController::class . ':ModificarUno')->add(new usuarioMiddleware());

});

$app->group('/guardar', function (RouteCollectorProxy $group){
  $group->post('/usuarios', \GuardarController::class . ':GuardarUsuarios');
  $group->post('/mesas', \GuardarController::class . ':GuardarMesas');
  $group->post('/pedidos', \GuardarController::class . ':GuardarPedidos');
  $group->post('/productos', \GuardarController::class . ':GuardarProductos');
});

$app->group('/cargar', function (RouteCollectorProxy $group){
  $group->post('/usuarios', \CargarController::class . ':cargarUsuarios');
  $group->post('/mesas', \CargarController::class . ':cargarMesa');
  $group->post('/pedidos', \CargarController::class . ':cargarPedidos');
  $group->post('/productos', \CargarController::class . ':cargarProductos');
});

$app->get('[/]', function (Request $request, Response $response) {    
    $payload = json_encode(array("mensaje" => "Slim Framework 4 PHP"));
    
    $response->getBody()->write($payload);
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();
