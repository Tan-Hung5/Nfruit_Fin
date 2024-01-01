<?php

class UserRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function createUser(User $user) {
        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, phone, password, create_at) VALUES (?, ?, ?, ?, ?)");
        $password = password_hash($user->password,PASSWORD_DEFAULT);
        $stmt->execute([$user->username, $user->email, $user->phone, $password, $user->create_at]);
        $stmt = $this->pdo->prepare("INSERT INTO carts (user_id, create_at) VALUES (LAST_INSERT_ID(), ? )");
        $stmt->execute([$user->create_at]);
    }

    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null; // User not found
        }

        return new User($data['id'], $data['username'], $data['email'],$data['phone'],null,$data['role'],$data['create_at']);
    }

    public function getIdUserByEmail($email){
        $stmt = $this->pdo->prepare("SELECT id FROM users WHERE email =  ?  ");
        $stmt->execute([$email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return 'not found';
        }
        return $data;
    }

    public function auth($userEmail,$userPassword){
        $userId = $this->getIdUserByEmail($userEmail);
        if (!isset($userId)){
            return false;
        }else{
            $stmt = $this->pdo->prepare("SELECT password FROM users WHERE id = ?");
            $stmt->execute([$userId]);
            $password = $stmt->fetch(PDO :: FETCH_ASSOC);
            if(password_verify($password,$userPassword)){
                return true;
            }else{
                return false;
            }
        }    
    }

    public function updateUser($id, $username, $email) {
        $stmt = $this->pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
        $stmt->execute([$username, $email, $id]);
    }

    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT * FROM users");
        $users = [];

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = new User($data['id'], $data['username'], $data['email'],$data['phone'],null, $data['role'],$data['create_at']);
        }

        return $users;
    }

    public function getEmailUser($user_Id){
        $stmt = $this->pdo->prepare("SELECT email FROM users WHERE id = ?");
        $stmt->execute([$user_Id]);
        $email = $stmt->fetch(PDO ::FETCH_ASSOC);
        return $email;
    }
}
