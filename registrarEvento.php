<?php
require 'database.php';
require 'partials/header.php';

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

    try {
        $stmt = $conn->prepare("INSERT INTO evento (nombre, descripcion, fecha_inicio, fecha_fin, lugar, tipo, modalidad, clasificacion, observaciones)
            VALUES (:nombre, :descripcion, :fecha_inicio, :fecha_fin, :lugar, :tipo, :modalidad, :clasificacion, :observaciones)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio);
        $stmt->bindParam(':fecha_fin', $fecha_fin);
        $stmt->bindParam(':lugar', $lugar);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':modalidad', $modalidad);
        $stmt->bindParam(':clasificacion', $clasificacion);
        $stmt->bindParam(':observaciones', $observaciones);
        $stmt->execute();

        // Redireccionar a la página de éxito
        header('Location: listarEvento.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Cerrar la conexión
$conn = null;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Evento</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="card p-3">
            <div class="card-header">Registrar Evento</div>
            <div class="card-body">
                <form action="registrarevento.php" method="POST">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                        <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                    </div>
                    <div class="mb-3">
                        <label for="lugar" class="form-label">Lugar</label>
                        <input type="text" class="form-control" id="lugar" name="lugar" required>
                    </div>
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <input type="text" class="form-control" id="tipo" name="tipo" required>
                    </div>
                    <div class="mb-3">
                        <label for="modalidad" class="form-label">Modalidad</label>
                        <input type="text" class="form-control" id="modalidad" name="modalidad" required>
                    </div>
                    <div class="mb-3">
                        <label for="clasificacion" class="form-label">Clasificación</label>
                        <input type="text" class="form-control" id="clasificacion" name="clasificacion" required>
                    </div>
                    <div class="mb-3">
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <textarea class="form-control" id="observaciones" name="observaciones" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
