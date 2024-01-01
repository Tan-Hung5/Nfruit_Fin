<?php
require_once 'bodyMail.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class MyMailer {
    private $mail;

    public function __construct() {
        // Tạo một đối tượng PHPMailer
        $this->mail = new PHPMailer(true); 
    }

    private function setSMTPConfig() {
        $this->mail->isHTML(true);
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'siwkp15@gmail.com';
        $this->mail->Password = 'loza kkae tijh pqds';
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mail->Port = 465; // Hoặc 465 nếu sử
        $this->mail->setFrom('siwkp15@gmail.com', 'Nfruit');
        
    }

    
    private function addRecipient($email) {
        // Thêm người nhận
        $this->mail->addAddress($email);
    }


    private function setBody($body) {
        $this->mail->Body = $body; 
    }

    private function send() {
        try {
            // Gửi email
            $this->mail->send();
        } catch (Exception $e) {
            
        }

    }

    public function sendMailConfirmOrder(Order $order,$email = ''){
        $body = bodyConfirmOrder($order);
        $this->mail->Subject = 'Confirm Order';
        $this->setSMTPConfig();
        $this->setBody($body);
        $this->addRecipient($email);
        $this->send();
    }
    public function sendActiveCode($code,$email){
        $this->mail->Subject = 'Authentify Code';
        $body = bodyMailActiveCode($code);
        $this->setSMTPConfig();
        $this->setBody($body);
        $this->addRecipient($email);
        $this->send();
    }
}

?>