<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CartHandler {
    public $CartRepository;

    public function __construct(CartRepository $r) {
        $this->CartRepository = $r;
    }

    public function getAllItem(Request $request, Response $response,array $args): Response {

        $userId = $args['id'];
        $items = $this->CartRepository->getAllItemsInCart($userId);

        if ($items) {
            return $response->withJson($items);
        }else{
            return $response->withStatus(400);
        }
    }

    public function addItem(Request $request, Response $response,array $args): Response {
        $userId = $args['id'];
        $data = $request->getParsedBody();
        $newItem = new CartItem($data['product_id'],$data['product_name'],$data['price'],$data['img'],$data['quantity']);
        
        if(!empty($newItem->img) && !empty($newItem->product_id) && !empty($newItem->product_name) && !empty($newItem->price) && !empty($newItem->quantity)) {
            $this->CartRepository->addItemToCart($userId, $newItem);
            return $response->withJson(['message' => 'add success']);
        }else {
            return $response->withJson(['error' => 'data invalid']);
        }
           
    }

    public function deleteItem(Request $request, Response $response,array $args): Response {
        $userId = $args['id'];
        $data = $request->getParsedBody();
        $product_id = $data['product_id'];
        $this->CartRepository->removeItemFromCart($userId, $product_id);
        return $response->withJson('delete success',200);
    }

    public function updateItem(Request $request, Response $response,array $args): Response {
        $userId = $args['id'];
        $data = $request->getParsedBody();
        $newItem = new CartItem($data['product_id'],$data['product_name'],$data['price'],$data['img'],$data['quantity']);
        
        if(!empty($newItem->img) && !empty($newItem->product_id) && !empty($newItem->product_name) && !empty($newItem->price) && !empty($newItem->quantity)) {
            $this->CartRepository->updateItem($userId, $newItem);
            return $response->withJson('add success',200);
        }else {
            return $response->withJson('data invalid', 400);
        }
    }

}