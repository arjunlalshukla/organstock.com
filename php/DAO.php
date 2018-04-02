<?php
require_once('./KLogger.php');

class DAO {

  private $host = "localhost";
  private $db = "organstock";
  private $user = "admin";
  private $pass = "password";
  protected $logger;

  public function __construct () {
    $this->logger = new KLogger('../log', KLogger::DEBUG);
  }

  private function getConnection () {
    try {
      $conn =
        new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user,
            $this->pass);
      $this->logger->logDebug("Established a database connection.");
      return $conn;
    } catch (Exception $e) {
      echo "connection failed: " . $e->getMessage();
      $this->logger->logFatal("The database connection failed.");
    }
  }
  
  private function username_is_physician($username) {
      $conn = $this->getConnection();
      $query = $conn->prepare("SELECT * FROM physician WHERE username = :username");
      $query->bindParam(':username', $username);
      $query->execute();
      $result = $query->fetchAll();
      return !empty($result);
  }
  
  private function username_is_buyer_seller($username) {
      $conn = $this->getConnection();
      $query = $conn->prepare("SELECT * FROM buyer_seller WHERE username = :username");
      $query->bindParam(':username', $username);
      $query->execute();
      $result = $query->fetchAll();
      return !empty($result);
  }
  
  public function username_is_valid($username){
      return !$this->username_is_physician($username) && !$this->username_is_buyer_seller($username);
  }
  
  public function password_is_valid($username, $password) {
      $conn = $this->getConnection();
      $query = $conn->prepare("SELECT * FROM buyer_seller WHERE username = :username AND password = :password");
      $query->bindParam(':username', $username);
      $query->bindParam(':password', $password);
      $query->execute();
      $result_buyer = $query->fetchAll();
      $conn = $this->getConnection();
      $query = $conn->prepare("SELECT * FROM physician WHERE username = :username AND password = :password");
      $query->bindParam(':username', $username);
      $query->bindParam(':password', $password);
      $query->execute();
      $result_physician = $query->fetchAll();
      return !empty($result_buyer) || !empty($result_physician);
  }
     
  public function create_buyer_seller ($username, $password, $email, $country, $image_path) {
     $conn = $this->getConnection();
     $query = $conn->prepare("INSERT INTO buyer_seller (physician, username, password, email, country, image_path) VALUES (:physician, :username, :password, :email, :country, :image_path)");
     $a = 0;
     $query->bindParam(':physician', $a);
     $query->bindParam(':username', $username);
     $query->bindParam(':password', $password);
     $query->bindParam(':email', $email);
     $query->bindParam(':country', $country);
     $query->bindParam(':image_path', $image_path);
     $this->logger->logDebug(__FUNCTION__ . " username=[{$username}] password=[{$password}] email=[{$email}] country=[{$country}] image_path=[{$image_path}]");
     $query->execute();
  }
  
  public function create_physician ($username, $password, $email, $country, $first_name, $last_name, $suffix, $degree, $agency, $license_num, $image_path) {
     $conn = $this->getConnection();
     $query = $conn->prepare("INSERT INTO physician (physician, username, password, email, country, first_name, last_name, suffix, degree, agency, license_num, image_path) VALUES (:physician, :username, :password, :email, :country, :first_name, :last_name, :suffix, :degree, :agency, :license_num, :image_path)");
     $a = 1;
     $query->bindParam(':physician', $a);
     $query->bindParam(':username', $username);
     $query->bindParam(':password', $password);
     $query->bindParam(':email', $email);
     $query->bindParam(':country', $country);
     $query->bindParam(':first_name', $first_name);
     $query->bindParam(':last_name', $last_name);
     $query->bindParam(':suffix', $suffix);
     $query->bindParam(':degree', $degree);
     $query->bindParam(':agency', $agency);
     $query->bindParam(':license_num', $license_num);
     $query->bindParam(':image_path', $image_path);
     $this->logger->logDebug(__FUNCTION__ . " username=[{$username}] password=[{$password}] email=[{$email}] country=[{$country}] first_name=[{$first_name}] last_name=[{$last_name}] suffix=[{$suffix}] degree=[{$degree}] agency=[{$agency}] license_num[{$license_num}] image_path=[{$image_path}]");
     $query->execute();
  }
  
  public function create_organ ($seller_username, $organ_type, $blood_type, $weight, $owner_dob, $description, $image_path) {
     $conn = $this->getConnection();
     $query = $conn->prepare("INSERT INTO cart (seller_username, organ_type, blood_type, weight, owner_dob, description, image_path) VALUES (:seller_username, :organ_type, :blood_type, :weight, :owner_dob, :description, :image_path)");
     $query->bindParam(':seller_username', $seller_username);
     $query->bindParam(':organ_type', $organ_type);
     $query->bindParam(':blood_type', $blood_type);
     $query->bindParam(':weight', $weight);
     $query->bindParam(':owner_dob', $owner_dob);
     $query->bindParam(':description', $descripion);
     $query->bindParam(':image_path', $image_path);
     $this->logger->logDebug(__FUNCTION__ . " seller_username=[{$seller_username}] organ_type=[{$organ_type}] blood_type=[{$blood_type}] weight=[{$weight}] owner_dob=[{$owner_dob}] image_path=[{$image_path}]");
     $query->execute();
  }
  
  public function remove_organ ($organ_id) {
     $conn = $this->getConnection();
     $query = $conn->prepare("DELETE FROM cart WHERE organ_id = :organ_id");
     $query->bindParam(':organ_id', $organ_id);
     $this->logger->logDebug(__FUNCTION__ . ": cart : organ_id=[{$organ_id}]");
     $query->execute();
     $conn = $this->getConnection();
     $query = $conn->prepare("DELETE FROM organ WHERE id = :organ_id");
     $query->bindParam(':organ_id', $organ_id);
     $this->logger->logDebug(__FUNCTION__ . ": organ : organ_id=[{$organ_id}]");
     $query->execute();
  }
  
  public function add_to_cart ($username, $organ_id) {
     $conn = $this->getConnection();
     $query = $conn->prepare("INSERT INTO cart (buyer_username, organ_id) VALUES (:buyer_username, :organ_id)");
     $query->bindParam(':buyer_username', $buyer_username);
     $query->bindParam(':organ_id', $organ_id);
     $this->logger->logDebug(__FUNCTION__ . " buyer_username=[{$username}] organ_id=[{$organ_id}]");
     $query->execute();
  }

  public function remove_from_cart ($username, $organ_id) {
     $conn = $this->getConnection();
     $query = $conn->prepare("DELETE FROM cart WHERE buyer_username = :username AND organ_id = :organ_id");
     $query->bindParam(':buyer_username', $buyer_username);
     $query->bindParam(':organ_id', $organ_id);
     $this->logger->logDebug(__FUNCTION__ . " buyer_username=[{$username}] organ_id=[{$organ_id}]");
     $query->execute();
  }
}
