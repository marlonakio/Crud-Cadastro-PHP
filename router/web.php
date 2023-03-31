<?php
use App\Controllers\UserController;


$app->get('/', UserController::class.':index');
$app->get('/edit/{id}', UserController::class.':show');
$app->post('/createOrUpdate', UserController::class.':createOrUpdate');
$app->get('/del/{id}', UserController::class.':destroy');

