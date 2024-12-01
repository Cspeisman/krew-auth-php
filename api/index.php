<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

// Add error middleware
$app->addErrorMiddleware(true, true, true);

// Add route
// Define your routes here
$app->get('/', function ($request, $response) {
    $response->getBody()->write('Hello from Slim on Vercel!');
    return $response;
});

$app->get('/hello', function (Request $request, Response $response, array $args) {
    $queryParams = $request->getQueryParams();
    $name = $queryParams['name'] ?? 'World';

    $data = [
        'hello' => $name,
        'name' => $name
    ];

    $response->getBody()->write(json_encode($data));
    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

$app->run();
