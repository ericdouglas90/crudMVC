<?php
use core\Router;

$router = new Router();



$router->get('/', 'HomeController@index');

$router->get('/novo', 'UsuarioController@add');
$router->post('/novo', 'UsuarioController@addAction');

$router->get('/usuario/{id}/edit', 'UsuarioController@edit');
$router->post('/usuario/{id}/edit', 'UsuarioController@editAction');

$router->get('/usuario/{id}/delete', 'UsuarioController@delete');