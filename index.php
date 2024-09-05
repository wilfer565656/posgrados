<?php
session_start();

require 'database.php';

if (isset($_SESSION['user_id'])) {
  $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
  $records->bindParam(':id', $_SESSION['user_id']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $user = null;

  if (count($results) > 0) {
    $user = $results;
  }
}
?>

<!DOCTYPE html>
<html>
<?php require 'partials/head.php' ?>

<body>
  <?php require 'partials/header.php' ?>

  <?php if (!empty($user)): ?>

    <div class="container text-center mt-5">
      <h3>Bienvenido,
        <?= $user['email']; ?>
      </h3>
      <div class="card" style="width:70% ;">

        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <a href="registar.php" class="btn btn-primary btn-lg btn-block m-3 " style="width:40% ;">Registrar
              Estudiante</a>
            <a href="listarEstudiante.php" class="btn btn-primary btn-lg btn-block m-3"style="width:40% ;">Listar
              Estudiantes
            </a>
          </li>
          <li class="list-group-item"> </li>
          <li class="list-group-item">
            <a href="registrarCoordinador.php" class="btn btn-primary btn-lg btn-block m-3"style="width:40% ;">Registrar Coordinador
            </a>
            <a href="listarCoordinador.php" class="btn btn-primary btn-lg btn-block m-3"style="width:40% ;">Listar Coordinador
            </a>
          </li>
          <li class="list-group-item">
            <a href="registrarSemillero.php" class="btn btn-primary btn-lg btn-block m-3"style="width:40%" ;>Registrar semillero</a>
            <a href="listarSemillero.php" class="btn btn-primary btn-lg btn-block m-3"style="width:40% ;">Listar semillero</a>
          </li>
          <li class="list-group-item">
            <a href="registrarProyecto.php" class="btn btn-primary btn-lg btn-block m-3"style="width:40% ;">Registrar proyecto</a>
            <a href="listarProyectos.php" class="btn btn-primary btn-lg btn-block m-3"style="width:40% ;">Listar proyectos </a>
          </li>
          <li class="list-group-item">
            <a href="registrarEvento.php" class="btn btn-primary btn-lg btn-block m-3"style="width:40% ;">Registrar evento</a>
            <a href="listarEvento.php" class="btn btn-primary btn-lg btn-block m-3" style="width:40% ;">Listar eventos </a>
          </li>
          <li class="list-group-item">
            <a href="registrarProyecto_evento.php" class="btn btn-primary btn-lg btn-block m-3" style="width:40% ;">proyecto para eventos</a>
            <a href="listarProyecto_evento.php" class="btn btn-primary btn-lg btn-block m-3" style="width:40% ;">Listar poyecto para eventos
            </a>
          </li>
          <li class="list-group-item">
            <a href="registrarEstudianteProyecto.php" class="btn btn-primary btn-lg btn-block m-3" style="width:40% ;">registrar estudiante
              proyecto </a>
            <a href="listarProyectoEstudiante.php" class="btn btn-primary btn-lg btn-block m-3" style="width:40% ;">Listar proyecto estudiantes
            </a>
          </li>
          <li class="list-group-item">
            <a href="registraEstudianteSemillero.php" class="btn btn-primary btn-lg btn-block m-3" style="width:40% ;">registrar estudiante
              semillero </a>
            <a href="listarEstudianteSemillero.php" class="btn btn-primary btn-lg btn-block m-3" style="width:40% ;">Listar estudiante
              semillero</a>
          </li>
          <li class="list-group-item">

          </li>
          <li class="list-group-item">
            <a href="registrarParticipacionEvento.php" class="btn btn-primary btn-lg btn-block m-3" style="width:40% ;">registrar
              participacion
            </a>
            <a href="listarParticipacionEvento.php" class="btn btn-primary btn-lg btn-block m-3" style="width:40% ;">Listar participacion</a>
          </li>

          </li>
          <li class="list-group-item">
            <a href="registrarProyectoSemillero.php" class="btn btn-primary btn-lg btn-block m-3" style="width:40% ;">registrar proyecto semillero </a>
            <a href="listarProyectoSemillero.php" class="btn btn-primary btn-lg btn-block m-3" style="width:40% ;">Listar proyecto semillero</a>
          </li>

        </ul>
      </div>




      

    </div>

  <?php else: ?>

    <div class="container justify-content-center mt-5">
      <h1>Para continuar</h1>
      <div class="card  " style="width: 18rem;">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <p>
              <a href="login.php" class="btn btn-primary m-2">Iniciar sesión como director</a>
            </p>
          </li>
          <li class="list-group-item">
            <p>
              <a href="loginCor.php" class="btn btn-primary m-2">Iniciar sesión como cordinador</a>
            </p>
          </li>
          <li class="list-group-item">
            <p>
              <a href="loginEstu.php" class="btn btn-primary m-2">Iniciar sesión como semillerista</a>
            </p>
          </li>
        </ul>
      </div>


    </div>
  <?php endif; ?>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>
</body>

</html>