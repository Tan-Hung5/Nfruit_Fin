<?php

class ProductsRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function addProduct(Product $product) {
        $stmt = $this->pdo->prepare("INSERT INTO products (product_name, price,img) VALUES (?, ?, ?)");
        $stmt->execute([$product->name,$product->price,$product->img]);
    }

    public function getProductById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE product_id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null; // User not found
        }

        return new Product($data['product_id'],$data['product_name'],$data['price'],$data['img']);
    }

    public function deleteProduct($id) {
        $stmt = $this->pdo->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function getAllProducts() {
        $stmt = $this->pdo->query("SELECT * FROM products");
        $products = [];

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $products[] = new Product($data['product_id'],$data['product_name'],$data['price'],$data['img']); 
        }

        return $products;
    }
}
