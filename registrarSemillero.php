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
      <div class="card-header">Registrar Semillero</div>
      <div class="card-body">
        <form method="post" action="guardarSemillero.php">
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-user"></i></span>
              <input name="nombre" class="form-control" id="nombre" placeholder="Nombre" type="text" required>
            </div>
          </div>
          
          <div class="mb-3">
            <label for="correo" class="form-label">Correo Electrónico</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-envelope"></i></span>
              <input name="correo" class="form-control" id="correo" placeholder="Correo Electrónico" type="email" required>
            </div>
          </div>
          
          <div class="mb-3">
            <label for="logo" class="form-label">Logo</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-image"></i></span>
              <input name="logo" class="form-control" id="logo" placeholder="URL del Logo" type="text" required>
            </div>
          </div>
          
          <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" id="descripcion" placeholder="Descripción" required></textarea>
          </div>
          
          <div class="mb-3">
            <label for="mision" class="form-label">Misión</label>
            <textarea name="mision" class="form-control" id="mision" placeholder="Misión" required></textarea>
          </div>
          
          <div class="mb-3">
            <label for="vision" class="form-label">Visión</label>
            <textarea name="vision" class="form-control" id="vision" placeholder="Visión" required></textarea>
          </div>
          
          <div class="mb-3">
            <label for="valores" class="form-label">Valores</label>
            <textarea name="valores" class="form-control" id="valores" placeholder="Valores" required></textarea>
          </div>
          
          <div class="mb-3">
            <label for="objetivos" class="form-label">Objetivos</label>
            <textarea name="objetivos" class="form-control" id="objetivos" placeholder="Objetivos" required></textarea>
          </div>
          
          <div class="mb-3">
            <label for="lineas_investigacion" class="form-label">Líneas de Investigación</label>
            <textarea name="lineas_investigacion" class="form-control" id="lineas_investigacion" placeholder="Líneas de Investigación" required></textarea>
          </div>
          
          <div class="mb-3">
            <label for="archivo_presentacion" class="form-label">Archivo de Presentación</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-file"></i></span>
              <input name="archivo_presentacion" class="form-control" id="archivo_presentacion" placeholder="URL del Archivo" type="text" required>
            </div>
          </div>
          
          <div class="mb-3">
            <label for="fecha_resolucion" class="form-label">Fecha de Resolución</label>
            <input name="fecha_resolucion" class="form-control" id="fecha_resolucion" type="date" required>
          </div>
          
          <div class="mb-3">
            <label for="numero_resolucion" class="form-label">Número de Resolución</label>
            <input name="numero_resolucion" class="form-control" id="numero_resolucion" placeholder="Número de Resolución" type="text" required>
          </div>
          
          <div class="mb-3">
            <label for="archivo_resolucion" class="form-label">Archivo de Resolución</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-file"></i></span>
              <input name="archivo_resolucion" class="form-control" id="archivo_resolucion" placeholder="URL del Archivo" type="text" required>
            </div>
          </div>
          
          <div class="mb-3">
            <label for="id_coordinador" class="form-label">ID del Coordinador</label>
            <input name="id_coordinador" class="form-control" id="id_coordinador" placeholder="ID del Coordinador" type="number" required>
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