<?php

class Cart {
    public $id;
    public $user_id;
    public $items = [];
    
    public function addItem(CartItem $item) {
        $this->items[] = $item;
    }

    public function updateItem($product_id, CartItem $updatedItem) {
        foreach ($this->items as $key => $item) {
            if ($item->product_id === $product_id) {
                $this->items[$key] = $updatedItem;
                break;
            }
        }
    }

    public function removeItem($product_id) {
        $this->items = array_filter($this->items, function ($item) use ($product_id) {
            return $item->product_id !== $product_id;
        });
    }
}

class CartItem {
    public $id;
    public $product_id;
    public $product_name;
    public $price;
    public $img;
    public $quantity;
    
    public function __construct($product_id, $product_name, $price, $img, $quantity) {
        $this->product_id = $product_id;
        $this->product_name = $product_name;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->img = $img;
    }

}