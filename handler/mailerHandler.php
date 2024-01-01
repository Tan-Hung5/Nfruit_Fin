<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
class MailerHandler {
    private $mailer;
    public function __construct(MyMailer $mailer){
        $this->mailer = $mailer;
    }
    public function sendMailActiveCode(Request $request, Response $response,array $args): Response{
        $data = $request->getParsedBody();
        $email = $data['email'];
        $code = $this->genCode();
        $this->mailer->sendActiveCode($code,$email);
        return $response->withJson(["code"=>$code],200);
    }

    private function genCode() {
        $code = rand(111111,999999);
        return $code;
    }  
}