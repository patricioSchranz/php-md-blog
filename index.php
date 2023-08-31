<?php 
require __DIR__ . '/init.php'; 

$pathInfo = $_SERVER['PATH_INFO'];

header("Location: index");

$routes = [
    '/index' => [
        'controller' => 'postsController',
        'index'
    ]
];

if (!isset($routes[$pathInfo])){
    $route = $routes[$pathInfo];
    $controller = $container->make($route['controller']);
    $method = $route['method'];
    $controller->$method();
}






