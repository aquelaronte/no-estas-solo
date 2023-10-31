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
<form action="../app/controllers/users/signup_c.php" method="post">
  <div class="container mb-5">
    <div class="row">
      <div class="col d-flex flex-column align-items-center mb-4">
        <h1>Crea tu cuenta</h1>
        <p>Empieza a trabajar tu salud mental con nosotros</p>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <h5>Primero empieza dándonos tu nombre</h5>
        <p>Los campos con <span style="color: red;">*</span> son obligatorios</p>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="first-name" required>
          <label for="floatingInput">Primer nombre <span style="color: red;">*</span></label>
        </div>
      </div>
      <div class="col">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="first-lastname" required>
          <label for="floatingInput">Primer apellido <span style="color: red;">*</span></label>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="second-name">
          <label for="floatingInput">Segundo nombre</label>
        </div>
      </div>
      <div class="col">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="second-lastname" required>
          <label for="floatingInput">Segundo apellido <span style="color: red;">*</span></label>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <hr class="border border-dark border-1 opacity-100" style="width: calc(100vw - 300px);">
      </div>
    </div>
    <div class="row">
      <div class="col">
        <small>Verifica que los campos coincidan, de lo contrario, no podrás acceder</small>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-floating mb-3">
          <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" required>
          <label for="email">Correo electrónico <span style="color: red;">*</span></label>
        </div>
      </div>
      <div class="col">
        <div class="form-floating mb-3">
          <input type="password" class="form-control" id="pwd" placeholder="name@example.com" name="password" required>
          <label for="pwd">Contraseña <span style="color: red;">*</span></label>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-floating mb-3">
          <input type="email" class="form-control" id="verifyEmail" placeholder="name@example.com" name="verifyEmail" required>
          <label for="verifyEmail">Verifica tu dirección de correo eletrónico <span style="color: red;">*</span></label>
        </div>
      </div>
      <div class="col">
        <div class="form-floating mb-3">
          <input type="password" class="form-control" id="verifyPwd" placeholder="name@example.com" name="verifyPassword" required>
          <label for="verifyPwd">Verifica tu contraseña <span style="color: red;">*</span></label>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <h5>Necesitamos tu información de contacto</h5>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="phone" required>
          <label for="floatingInput">Número telefónico <span style="color: red;">*</span></label>
        </div>
      </div>
      <div class="col">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="address">
          <label for="floatingInput">Dirección de hogar</label>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <h5>Infórmanos quien eres</h5>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <select name="grade" id="grade" class="form-select">
          <option value="default" selected>Selecciona tu grado <span style="color: red;">*</span></option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="other">otro...</option>
        </select>
      </div>
      <div class="col">
        <select name="role" id="role" class="form-select mb-3">
          <option value="default" selected>¿Eres estudiante o psicólogo? <span style="color: red;">*</span></option>
          <option value="estudiante">Estudiante</option>
          <option value="psicólogo">Psicólogo</option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-floating mb-3">
          <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="age" required>
          <label for="floatingInput">Dinos tu edad <span style="color: red;">*</span></label>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <p>Sobre ti</p>
        <div class="container mt-4">
          <div class="form-group">
            <label for="exampleTextarea">Texto (máximo 200 caracteres):</label>
            <textarea class="form-control" id="exampleTextarea" rows="4" maxlength="200" style="font-size: 1.2rem;" name="description"></textarea>
            <small class="text-muted" id="charCount" style="font-size: 1.2rem;">Caracteres restantes: 200</small>
          </div>
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
        <button type="submit" class="btn btn-primary mt-4 btn-md" id="siguiente">Siguiente</button>
      </div>
    </div>
  </div>
</form>
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