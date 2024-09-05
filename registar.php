<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title> ceminario udenar </title>
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
      <div class="card-header">Registrar Estudiante</div>
      <div class="card-body">
        <form method="post" action="guardarEstudiante.php">
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
            <label for="codigo_estudiantil" class="form-label">Código Estudiantil</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-graduation-cap"></i></span>
              <input name="codigo_estudiantil" class="form-control" id="codigo_estudiantil"
                placeholder="Código Estudiantil" type="text" required>
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
            <label for="correo" class="form-label">Correo</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-envelope"></i></span>
              <input name="correo" class="form-control" id="correo" placeholder="Correo" type="email" required>
            </div>
          </div>
          <div class="mb-3">
            <label for="genero" class="form-label">Género</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-venus-mars"></i></span>
              <select name="genero" class="form-control" id="genero" required>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
              </select>
            </div>
          </div>
          <div class="mb-3">
            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-calendar"></i></span>
              <input name="fecha_nacimiento" class="form-control" id="fecha_nacimiento"
                placeholder="Fecha de Nacimiento" type="date" required>
            </div>
          </div>
          <div class="mb-3">
            <label for="semestre" class="form-label">Semestre</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-graduation-cap"></i></span>
              <input name="semestre" class="form-control" id="semestre" placeholder="Semestre" type="number" required>
            </div>
          </div>
          <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-image"></i></span>
              <input name="foto" class="form-control-file" id="foto" type="file">
            </div>
          </div>
          <div class="mb-3">
            <label for="archivo_matricula" class="form-label">Archivo de Matrícula</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-file"></i></span>
              <input name="archivo_matricula" class="form-control-file" id="archivo_matricula" type="file">
            </div>
          </div>
          <div class="mb-3">
            <label for="programa_academico" class="form-label">Programa Académico</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-book"></i></span>
              <input name="programa_academico" class="form-control" id="programa_academico"
                placeholder="Programa Académico" type="text" required>
            </div>
          </div>
          <div class="mb-3">
            <label for="fecha_vinculacion_semillero" class="form-label">Fecha de Vinculación al Semillero</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-calendar"></i></span>
              <input name="fecha_vinculacion_semillero" class="form-control" id="fecha_vinculacion_semillero"
                placeholder="Fecha de Vinculación al Semillero" type="date" required>
            </div>
          </div>
          <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-info"></i></span>
              <input name="estado" class="form-control" id="estado" placeholder="Estado" type="text" required>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Guardar</button>
          </div>
          <div class="form-group mt-2">
            <button  href="index.php" class="btn btn-danger btn-block">cancelar</button>
          </div>
          
        </form>
      </div>
    </div>
  </div>


  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->
</body>

</html>