<?php

class Product {
    public $id;
    public $name;
    public $price;
    public $img;
    
    public function __construct($id,$name, $price, $img){
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->img = $img;
    }
}