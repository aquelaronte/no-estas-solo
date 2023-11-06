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
    <div class="col mt-3">
      <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; margin-bottom: 300px;">
        <?php
        require "../app/models/quotes.php";

        $quotesModel = new QuotesModel();

        if ($_SESSION["user"]["role"] == "psicólogo") {
          $quotes = $quotesModel->getFinishedQuotes_psychologist($_SESSION["user"]["id"]);
          foreach ($quotes as $quote) {
            echo "
            <div class=\"card bg-success bg-opacity-10\">
              <div class=\"card-body\">
                <h5 class=\"card-title\">$quote[title]</h5>
                <p class=\"card-text\"><strong>Estado:</strong> $quote[state]</p>
                <p class=\"card-text\"><strong>Descripción:</strong> $quote[description]</p>
                <p class=\"card-text\"><strong>Fecha de creación:</strong> $quote[creation_date]</p>
                <p class=\"card-text\"><strong>Fecha de atención:</strong> $quote[appointment_date]</p>
                <a class=\"btn btn-outline-success\" data-bs-toggle=\"collapse\" href=\"#contenidoOculto$quote[id]\" role=\"button\" aria-expanded=\"false\" aria-controls=\"contenidoOculto$quote[id]\">Ver Más</a>
                <div class=\"collapse\" id=\"contenidoOculto$quote[id]\">
                  <p class=\"card-text\"><strong>Datos del paciente</strong></p>
                  <p class=\"card-text\"><strong>Nombre:</strong> $quote[name_patient]</p>
                  <p class=\"card-text\"><strong>Edad:</strong> $quote[age_patient]</p>
                  <p class=\"card-text\"><strong>Número telefónico:</strong> $quote[phone_patient]</p>
                </div>
              </div>
            </div>
            ";
          }
        } elseif ($_SESSION["user"]["role"] == "estudiante") {
          $quotes = $quotesModel->getFinishedQuotes_student($_SESSION["user"]["id"]);
          foreach ($quotes as $quote) {
            echo "
            <div class=\"card bg-success bg-opacity-10\">
              <div class=\"card-body\">
                <h5 class=\"card-title\">$quote[title]</h5>
                <p class=\"card-text\"><strong>Estado:</strong> $quote[state]</p>
                <p class=\"card-text\"><strong>Descripción:</strong> $quote[description]</p>
                <p class=\"card-text\"><strong>Fecha de creación:</strong> $quote[creation_date]</p>
                <p class=\"card-text\"><strong>Fecha de atención:</strong> $quote[appointment_date]</p>
                <a class=\"btn btn-outline-success\" data-bs-toggle=\"collapse\" href=\"#contenidoOculto$quote[id]\" role=\"button\" aria-expanded=\"false\" aria-controls=\"contenidoOculto$quote[id]\">Ver Más</a>
                <div class=\"collapse\" id=\"contenidoOculto$quote[id]\">
                  <p class=\"card-text\"><strong>Datos del psicólogo</strong></p>
                  <p class=\"card-text\"><strong>Nombre:</strong> $quote[name_psychologist]</p>
                  <p class=\"card-text\"><strong>Edad:</strong> $quote[age_psychologist]</p>
                  <p class=\"card-text\"><strong>Número telefónico:</strong> $quote[phone_psychologist]</p>
                </div>
              </div>
            </div>
            ";
          }
        }
        ?>
      </div>
    </div>
  </div>
</div>