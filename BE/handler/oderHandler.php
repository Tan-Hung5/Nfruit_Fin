<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class OderHandler {
    private $oderRepository;

    public function __construct(OderRepository $r) {
        $this->oderRepository = $r;
    }

    public function addOder(Request $request, Response $response, array $args): Response {
        $userId = $args['id'];
        $data = $request->getParsedBody();
        $date = date('Y-m-d H:i:s');
        $order = new Order(null,$userId,$data['total_amount'],$date,$data['order_items']);
        
        try {
            $this->oderRepository->addOrder($order);
            return $response->withJson(['message' => 'add success'],200);
        } catch (Exception $e) {
            return $response->withJson(['error'=>$e],400);
        }    
    } 

    public function getAllOrder(Request $request, Response $response, array $args): Response {
        try {
            $data = $this->oderRepository->getAllOrder();
            return $response->withJson($data);
        } catch (Exception $e) {
            return $response->withJson(['error'=>$e],400);
        }
    }

    public function getOrderByUserId(Request $request, Response $response, array $args): Response {
        $userId = $args['id'];
        try {
            $data = $this->oderRepository->getOderByUserId($userId);
            return $response->withJson($data);
        } catch (Exception $e) {
            return $response->withJson(['error'=>$e],400);
        }
    }

}
