<?php
$firstName = $_POST["first-name"];
$firstLastname = $_POST["first-lastname"];
$secondLastname = $_POST["second-lastname"];

if (isset($_POST["second-name"])) {
  $secondName = $_POST["second-name"];

  $name = "$firstName $secondName $firstLastname $secondLastname";
} else {
  $name = "$firstName $firstLastname $secondLastname";
}

$email = $_POST["email"];
$password = $_POST["password"];
$verifyEmail = $_POST["verifyEmail"];
$verifyPassword = $_POST["verifyPassword"];

if ($email != $verifyEmail) {
  header("Location: ../../../public/signup.php?message=correos-no-coinciden");
}

if($password != $verifyPassword){
  header("Location: ../../../public/signup.php?message=contraseñas-no-coinciden");
}

$phone = $_POST["phone"];
$address = $_POST["address"];
$grade = $_POST["grade"];
$role = $_POST["role"];

if($role == "default"){
  header("Location: ../../../public/signup.php?message=seleccione-un-rol");
}
if($grade == "default"){
  header("Location: ../../../public/signup.php?message=seleccione-un-grado");
}

$age = $_POST["age"];
$description = $_POST["description"];

include_once "../../models/users.php";

$usersModel = new UserModel();

$results = $usersModel->signup($name, $email, $password, $phone, $address, $grade, $role, $age, $description);

if($results == "USUARIO YA REGISTRADO"){
  header("Location: ../../../public/signup.php?message=usuario-ya-registrado");
} else {
  header("Location: ../../../public/signin.php");
}

