<?php
class User {
  private $name;
  private $email;
  private $hash_password;
  
  public function __construct($name, $email, $hash_password) {
    $this->name = $name;
    $this->email = $email;
    $this->hash_password = $hash_password;
  }
  public function getName() {
    return $this->name;
  }

  public function setName($name) {
    $this->name = $name;
  }

  public function getEmail() {
    return $this->email;
  }

  public function setEmail($email) {
    $this->email = $email;
  }

  public function getHashPassword() {
    return $this->hash_password;
  }

  public function setHashPassword($hash_password) {
    $this->hash_password = $hash_password;
  }

  public function save() {
    try {
      $conn = new PDO("mysql:host=db;dbname=cars", "student", "student");
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("INSERT INTO users (name, email, hash_password) VALUES (:name, :email, :hash_password)");
      $stmt->bindParam(':name', $this->name);
      $stmt->bindParam(':email', $this->email);
      $stmt->bindParam(':hash_password', $this->hash_password);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }
}
?>