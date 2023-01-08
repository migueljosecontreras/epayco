<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('recharge', 'RechargeController@index');
$router->post('recharge', 'RechargeController@store');
