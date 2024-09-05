<?php
require 'database.php';
require 'partials/header.php';

// Verificar si se recibió el código del evento como parámetro
if (!isset($_GET['codigo'])) {
    header('Location: listareventos.php');
    exit();
}

$codigo = $_GET['codigo'];

// Obtener los datos del evento correspondiente al código
$stmt = $conn->prepare("SELECT * FROM evento WHERE codigo = :codigo");
$stmt->bindParam(':codigo', $codigo);
$stmt->execute();
$evento = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar si el evento existe
if (!$evento) {
    header('Location: listareventos.php');
    exit();
}

// Procesar el formulario de edición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $lugar = $_POST['lugar'];
    $tipo = $_POST['tipo'];
    $modalidad = $_POST['modalidad'];
    $clasificacion = $_POST['clasificacion'];
    $observaciones = $_POST['observaciones'];

    // Actualizar los datos del evento en la tabla
    $stmt = $conn->prepare("UPDATE evento SET nombre = :nombre, descripcion = :descripcion, fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin, lugar = :lugar, tipo = :tipo, modalidad = :modalidad, clasificacion = :clasificacion, observaciones = :observaciones WHERE codigo = :codigo");
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':fecha_inicio', $fecha_inicio);
    $stmt->bindParam(':fecha_fin', $fecha_fin);
    $stmt->bindParam(':lugar', $lugar);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':modalidad', $modalidad);
    $stmt->bindParam(':clasificacion', $clasificacion);
    $stmt->bindParam(':observaciones', $observaciones);
    $stmt->bindParam(':codigo', $codigo);
    $stmt->execute();

    // Redireccionar a la página de éxito
    header('Location: listarevento.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Evento</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="card p-3">
            <div class="card-header">Editar Evento</div>
            <div class="card-body">
                <form action="editarEvento.php?codigo=<?= $codigo ?>" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $evento['nombre'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"><?= $evento['descripcion'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="fecha_inicio">Fecha de Inicio</label>
                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?= $evento['fecha_inicio'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_fin">Fecha de Fin</label>
                        <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="<?= $evento['fecha_fin'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="lugar">Lugar</label>
                        <input type="text" class="form-control" id="lugar" name="lugar" value="<?= $evento['lugar'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <input type="text" class="form-control" id="tipo" name="tipo" value="<?= $evento['tipo'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="modalidad">Modalidad</label>
                        <input type="text" class="form-control" id="modalidad" name="modalidad" value="<?= $evento['modalidad'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="clasificacion">Clasificación</label>
                        <input type="text" class="form-control" id="clasificacion" name="clasificacion" value="<?= $evento['clasificacion'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="observaciones">Observaciones</label>
                        <textarea class="form-control" id="observaciones" name="observaciones" rows="3"><?= $evento['observaciones'] ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
