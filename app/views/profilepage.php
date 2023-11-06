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
<div class="container mt-3">
  <div class="row">
    <div class="col">
      <h1 class="text-center mb-4">Tu perfil</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-2">
      <img src="https://thumbs.dreamstime.com/b/foto-de-perfil-avatar-masculino-34443055.jpg" style="height: 150px; width: 150px; border-radius: 100%; border: 1px solid black;" alt="foto de perfil anónima">
    </div>
    <div class="col-4">
      <h3 class="mb-0">

        <?php
        echo $_SESSION["user"]["name"]
        ?>
      </h3>
      <p class="mb-0">
        <?php
        $role = "";

        if ($_SESSION["user"]["role"] == "estudiante") {
          $role = "Estudiante de grado " . $_SESSION["user"]["grade"];
        } else {
          $role = "Psicólogo";
        }
        echo $role;
        ?>
      </p>
      <p class="mt-3 mb-0">
        <strong>Teléfono: </strong>
        <?php
        echo $_SESSION["user"]["phone"];
        ?>
      </p>
      <p>
        <strong>
          Correo electrónico:
        </strong>
        <?php
        echo $_SESSION["user"]["email"];
        ?>
      </p>
    </div>
    <div class="col-4">
      <h3>Sobre mi</h3>
      <p>
        <?php
        echo $_SESSION["user"]["description"]
        ?>
      </p>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <a href="finished-quotes.php">
        <button class="btn btn-primary mt-4">Ver citas atendidas</button>
      </a>
    </div>
  </div>
</div>