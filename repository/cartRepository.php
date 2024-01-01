<?php

class CartRepository {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Lấy thông tin của một giỏ hàng theo user_id
    public function getCartByUserId($userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM carts WHERE user_id = ?");
        $stmt->execute([$userId]);
        $cartData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$cartData) {
            return null; // Giỏ hàng không tồn tại
        }

        // Decode JSON để lấy mảng items
        $cartData['items'] = json_decode($cartData['items'], true);

        // Tạo đối tượng Cart từ dữ liệu cơ sở dữ liệu
        $cart = new Cart();
        $cart->id = $cartData['cart_id'];
        $cart->user_id = $cartData['user_id'];
        $cart->items = $cartData['items'];

        return $cart;
    }

    public function addItemToCart($userId, $newItem) {
        $cart = $this->getCartByUserId($userId);

        if ($cart) {
            $items = $cart->items;
            $items[] = $newItem;

            $stmt = $this->pdo->prepare("UPDATE carts SET items = ? WHERE user_id = ?");
            $stmt->execute([json_encode($items), $userId]);
        }
    }


    public function updateItem($userId, $newItem) {
        $cart = $this->getCartByUserId($userId);

        if ($cart) {
            $items = $cart->items;
            $items[] = $newItem;

            $stmt = $this->pdo->prepare("UPDATE carts SET items = ? WHERE user_id = ?");
            $stmt->execute([json_encode($items), $userId]);
        }
    }
    // Xóa một item từ trường items của giỏ hàng
    public function removeItemFromCart($userId, $productId) {
        $cart = $this->getCartByUserId($userId);

        if ($cart) {
            $items = $cart->items;

            foreach ($items as $key => $item) {
                if ($item['product_id'] == $productId) {
                    unset($items[$key]);
                    break;
                }
            }

            $stmt = $this->pdo->prepare("UPDATE carts SET items = ? WHERE user_id = ?");
            $stmt->execute([json_encode(array_values($items)), $userId]);
        }
    }

    // Lấy tất cả các item từ trường items của giỏ hàng
    public function getAllItemsInCart($userId) {
        $cart = $this->getCartByUserId($userId);

        if ($cart) {
            return $cart->items;
        }

        return [];
    }

    // Các phương thức khác

}