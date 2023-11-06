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
  <?php
  if ($_SESSION["user"]["role"] == "psicólogo") {
    echo "
    <form action=\"../app/controllers/tips/createTip.php\" method=\"post\">
      <div class=\"row\">
        <div class=\"col\">
          <h1 class=\"text-center\">Añade un consejo</h1>
        </div>
      </div>
      <div class=\"row\">
        <div class=\"col\">
          <div class=\"form-floating mb-2\">
            <input type=\"text\" class=\"form-control\" id=\"floatingInput\" placeholder=\"\" name=\"title\" required>
            <label for=\"floatingInput\">Título</label>
          </div>
        </div>
      </div>
      <div class=\"row\">
        <div class=\"col\">        
          <div class=\"form-group\">
          <label for=\"exampleTextarea\">Descripción</label>
          <textarea class=\"form-control\" id=\"exampleTextarea\" rows=\"4\" name=\"description\"></textarea>
          </div>
        </div>
      </div>
      <div class=\"row\">
        <div class=\"col d-flex align-content-center justify-content-center mt-4\">
          <button class=\"btn btn-primary\" type=\"submit\">Añadir consejo</button>
        </div>
      </div>
      <input type=\"hidden\" value=\" " . $_SESSION["user"]["id"] . "\" name=\"id_psychologist\" />
    </form>
    ";
  }
  ?>
  <div class="row">
    <div class="col mt-4">
      <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; margin-bottom: 300px;">
        <?php
        require "../app/models/tips.php";

        $tipsModel = new TipsModel();

        $tips = $tipsModel->getTips();

        if ($_SESSION["user"]["role"] == "estudiante") {
          foreach ($tips as $tip) {
            echo "
            <button style=\"margin: 0; padding: 0;\" class=\"btn w-100 h-100\" type=\"button\" data-bs-toggle=\"modal\" data-bs-target=\"#createNoteModal$tip[id]\">
              <div class=\"card w-100 h-100\" style=\"width: 18rem; height: 200px;\">
                <div class=\"card-body d-flex flex-column justify-content-center align-items-center\">
                  <h3>$tip[title]</h3>
                  <p>Da clic para ver mas <i class=\"fa fa-arrow-down\"></i></p>
                </div>
              </div>
            </button>

            <div class=\"modal fade\" id=\"createNoteModal$tip[id]\" tabindex=\"-1\" aria-labelledby=\"createNoteModalLabel\" aria-hidden=\"true\">
              <div class=\"modal-dialog\">
                <div class=\"modal-content\">
                  <div class=\"modal-header\">
                    <h1 class=\"modal-title fs-5\" id=\"createNoteModalLabel\">$tip[title]</h1>
                    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                  </div>
                  <div class=\"modal-body\">
                    <div class=\"container\">
                      <div class=\"row\">
                        <div class=\"col\">
                          <p>$tip[description]</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=\"modal-footer\">
                    Escrito por: $tip[name]
                  </div>
                </div>
              </div>
            </div>
            ";
          }
        } elseif ($_SESSION["user"]["role"] == "psicólogo") {
          foreach ($tips as $tip) {
            echo "
            <button style=\"margin: 0; padding: 0;\" class=\"btn w-100 h-100\" type=\"button\" data-bs-toggle=\"modal\" data-bs-target=\"#createNoteModal$tip[id]\">
              <div class=\"card w-100 h-100\" style=\"width: 18rem; height: 200px;\">
                <div class=\"card-body d-flex flex-column justify-content-center align-items-center\">
                  <h3>$tip[title]</h3>
                  <p>Da clic para ver mas <i class=\"fa fa-arrow-down\"></i></p>
                </div>
              </div>
            </button>

            <div class=\"modal fade\" id=\"createNoteModal$tip[id]\" tabindex=\"-1\" aria-labelledby=\"createNoteModalLabel\" aria-hidden=\"true\">
              <div class=\"modal-dialog\">
                <div class=\"modal-content\">
                  <div class=\"modal-header\">
                    <h1 class=\"modal-title fs-5\" id=\"createNoteModalLabel\">$tip[title]</h1>
                    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                  </div>
                  <div class=\"modal-body\">
                    <div class=\"container\">
                      <div class=\"row\">
                        <div class=\"col\">
                          <p>$tip[description]</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=\"modal-footer\">
                    Escrito por: $tip[name]
                  </div>
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