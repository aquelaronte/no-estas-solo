<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">No estás solo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php
        session_start();

        if (isset($_SESSION['user'])) {
          echo "
            <li class=\"nav-item\">
              <a class=\"nav-link active\" href=\"index.php\"><i class=\"fa fa-home\"></i> Inicio</a>
            </li>
          ";

          echo "
            <li class=\"nav-item\">
              <a class=\"nav-link active\" href=\"notes.php\"><i class=\"fa fa-book\"></i> Notas</a>
            </li>
          ";

          echo "
            <li class=\"nav-item\">
              <a class=\"nav-link active\" href=\"profile.php\"><i class=\"fa fa-user\"></i> Perfil</a>
            </li>
          ";

          if ($_SESSION['user']['role'] == "estudiante") {
            echo "
              <li class=\"nav-item\">
                <a class=\"nav-link active\" href=\"quotes.php\"><i class=\"fa fa-file-invoice\"></i> Citas</a>
              </li>
            ";
          } elseif ($_SESSION['user']['role'] == "psicólogo") {
            echo "
            <li class=\"nav-item\">
              <a class=\"nav-link active\" href=\"quotes_p.php\"><i class=\"fa fa-file-invoice\"></i> Citas</a>
            </li>
            ";
          }

          echo "
            <li class=\"nav-item\">
              <a class=\"nav-link active\" href=\"aboutus.php\"><i class=\"fa fa-users\"></i> Sobre nosotros</a>
            </li>
          ";

          echo "
          <li class=\"nav-item\">
            <a class=\"nav-link active\" href=\"tips.php\"><i class=\"fa fa-message\"></i> Consejos</a>
          </li>
          ";

          echo "
            <li class=\"nav-item\">
              <a class=\"nav-link active\" href=\"../app/controllers/users/closeSession_c.php\"><i class=\"fa-solid fa-right-from-bracket\"></i> Cerrar sesión</a>
            </li>
          ";
        } else {
          echo "
            <li class=\"nav-item\">
              <a class=\"nav-link active\" href=\"index.php\"><i class=\"fa fa-home\"></i> Inicio</a>
            </li>
            <li class=\"nav-item\">
              <a class=\"nav-link active\" href=\"signin.php\"><i class=\"fa fa-user\"></i> Iniciar Sesión</a>
            </li>
            <li class=\"nav-item\">
              <a class=\"nav-link active\" href=\"signup.php\"><i class=\"fa fa-file-invoice\"></i> Crear cuenta</a>
            </li>
            <li class=\"nav-item\">
              <a class=\"nav-link active\" href=\"aboutus.php\"><i class=\"fa fa-users\"></i> Sobre nosotros</a>
            </li>
          ";
        }
        ?>
      </ul>
    </div>
  </div>
</nav>
<form action="../app/controllers/users/signin_c.php" method="post">
  <div class="container">
    <div class="row">
      <div class="col d-flex flex-column align-items-center mb-4">
        <h1>Inicia sesión</h1>
        <p>Accede a tu cuenta</p>
      </div>
    </div>
    <div class="row d-flex justify-content-center">
      <div class="col-5">
        <div class="form-floating mb-2">
          <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" required>
          <label for="floatingInput">Correo eletrónico</label>
        </div>
      </div>
    </div>
    <div class="row d-flex justify-content-center">
      <div class="col-5">
        <div class="form-floating mb-2">
          <input type="password" class="form-control" id="floatingInput" placeholder="name@example.com" name="password" required>
          <label for="floatingInput">Contraseña</label>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <?php
        if (isset($_GET["message"])) {
          echo "
            <div class=\"alert alert-danger\" role=\"alert\">
              $_GET[message]
            </div>
          ";
        }
        ?>
      </div>
    </div>
    <div class="row">
      <div class="col d-flex justify-content-center">
        <button type="submit" class="btn btn-primary btn-lg mt-4">Siguiente</button>
      </div>
    </div>
  </div>
</form>