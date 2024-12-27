<?php

require_once 'app/controllers/AuthController.php';


$router->post('/auth/login', [AuthController::class, 'login']);
$router->post('/auth/register', [AuthController::class, 'register']);
// $router->post('/auth/logout', [AuthController::class, 'logout']);