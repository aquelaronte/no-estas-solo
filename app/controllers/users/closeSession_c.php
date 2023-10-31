<?php
session_start();
if (isset($_SESSION['user'])) {
  session_unset();
  session_destroy();

  // Redirigir al usuario a la página de inicio de sesión u otra página
  header("Location: http://localhost/no%20estas%20solo/public/signin.php");
  exit();
} else {
  // Si el usuario no está autenticado, redirigirlo a la página de inicio de sesión
  header("Location: http://localhost/no%20estas%20solo/public/signin.php");
  exit();
}
