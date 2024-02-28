<?php
ob_start();
require_once '../model/addAdmins_model.php';

class UserController {
    public function create() {
      if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $hash_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  
        $user = new User($name, $email, $hash_password);
        if ($user->save()) {
          echo "Admin added successfully.";
          header('Location: ../admin/manageAdmins.php');
        } else {
          echo "Error adding admin.";
        }
      }
    }
  }
  
  $userController = new UserController();
  $userController->create();
  
?>