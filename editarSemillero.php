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

  <?php
  require 'database.php';

  // Verificar si se ha enviado el formulario de edición
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $logo = $_POST['logo'];
    $descripcion = $_POST['descripcion'];
    $mision = $_POST['mision'];
    $vision = $_POST['vision'];
    $valores = $_POST['valores'];
    $objetivos = $_POST['objetivos'];
    $lineas_investigacion = $_POST['lineas_investigacion'];
    $archivo_presentacion = $_POST['archivo_presentacion'];
    $fecha_resolucion = $_POST['fecha_resolucion'];
    $numero_resolucion = $_POST['numero_resolucion'];
    $archivo_resolucion = $_POST['archivo_resolucion'];
    $id_coordinador = $_POST['id_coordinador'];

    // Actualizar los datos en la base de datos
    $stmt = $conn->prepare('UPDATE semillero SET nombre = ?, correo = ?, logo = ?, descripcion = ?, mision = ?, vision = ?, valores = ?, objetivos = ?, lineas_investigacion = ?, archivo_presentacion = ?, fecha_resolucion = ?, numero_resolucion = ?, archivo_resolucion = ?, id_coordinador = ? WHERE id = ?');
    $stmt->execute([$nombre, $correo, $logo, $descripcion, $mision, $vision, $valores, $objetivos, $lineas_investigacion, $archivo_presentacion, $fecha_resolucion, $numero_resolucion, $archivo_resolucion, $id_coordinador, $id]);

    // Redireccionar a la página de listado después de la edición
    header('Location: listarSemillero.php');
    exit();
  } else {
    // Verificar si se ha proporcionado un ID válido
    if (isset($_GET['id'])) {
      $id = $_GET['id'];

      // Obtener los datos del semillero de la base de datos
      $stmt = $conn->prepare('SELECT * FROM semillero WHERE id = ?');
      $stmt->execute([$id]);
      $semillero = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
      // Redireccionar si no se proporcionó un ID válido
      header('Location: listarSemillero.php');
      exit();
    }
  }
  ?>

  <div class="container p-3">
    <div class="card p-3">
      <div class="card-header">Editar Semillero</div>
      <div class="card-body">
        <form method="post" action="editarSemillero.php">
          <input type="hidden" name="id" value="<?php echo $semillero['id']; ?>">

          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-user"></i></span>
              <input name="nombre" class="form-control" id="nombre" placeholder="Nombre" type="text" required value="<?php echo $semillero['nombre']; ?>">
            </div>
          </div>

          <div class="mb-3">
            <label for="correo" class="form-label">Correo Electrónico</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-envelope"></i></span>
              <input name="correo" class="form-control" id="correo" placeholder="Correo Electrónico" type="email" required value="<?php echo $semillero['correo']; ?>">
            </div>
          </div>

          <div class="mb-3">
            <label for="logo" class="form-label">Logo</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-image"></i></span>
              <input name="logo" class="form-control" id="logo" placeholder="URL del Logo" type="text" required value="<?php echo $semillero['logo']; ?>">
            </div>
          </div>

          <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" id="descripcion" placeholder="Descripción" required><?php echo $semillero['descripcion']; ?></textarea>
          </div>

          <div class="mb-3">
            <label for="mision" class="form-label">Misión</label>
            <textarea name="mision" class="form-control" id="mision" placeholder="Misión" required><?php echo $semillero['mision']; ?></textarea>
          </div>

          <div class="mb-3">
            <label for="vision" class="form-label">Visión</label>
            <textarea name="vision" class="form-control" id="vision" placeholder="Visión" required><?php echo $semillero['vision']; ?></textarea>
          </div>

          <div class="mb-3">
            <label for="valores" class="form-label">Valores</label>
            <textarea name="valores" class="form-control" id="valores" placeholder="Valores" required><?php echo $semillero['valores']; ?></textarea>
          </div>

          <div class="mb-3">
            <label for="objetivos" class="form-label">Objetivos</label>
            <textarea name="objetivos" class="form-control" id="objetivos" placeholder="Objetivos" required><?php echo $semillero['objetivos']; ?></textarea>
          </div>

          <div class="mb-3">
            <label for="lineas_investigacion" class="form-label">Líneas de Investigación</label>
            <textarea name="lineas_investigacion" class="form-control" id="lineas_investigacion" placeholder="Líneas de Investigación" required><?php echo $semillero['lineas_investigacion']; ?></textarea>
          </div>

          <div class="mb-3">
            <label for="archivo_presentacion" class="form-label">Archivo de Presentación</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-file"></i></span>
              <input name="archivo_presentacion" class="form-control" id="archivo_presentacion" placeholder="URL del Archivo de Presentación" type="text" required value="<?php echo $semillero['archivo_presentacion']; ?>">
            </div>
          </div>

          <div class="mb-3">
            <label for="fecha_resolucion" class="form-label">Fecha de Resolución</label>
            <input name="fecha_resolucion" class="form-control" id="fecha_resolucion" placeholder="Fecha de Resolución" type="date" required value="<?php echo $semillero['fecha_resolucion']; ?>">
          </div>

          <div class="mb-3">
            <label for="numero_resolucion" class="form-label">Número de Resolución</label>
            <input name="numero_resolucion" class="form-control" id="numero_resolucion" placeholder="Número de Resolución" type="text" required value="<?php echo $semillero['numero_resolucion']; ?>">
          </div>

          <div class="mb-3">
            <label for="archivo_resolucion" class="form-label">Archivo de Resolución</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-file"></i></span>
              <input name="archivo_resolucion" class="form-control" id="archivo_resolucion" placeholder="URL del Archivo de Resolución" type="text" required value="<?php echo $semillero['archivo_resolucion']; ?>">
            </div>
          </div>

          <div class="mb-3">
            <label for="id_coordinador" class="form-label">ID del Coordinador</label>
            <input name="id_coordinador" class="form-control" id="id_coordinador" placeholder="ID del Coordinador" type="text" required value="<?php echo $semillero['id_coordinador']; ?>">
          </div>

          <div class="mb-3">
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="listarSemillero.php" class="btn btn-secondary">Cancelar</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php require 'partials/footer.php' ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
    integrity="sha512-kIe/GWA0+C5piqQTDhM07iF+nr4SV3IgX2r1/K+pNEsfzIgyvQsM2l1rOBF3aHKvCE4tsLjxKwlaT04zxDOL4A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>
