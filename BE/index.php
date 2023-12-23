<?php

require_once './config.php';
require_once './database/connect.php';
require_once './model/usersmodel.php';
require_once './model/productsModel.php';
require_once './model/cartModel.php';
require_once './repository/productsRepository.php';
require_once './repository/usersRepository.php';
require_once './repository/cartRepository.php';
require_once './handler/usershandler.php';
require_once './handler/productHandler.php';
require_once './handler/cartHandler.php';
require 'vendor/autoload.php';

header('Content-Type: application/json');

use Slim\Factory\AppFactory;


$pdo = connectToDatabase();


$app = AppFactory::create();


// api user
$userRepository = new UserRepository($pdo);
$userHandler = new UserHandler($userRepository);
$app->get('/api/v1/users', [$userHandler, 'getAllUsers']);
$app->get('/api/v1/user/{id}', [$userHandler, 'getUser']);
$app->post('/api/v1/user/auth',[$userHandler,'auth']);
$app->post('/api/v1/IDuser',[$userHandler,'getIdUser']);
$app->post('/api/v1/users', [$userHandler, 'createUser']);
$app->put('/api/v1/user/{id}', [$userHandler, 'updateUser']);
$app->delete('/api/v1/user/{id}', [$userHandler, 'deleteUser']);




//api product
$productRepository = new ProductsRepository($pdo);
$productHandler = new ProductHandler($productRepository);
$app->get('/api/v1/products',[$productHandler,'getAllProducts']);
$app->get('/api/v1/product/{id}',[$productHandler,'getProduct']);
$app->post('/api/v1/product/add',[$productHandler,'addProduct']);
$app->delete('/api/v1/product/{id}',[$productHandler,'deleteProduct']);

//api cart
$cartrepository = new CartRepository($pdo);
$cartHandler = new CartHandler($cartrepository);
$app->get('/api/v1/cart/{id}',[$cartHandler,'getAllItem']);
$app->post('/api/v1/cart/{id}',[$cartHandler,'addItem']);
$app->delete('/api/v1/cart/{id}',[$cartHandler,'deleteItem']);
$app->put('/api/v1/cart/{id}',[$cartHandler,'updateItem']);

// Run Slim application
$app->run();