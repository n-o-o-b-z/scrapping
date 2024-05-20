<?php

require_once 'Connection.php';

class Auth
{

    private $db;

    public function __construct(Connection $db)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->db = $db->getConnection();
    }

    public function login($email, $password)
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['logged_in'] = true;
            return true;
        }

        return false;
    }

    // public function isLoggedIn()
    // {
    //     return isset($_SESSION['user']);
    // }

    public function logout()
    {
        $_SESSION = [];
        unset($_SESSION['logged_in']);


        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();

        $this->db = null;
    }


    public function register($first_name, $last_name, $email, $password)
    {

        if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
            throw new Exception('All fields are required.');
        }
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)';
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);

        if ($stmt->execute()) {
            echo "Created successfully. Click <a href='../index.php'>here</a> to login.";
        } else {
            echo "Error: " . $stmt->errorInfo()[2];
        }
    }
}
