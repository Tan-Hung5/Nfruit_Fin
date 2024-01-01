<?php
require 'Mailer/sendMail.php';

class OderRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function addOrder(Order $order) { 
        $items = $order->order_items;
        $stmt = $this->pdo->prepare("INSERT INTO orders (user_id, total_amount, order_date, order_items, status) VALUES ( ?, ?, ?, ?, ? )");
        $stmt->execute([$order->user_Id, $order->total_amount, $order->order_date,json_encode($items),'confirming order']);
        $r = new UserRepository($this->pdo);
        $email = $r->getEmailUser($order->user_Id);
        $email = $email['email'];
        $mail = new MyMailer;
        $mail->sendMailConfirmOrder($order, $email);
    }
    public function getAllOrder() {
        $stmt = $this->pdo->prepare("SELECT * FROM orders");
        $stmt->execute();
        $orders = [];

        while($data = $stmt->fetch(PDO ::FETCH_ASSOC)){
            $orders[] = new Order($data['order_id'],$data['user_id'],$data['total_amount'],$data['order_date'],$data['order_items']); 
        }
        return $orders;

    }

    public function getOderByUserId($user_Id) {
        $stmt = $this->pdo->prepare("SELECT * FROM orders WHERE user_id = ?");
        $stmt->execute([$user_Id]);
        $order = [];
       while($data = $stmt->fetch(PDO :: FETCH_ASSOC)){
        $data['order_items'] = json_decode($data['order_items'],true);
        $order[] = new Order($data['order_id'],$data['user_id'],$data['total_amount'],$data['order_date'],$data['order_items']);
       }
        return $order;
    }
}
