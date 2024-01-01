<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ProductHandler {
    private $productsRepository;

    public function __construct(ProductsRepository $productsRepository) {
        $this->productsRepository = $productsRepository;
    }

    public function getAllProducts(Request $request, Response $response): Response {
        $products = $this->productsRepository->getAllProducts();
        return $response->withJson($products);
    }

    public function getProduct(Request $request, Response $response, array $args): Response {
        $productId = $args['id'];
        $product = $this->productsRepository->getProductById($productId);

        if ($product) {
            return $response->withJson($product);
        } else {
            return $response->withJson(['error' => 'Product not found'], 404);
        }
    }


    public function addProduct(Request $request, Response $response): Response {
        $data = $request->getParsedBody();
        $product = new Product(null,$data['product_name'],$data['price'],$data['img']);
        if (!empty($data['product_name']) && !empty($data['price']) && !empty($data['img'])) {
            $this->productsRepository->addProduct($product);
            return $response->withJson(['message' => 'User created successfully'],200);
        } else {
            return $response->withJson(['error' => 'Invalid data'], 400);
        }
    }


    public function deleteProduct(Request $request, Response $response, array $args): Response {
        $productId = $args['id'];
        $this->productsRepository->deleteProduct($productId);
        return $response->withJson(['message' => 'product deleted successfully'],200);
    }
}
