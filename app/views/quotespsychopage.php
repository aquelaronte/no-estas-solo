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
      <h2 class="text-center">Citas pendientes</h2>
    </div>
  </div>
  <?php
  require_once "../app/controllers/quotes/checkQuotes_aware_c.php";

  $quotes_aware = $_SESSION["quotes_aware"];

  if (count($quotes_aware) == 0) {
    echo "
    <div class=\"row\">
      <div class=\"col\">
        <div class=\"alert alert-secondary\" role=\"alert\">
          No tienes citas pendientes
        </div>
      </div>
    </div>
    ";
  }
  ?>
  <div style="display: grid; grid-template-columns: 350px 350px 350px; gap: 15px;" class="mb-5">
    <?php
    if (count($quotes_aware) > 0) {
      foreach ($quotes_aware as $quote) {
        $id_quote = $quote["quote_info"]["id"];
        $id_psychologist = $quote["quote_info"]["id_psychologist"];
        $title = $quote["quote_info"]["title"];
        $description = $quote["quote_info"]["description"];
        $appointment_date = $quote["quote_info"]["appointment_date"];
        $creation_date = $quote["quote_info"]["creation_date"];
        $finished = $quote["quote_info"]["finished"];
        $state = $quote["quote_info"]["state"];
        $name_psychologist = $quote["quote_info"]["name_psychologist"];


        $name_student = $quote["user_info"]["name"];
        $email_student = $quote["user_info"]["email"];
        $phone_student = $quote["user_info"]["phone"];
        $address_student = $quote["user_info"]["address"];
        $grade_student = $quote["user_info"]["grade"];
        $age_student = $quote["user_info"]["age"];



        $creation_date = str_replace("T", " ", $creation_date);
        $appointment_date = str_replace("T", " ", $appointment_date);

        echo "
        <div class=\"card bg-warning bg-opacity-25\">
        <div class=\"card-body\">
          <h5 class=\"card-title\">$title</h5>
          <p class=\"card-text\"><strong>Estado:</strong> $state</p>
          <p class=\"card-text\"><strong>Descripción:</strong> $description</p>
          <p class=\"card-text\"><strong>Fecha de creación:</strong> $creation_date</p>
          <p class=\"card-text\"><strong>Psicólogo:</strong> $name_psychologist</p>
          <p class=\"card-text\"><strong>Fecha de atención:</strong> $appointment_date</p>
          <a class=\"btn btn-outline-warning\" href=\"../app/controllers/quotes/finishQuote_c.php?id_quote=$id_quote\">Terminar cita</a>
          <a class=\"btn btn-outline-danger\" data-bs-toggle=\"collapse\" href=\"#contenidoOculto$id_quote\" role=\"button\" aria-expanded=\"false\" aria-controls=\"contenidoOculto$id_quote\">Ver Más</a>
          <div class=\"collapse\" id=\"contenidoOculto$id_quote\">
            <p class=\"card-text\"><strong>Datos del paciente</strong></p>
            <p class=\"card-text\"><strong>Nombre:</strong> $name_student</p>
            <p class=\"card-text\"><strong>Edad:</strong> $age_student</p>
            <p class=\"card-text\"><strong>Número telefónico:</strong> $phone_student</p>
            <p class=\"card-text\"><strong>Correo:</strong> $email_student</p>
            <p class=\"card-text\"><strong>Dirección:</strong> $address_student</p>
            <p class=\"card-text\"><strong>Grado:</strong> $grade_student</p>
          </div>
        </div>
      </div>
        ";
      }
    }
    ?>
  </div>

  <div class="row">
    <div class="col">
      <h2 class="text-center">Citas en espera</h2>
    </div>
  </div>
  <?php
  require_once "../app/controllers/quotes/checkQuotes_psychologist_c.php";

  $quotes = $_SESSION["quotes"];

  if (count($quotes) == 0) {
    echo "
    <div class=\"row\">
      <div class=\"col\">
        <div class=\"alert alert-secondary\" role=\"alert\">
          No hay ninguna cita por atender
        </div>
      </div>
    </div>
    ";
  }
  ?>

  <div style="display: grid; grid-template-columns: 350px 350px 350px; gap: 15px; margin-bottom: 300px;">
    <?php
    if (count($quotes) > 0) {
      foreach ($quotes as $quote) {
        $id = $quote["id"];
        $id_student = $quote["id_student"];
        $id_psychologist = $quote["id_psychologist"];
        $title = $quote["title"];
        $description = $quote["description"];
        $appointment_date = $quote["appointment_date"];
        $creation_date = $quote["creation_date"];
        $finished = $quote["finished"];
        $state = $quote["state"];

        $creation_date = str_replace("T", " ", $creation_date);
        $appointment_date = str_replace("T", " ", $appointment_date);

        echo "
        <div class=\"card w-100 h-100 p-0 m-0\">
          <div class=\"card-body\">
            <h5 class=\"card-title text-start\"><strong>Asunto:</strong> $title</h5>
            <p class=\"card-text text-start\"><strong>Descripción:</strong> $description</p>
            <p class=\"card-text text-start\"><strong>Fecha de creación:</strong> $creation_date</p>
            <a class=\"btn btn-primary\" href=\"./enroll_p.php?id_quote=$id\">Agendar cita</a>
          </div>
        </div>
        ";
      }
    }
    ?>
  </div>
</div>