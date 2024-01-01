<?php

class Order {
    public $id;
    public $user_Id;
    public $total_amount;
    public $order_date;
    public $status;
    public $order_items;
    public function __construct($order_id,$user_Id, $total_amount, $order_date,$order_items) {
        $this->id = $order_id;
        $this->user_Id = $user_Id;
        $this->order_date =  $order_date;
        $this->total_amount = $total_amount;
        $this->order_items = $order_items;
        $this->status = 'confirming the order';
    }
}

