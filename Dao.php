<?php
require_once 'KLogger.php';
class Dao {
    private $host = "kil9uzd3tgem3naa.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
    private $db = "sw9zpm1zncu5iflq";
    private $user = "emt6arfw11s5ddtf";
    private $pass = "foyv6bq9jt73jf9a";
    private $logger;

    public function __construct() {
        $this->logger = new KLogger("log.txt", KLogger::WARN);
    }

    public function getConnection() {
        try {
            $connection = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
        } catch (Exception $e) {
            $this->logger->LogError("Couldn't connect to the database: " . $e->getMessage());
            return null;
        }
        return $connection;
    }

    public function getUser($username, $email){
        $conn = $this->getConnection();
        if(is_null($conn)) {
            return;
        }
        try {
            $user = $conn->query("select * from user where username='$username' or email = '$email' limit 1", PDO::FETCH_ASSOC);
            return $user;
        } catch(Exception $e) {
            echo print_r($e,1);
            exit;
        }
    }


    public function getLoginUser($username, $password){
        $conn = $this->getConnection();
        if(is_null($conn)) {
            return;
        }
        try {
            $user = $conn->query("select * from user where (username='$username' or email='$username') and pass = '$password' limit 1", PDO::FETCH_ASSOC);
            return $user;
        } catch(Exception $e) {
            echo print_r($e,1);
            exit;
        }
    }

    public function saveUser($email, $username, $password, $admin){
        $conn = $this->getConnection();
        $saveQuery = "insert into user (email, username, pass, is_admin) value (:email, :username, :password, :admin)";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":email", $email);
        $q->bindParam(":username", $username);
        $q->bindParam(":password", $password);
        $q->bindParam(":admin", $admin);
        $q->execute();
    }

    public function saveTrade($coin, $price, $amount, $difference, $money){
        $conn = $this->getConnection();
        $saveQuery = "insert into trade (currency, price, date, amount, difference, money_added) value (:coin, :price, now(), :amount, :difference, :money)";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":coin", $coin);
        $q->bindParam(":price", $price);
        $q->bindParam(":amount", $amount);
        $q->bindParam(":difference", $difference);
        $q->bindParam(":money", $money);
        $q->execute();
    }

    public function getRecentTrades(){
        $conn = $this->getConnection();
        if(is_null($conn)) {
            return;
        }
        try {
            $stmt = $conn->query("select * from trade order by date desc limit 5", PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch(Exception $e) {
            echo print_r($e,1);
            exit;
        }
    }

    public function getAllTrades(){
        $conn = $this->getConnection();
        if(is_null($conn)) {
            return;
        }
        try {
            $stmt = $conn->query("select * from trade order by date desc", PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch(Exception $e) {
            echo print_r($e,1);
            exit;
        }
    }
}