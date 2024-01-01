<?php

class User {
    public $id;
    public $username;
    public $email;
    public $phone;
    public $role;
    public $create_at;
    public $password;

    public function __construct($id, $username, $email, $phone, $password, $role, $date) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->phone = $phone;
        $this->role = $role;
        $this->password = $password;
        $this->create_at = $date;

    }

   
}
