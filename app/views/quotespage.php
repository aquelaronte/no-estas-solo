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
<div class="container">
  <div class="row">
    <div class="col">
      <h1 class="text-center">Tus citas</h1>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <p class="text-center">Agenda una cita de psicología aquí</p>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col">
      <form action="../app/controllers/quotes/createQuote_c.php" method="post">
        <div class="container">
          <div class="row d-flex justify-content-center">
            <div class="col-7">
              <div class="form-floating mb-2">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="title" required>
                <label for="floatingInput">Motivo o razón de la cita</label>
              </div>
            </div>
          </div>
          <div class="row d-flex justify-content-center">
            <div class="col-7">
              <div class="form-group mt-4">
                <label for="exampleTextarea">Cuéntanos a detalle tu situación</label>
                <textarea class="form-control" id="exampleTextarea" rows="5" maxlength="255" name="description" required></textarea>
                <small class="text-muted" id="charCount" style="font-size: 1rem;">Caracteres restantes: 255</small>
              </div>
            </div>
          </div>
          <div class="row d-flex justify-content-center mt-4">
            <div class="col-7">
              <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Fecha</span>
                <input type="datetime-local" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="fecha" name="creation_date">
              </div>
            </div>
          </div>
          <div class="row d-flex justify-content-center mt-4">
            <div class="col-7">
              <button class="btn btn-primary" type="submit">Agendar cita</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="container mt-4">
  <div class="row">
    <div class="col">
      <h2 class="text-center mt-5">Citas agendadas</h2>
    </div>
  </div>
  <?php
  if ($_SESSION["user"]["role"] == "estudiante") {
    require_once "../app/controllers/quotes/checkQuotes_student_c.php";
  } elseif ($_SESSION["user"]["role"] == "psicólogo") {
    require_once "../app/controllers/quotes/checkQuotes_psychologist_c.php";
  }

  $quotes = $_SESSION["quotes"];

  if (count($quotes) == 0) {
    echo "
    <div class=\"row\">
      <div class=\"col\">
        <div class=\"alert alert-secondary\" role=\"alert\">
          No tienes ninguna cita agendada
        </div>
      </div>
    </div>
    ";
  }
  ?>
  <div class="row">
    <div class="col">
      <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; margin-bottom: 300px;">
        <?php
        if (count($quotes) > 0) {
          foreach ($quotes as $quote) {
            $id = $quote["id"];
            $title = $quote["title"];
            $description = $quote["description"];
            $appointment_date = $quote["appointment_date"];
            $creation_date = $quote["creation_date"];
            $finished = $quote["finished"];
            $state = $quote["state"];
            $name_psychologist = $quote["name_psychologist"];

            $creation_date = str_replace("T", " ", $creation_date);
            $appointment_date = str_replace("T", " ", $appointment_date);

            if ($state == "en espera") {
              echo "
              <div class=\"card bg-primary bg-opacity-10\">
                <div class=\"card-body\">
                  <h5 class=\"card-title\">$title</h5>
                  <p class=\"card-text\"><strong>Estado:</strong> $state</p>
                  <p class=\"card-text\"><strong>Descripción:</strong> $description</p>
                  <p class=\"card-text\"><strong>Fecha de creación:</strong> $creation_date</p>
                </div>
              </div>
              ";
            } elseif ($state == "pendiente") {
              echo "
              <div class=\"card bg-warning bg-opacity-10\">
                <div class=\"card-body\">
                  <h5 class=\"card-title\">$title</h5>
                  <p class=\"card-text\"><strong>Estado:</strong> $state</p>
                  <p class=\"card-text\"><strong>Descripción:</strong> $description</p>
                  <p class=\"card-text\"><strong>Fecha de creación:</strong> $creation_date</p>
                  <p class=\"card-text\"><strong>Psicólogo:</strong> $name_psychologist</p>
                  <p class=\"card-text\"><strong>Fecha de atención:</strong> $appointment_date</p>
                </div>
              </div>
              ";
            }
          }
        }
        ?>
      </div>
    </div>
  </div>
</div>

<script>
  // Obtén la referencia al elemento de entrada de fecha y hora
  var inputFecha = document.getElementById("fecha");

  // Obtiene la fecha y hora actual
  var fechaActual = new Date();

  // Formatea la fecha y hora actual como "YYYY-MM-DDTHH:mm"
  var fechaFormateada = fechaActual.getFullYear() + "-" +
    agregarCero(fechaActual.getMonth() + 1) + "-" +
    agregarCero(fechaActual.getDate()) + "T" +
    agregarCero(fechaActual.getHours()) + ":" +
    agregarCero(fechaActual.getMinutes());

  // Establece el valor del campo de entrada de fecha y hora con la fecha actual formateada
  inputFecha.value = fechaFormateada;

  // Función para agregar cero delante de un número si es necesario
  function agregarCero(numero) {
    return numero < 10 ? '0' + numero : numero;
  }
</script>