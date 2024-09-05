<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>Seminario Udenar</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-x9n6HgwrUUPHJXlUem17T0dYbY+VBCErC/0iZwaeiXPKZXaETP1gIsj3oAv2szGJ8gAgIrghEx4q6TSklk8g2A=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <?php require 'partials/header.php' ?>
  <div class="container p-3">
    <div class="card p-3">
      <div class="card-header">Registrar Coordinador</div>
      <div class="card-body">
        <form method="post" action="guardarCoordinador.php">
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-user"></i></span>
              <input name="nombre" class="form-control" id="nombre" placeholder="Nombre" type="text" required>
            </div>
          </div>
          
          <div class="mb-3">
            <label for="identificacion" class="form-label">Identificación</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-id-card"></i></span>
              <input name="identificacion" class="form-control" id="identificacion" placeholder="Identificación"
                type="text" required>
            </div>
          </div>
          <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
              <input name="direccion" class="form-control" id="direccion" placeholder="Dirección" type="text" required>
            </div>
          </div>
          <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-phone"></i></span>
              <input name="telefono" class="form-control" id="telefono" placeholder="Teléfono" type="text" required>
            </div>
          </div>
          <div class="mb-3">
            <label for="correo" class="form-label">Correo electrónico</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-envelope"></i></span>
              <input name="correo" class="form-control" id="correo" placeholder="Correo electrónico" type="email"
                required>
            </div>
          </div>
          <div class="mb-3">
            <label for="genero" class="form-label">Género</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-venus-mars"></i></span>
              <select name="genero" id="genero" class="form-select" required>
                <option value="">Seleccionar género</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
                <option value="Otro">Otro</option>
              </select>
            </div>
          </div>
          <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-image"></i></span>
              <input name="foto" class="form-control" id="foto" placeholder="URL de la foto" type="text" required>
            </div>
          </div>
          <div class="mb-3">
            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-calendar"></i></span>
              <input name="fecha_nacimiento" class="form-control" id="fecha_nacimiento"
                placeholder="Fecha de nacimiento" type="date" required>
            </div>
          </div>
          <div class="mb-3">
            <label for="programa_academico" class="form-label">Programa académico</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-graduation-cap"></i></span>
              <input name="programa_academico" class="form-control" id="programa_academico"
                placeholder="Programa académico" type="text" required>
            </div>
          </div>
          <div class="mb-3">
            <label for="areas_conocimiento" class="form-label">Áreas de conocimiento</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-lightbulb"></i></span>
              <input name="areas_conocimiento" class="form-control" id="areas_conocimiento"
                placeholder="Áreas de conocimiento" type="text" required>
            </div>
          </div>
          <div class="mb-3">
            <label for="fecha_vinculacion" class="form-label">Fecha de vinculación</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-calendar-check"></i></span>
              <input name="fecha_vinculacion" class="form-control" id="fecha_vinculacion"
                placeholder="Fecha de vinculación" type="date" required>
            </div>
          </div>
          <div class="mb-3">
            <label for="acuerdo_nombramiento" class="form-label">Acuerdo de nombramiento</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-file-alt"></i></span>
              <input name="acuerdo_nombramiento" class="form-control" id="acuerdo_nombramiento"
                placeholder="Acuerdo de nombramiento" type="text" required>
            </div>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-e0smRo+1HUgAaxN+R2u7kQ8FJpLz6++Qh9Azdk4udf86LcDfFb3yj1af9SUGbyGh"
    crossorigin="anonymous"></script>
</body>

</html>
