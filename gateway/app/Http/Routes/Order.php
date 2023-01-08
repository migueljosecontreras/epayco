<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('order', 'OrderController@index');
$router->post('order', 'OrderController@store');
$router->post('order/complete', 'OrderController@complete');
