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
<!-- Create note modal -->
<div class="modal fade" id="createNoteModal" tabindex="-1" aria-labelledby="createNoteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="createNoteModalLabel">Crear nota</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="../app/controllers/notes/createNote_c.php" method="post">
        <div class="modal-body">
          <div class="container">
            <div class="row">
              <div class="col">
                <div class="form-floating mb-2">
                  <input type="text" class="form-control" id="floatingInput" placeholder="title" name="title" required>
                  <label for="floatingInput">Título (máximo 100 carácteres)</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group mt-4">
                  <label for="exampleTextarea">Descripción (máximo 150 caracteres):</label>
                  <textarea class="form-control" id="exampleTextarea" rows="4" maxlength="150" name="description" required></textarea>
                  <small class="text-muted" id="charCount" style="font-size: 1rem;">Caracteres restantes: 150</small>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar nota</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="container mt-3">
  <?php
  require_once "../app/controllers/notes/checkNotes_c.php";
  $notes = $_SESSION["notes"];

  if (count($notes) == 0) {
    echo "
    <div class=\"row\">
      <div class=\"col\">
        <div class=\"alert alert-secondary\" role=\"alert\">
          No tienes notas creadas
        </div>
      </div>
    </div>
    <div class=\"row\">
      <div class=\"col\">
        <button style=\"margin: 0; padding: 0;\" class=\"btn\" type=\"button\" data-bs-toggle=\"modal\" data-bs-target=\"#createNoteModal\">
          <div class=\"card\" style=\"width: 18rem; height: 200px;\">
            <div class=\"card-body d-flex flex-column justify-content-center align-items-center\">
              <i class=\"fa fa-plus mb-3\"></i>
              <p>Crea una nota</p>
            </div>
          </div>
        </button>
      </div>
    <div>
    ";
  }
  ?>
  <?php
  if (count($notes) > 0) {
    for ($i = 0; $i < count($notes); $i++) {
      if ($i % 3 == 0) {
        echo "
          <div class=\"row\">
        ";
      }
      $id = $notes[$i]["id"];
      $title = $notes[$i]["title"];
      $description = $notes[$i]["description"];
      echo "
      <div class=\"col-md-auto\">
        <span>
          <a href=\"http://localhost/no%20estas%20solo/app/controllers/notes/deleteNote_c.php?id=$id\" style=\"text-decoration: none; color: black;\">
            <button class=\"btn\"><i class=\"fa fa-trash\"></i></button>
          </a>
        </span>
        <div class=\"card\" style=\"width: 18rem; height: 200px;\">
          <div class=\"card-body\">
            <h5 class=\"card-title\">$title</h5>
            <p class=\"card-text\">$description</p>
          </div>
        </div>
      </div>
      ";

      if ($i == (count($notes) - 1)) {
        if (($i + 1) % 3 == 0) {
          echo "
          <div class=\"row mt-3\">
            <div class=\"col-md-auto\" style=\"margin-top: 38px;\">
              <button style=\"margin: 0; padding: 0;\" class=\"btn\" type=\"button\" data-bs-toggle=\"modal\" data-bs-target=\"#createNoteModal\">
              <div class=\"card\" style=\"width: 18rem; height: 200px;\">
                <div class=\"card-body d-flex flex-column justify-content-center align-items-center\">
                  <i class=\"fa fa-plus mb-3\"></i>
                  <p>Crea una nota</p>
                </div>
              </div>
              </button>
            </div>
          </div>
          ";
        } else {
          echo "
          <div class=\"col-md-auto\" style=\"margin-top: 38px;\">
            <button style=\"margin: 0; padding: 0;\" class=\"btn\" type=\"button\" data-bs-toggle=\"modal\" data-bs-target=\"#createNoteModal\">
            <div class=\"card\" style=\"width: 18rem; height: 200px;\">
              <div class=\"card-body d-flex flex-column justify-content-center align-items-center\">
                <i class=\"fa fa-plus mb-3\"></i>
                <p>Crea una nota</p>
              </div>
            </div>
            </button>
          </div>
          ";
        }
        if ($i % 3 == 0) {
          echo "
            </div>
          ";
        }
      }
    }
  }
  ?>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('exampleTextarea');
    const charCount = document.getElementById('charCount');
    const maxChars = parseInt(textarea.getAttribute('maxlength'));

    textarea.addEventListener('input', function() {
      const remainingChars = maxChars - textarea.value.length;
      charCount.textContent = `Caracteres restantes: ${remainingChars}`;
    });
  })
</script>