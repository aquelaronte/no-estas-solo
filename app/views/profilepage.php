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

          if($_SESSION['user']['role'] == "estudiante"){
            echo "
              <li class=\"nav-item\">
                <a class=\"nav-link active\" href=\"quotes.php\"><i class=\"fa fa-file-invoice\"></i> Citas</a>
              </li>
            ";
          } elseif($_SESSION['user']['role'] == "psicólogo"){
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
<div class="container">
  <div class="row">
    <div class="col">
      <h1 class="text-center">
        ¡Bienvenido 
        <?php
          echo ucwords($_SESSION["user"]["name"]) . "!";
        ?>
      </h1>
    </div>
  </div>
</div>