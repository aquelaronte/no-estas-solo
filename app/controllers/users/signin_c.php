<?php
$email = $_POST["email"];
$password = $_POST["password"];

require_once "../../models/users.php";

$usersModel = new UserModel();

$response = $usersModel->signin($email, $password);

if($response == "USER NOT FOUND"){
  header("Location: ../../../public/signin.php?message=email-no-registrado");
}elseif($response == "INCORRECT PASSWORD"){
  header("Location: ../../../public/signin.php?message=contraseña-incorrecta");
}else{
  session_start();
  $_SESSION["user"] = $response;
  header("Location: ../../../public");
}
