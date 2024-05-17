<?php
class Connection {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;
    private static $instance = null;

    private function __construct($servername, $username, $password, $dbname) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->connect();
    }

    private function connect() {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function getInstance($servername = 'localhost', $username = 'root', $password = '', $dbname = 'scrapping') {
        if (self::$instance == null) {
            self::$instance = new Connection($servername, $username, $password, $dbname);
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn = null;
    }
}
?>
