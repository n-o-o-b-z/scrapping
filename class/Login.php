<?php

class Login {
    private $email;
    private $password;
    private $loggedIn;

    public function __construct($email, $password) {
        $this->email = $email;
        $this->password = $password;
        $this->loggedIn = false;
    }

    public function validateCredentials($db_email, $db_password) {
        if ($this->email === $db_email && $this->password === $db_password) {
            $this->loggedIn = true;
            return true;
        } else {
            return false;
        }
    }

    public function isLoggedIn() {
        return $this->loggedIn;
    }
}

// $login = new Login("email", "password");
// if ($login->validateCredentials("email", "password")) {
//     echo "Login successful!";
// } else {
//     echo "Invalid email or password.";
// }
?>
