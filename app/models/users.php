<?php
class UserModel
{
  private $con;
  private $table_name = "users";

  private function getConnection()
  {
    $host = "localhost";
    $pwd = "";
    $dbname = "no_estas_solo";
    $user = "root";
    $this->con = new PDO("mysql:host=$host;dbname=$dbname", $user, $pwd);
  }

  public function signup($name, $email, $password, $phone, $address, $grade, $role, $age, $description)
  {
    $this->getConnection();
    $sql = "
    INSERT INTO 
    $this->table_name(
      name, 
      email, 
      password, 
      phone, 
      address, 
      grade, 
      role, 
      age, 
      description
    ) VALUES (
      \"$name\",
      \"$email\",
      \"$password\",
      \"$phone\",
      \"$address\",
      \"$grade\",
      \"$role\",
      \"$age\",
      \"$description\"
    );
    ";

    $validationQuery = "SELECT * FROM $this->table_name WHERE email = \"$email\";";

    $validation = $this->con->query($validationQuery);

    if($validation->rowCount() >= 1){
      return "USUARIO YA REGISTRADO";
    }
    try {
      $this->con->query($sql);
    } catch (PDOException $e) {
      die("error sql: " . $e);
    } finally {
      $this->con = null;
    }
  }

  public function signin($email, $password)
  {
    $this->getConnection();

    $sql = "SELECT * FROM $this->table_name WHERE email = \"$email\" LIMIT 1;";
    $resultado = $this->con->query($sql);

    if ($resultado->rowCount() > 0)  { // si usuario si existe
      while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
        if ($password != $fila["password"]) {
          $this->con = null;
          return "INCORRECT PASSWORD";
        }
        $this->con = null;
        return $fila;
      }
    } else {
      $this->con = null;
      return "USER NOT FOUND";
    }
  }
}
