<?php
require_once('./KLogger.php');

class DAO {
  const HEROKU = false;
  private $host = self::HEROKU ? "us-cdbr-iron-east-05.cleardb.net" : "localhost";
  private $db = self::HEROKU ? "heroku_88fc211c7ca17ce" : "organstock";
  private $user = self::HEROKU ? "b8e721f1294c01" : "admin";
  private $pass = self::HEROKU ? "27de2751" : "password";
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
  
  public function get_user_info($username){
      $conn = $this->getConnection();
      $query = $conn->prepare("SELECT * FROM physician WHERE username = :username");
      $query->bindParam(':username', $username);
      $query->execute();
      $result = $query->fetchAll();
      if (!empty($result))
          return $result[0];
      $conn = $this->getConnection();
      $query = $conn->prepare("SELECT * FROM buyer_seller WHERE username = :username");
      $query->bindParam(':username', $username);
      $query->execute();
      $result = $query->fetchAll();
      if (!empty($result))
          return $result[0];
  }
  
  public function username_is_valid($username){
      return !$this->username_is_physician($username) && !$this->username_is_buyer_seller($username);
  }
  
  public function password_is_valid($username, $password) {
      $salt = '23efeaeat34tq3argafd';
      $password = md5($password . $salt);
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
     $salt = '23efeaeat34tq3argafd';
     $password = md5($password . $salt);
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
     $salt = '23efeaeat34tq3argafd';
     $password = md5($password . $salt);
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
  
  public function create_organ ($seller_username, $organ_type, $blood_type, $sex, $weight, $owner_dob, $price, $description, $image_path) {
     $conn = $this->getConnection();
     $query = $conn->prepare("INSERT INTO organ (seller_username, organ_type, blood_type, sex, weight, owner_dob, price, description, image_path) VALUES (:seller_username, :organ_type, :blood_type, :sex, :weight, :owner_dob, :price, :description, :image_path)");
     $query->bindParam(':seller_username', $seller_username);
     $query->bindParam(':organ_type', $organ_type);
     $query->bindParam(':blood_type', $blood_type);
     $query->bindParam(':sex', $sex);
     $query->bindParam(':weight', $weight);
     $query->bindParam(':owner_dob', $owner_dob);
     $query->bindParam(':price', $price);
     $query->bindParam(':description', $description);
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
  
  public function get_organ_info($organ_id){
      $conn = $this->getConnection();
      $query = $conn->prepare("SELECT * FROM organ WHERE id = :organ_id");
      $query->bindParam(':organ_id', $organ_id);
      $query->execute();
      $result = $query->fetchAll();
      if (!empty($result))
          return $result[0];
  }
  
  public function user_get_organs($username){
      $conn = $this->getConnection();
      $query = $conn->prepare("SELECT * FROM organ WHERE seller_username = :username");
      $query->bindParam(':username', $username);
      $query->execute();
      $result = $query->fetchAll();
      if (!empty($result))
          return $result;
  }
  
  public function organ_get_next_id(){
      $conn = $this->getConnection();
      $query = $conn->prepare("SHOW TABLE STATUS LIKE 'organ'");
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC)['Auto_increment'];
  }
  
  public function search_organs($organ_types, $blood_types, $sexes, $weight_low, $weight_up, $age_low, $age_up){
      $conn = $this->getConnection();
      $query = "SELECT * FROM organ WHERE (";
      foreach ($organ_types as $organ){
          if (end($organ_types) == $organ){
              $query .= " organ_type='$organ' ";
          } else {
              $query .= " organ_type='$organ' OR ";
          }
      }
      
      $query .= ") AND (";
      
      foreach ($blood_types as $blood){
          if (end($blood_types) == $blood){
              $query .= " blood_type='$blood' ";
          } else {
              $query .= " blood_type='$blood' OR ";
          }
      }
      
      $query .= ") AND (";
      
      foreach ($sexes as $sex){
          if (end($sexes) == $sex){
              $query .= " sex='$sex' ";
          } else {
              $query .= " sex='$sex' OR";
          }
      }
      
      $query .= " ) ";
      
      if ($weight_low != ""){
          $query .= " AND (weight >= $weight_low)";
      }
      if ($weight_up != ""){
          $query .= " AND (weight <= $weight_up)";
      }
      
      if ($age_low != ""){
          $time = strtotime("-$age_low year", time());
          $date = date("Y-m-d", $time);
          $query .= " AND (owner_dob <= '$date')";
      }
      if ($age_up != ""){
          $time = strtotime("-$age_up year", time());
          $date = date("Y-m-d", $time);
          $query .= " AND (owner_dob >= '$date')";
      }
      $query = $conn->prepare($query);
      $query->execute();
      return $query->fetchAll();
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
