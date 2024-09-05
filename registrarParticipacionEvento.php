<?php
require 'database.php';
require 'partials/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_proyecto = $_POST['id_proyecto'];
    $id_estudiante = $_POST['id_estudiante'];
    $id_evento = $_POST['id_evento'];
    $tipo_participacion = $_POST['tipo_participacion'];
    $calificacion = $_POST['calificacion'];

    // Procesar y guardar archivos
    $archivo_certificacion = '';
    $archivo_evidencias = '';

    if (isset($_FILES['archivo_certificacion']) && $_FILES['archivo_certificacion']['error'] === UPLOAD_ERR_OK) {
        $archivo_certificacion = $_FILES['archivo_certificacion']['name'];
        move_uploaded_file($_FILES['archivo_certificacion']['tmp_name'], 'uploads/' . $archivo_certificacion);
    }

    if (isset($_FILES['archivo_evidencias']) && $_FILES['archivo_evidencias']['error'] === UPLOAD_ERR_OK) {
        $archivo_evidencias = $_FILES['archivo_evidencias']['name'];
        move_uploaded_file($_FILES['archivo_evidencias']['tmp_name'], 'uploads/' . $archivo_evidencias);
    }

    try {
        $stmt = $conn->prepare("INSERT INTO participacion_evento (id_proyecto, id_estudiante, id_evento, tipo_participacion, calificacion, archivo_certificacion, archivo_evidencias)
            VALUES (:id_proyecto, :id_estudiante, :id_evento, :tipo_participacion, :calificacion, :archivo_certificacion, :archivo_evidencias)");
       
        $stmt->bindParam(':id_proyecto', $id_proyecto);
        $stmt->bindParam(':id_estudiante', $id_estudiante);
        $stmt->bindParam(':id_evento', $id_evento);
        $stmt->bindParam(':tipo_participacion', $tipo_participacion);
        $stmt->bindParam(':calificacion', $calificacion);
        $stmt->bindParam(':archivo_certificacion', $archivo_certificacion);
        $stmt->bindParam(':archivo_evidencias', $archivo_evidencias);
        $stmt->execute();

        // Redireccionar a la página de éxito
        header('Location: listarParticipacionEvento.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Obtener la lista de proyectos, estudiantes y eventos para el formulario
$stmtProyectos = $conn->prepare("SELECT codigo, titulo FROM proyecto");
$stmtProyectos->execute();
$proyectos = $stmtProyectos->fetchAll(PDO::FETCH_ASSOC);

$stmtEstudiantes = $conn->prepare("SELECT id, nombre FROM estudiantes");
$stmtEstudiantes->execute();
$estudiantes = $stmtEstudiantes->fetchAll(PDO::FETCH_ASSOC);

$stmtEventos = $conn->prepare("SELECT codigo, nombre FROM evento");
$stmtEventos->execute();
$eventos = $stmtEventos->fetchAll(PDO::FETCH_ASSOC);

// Cerrar la conexión
$conn = null;
?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Registrar Participación en Evento</h2>
        </div>
        <div class="card-body">
            <form action="registrarParticipacionEvento.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="id_proyecto" class="form-label">Proyecto</label>
                    <select class="form-select" id="id_proyecto" name="id_proyecto" required>
                        <?php foreach ($proyectos as $proyecto): ?>
                            <option value="<?php echo $proyecto['codigo']; ?>"><?php echo $proyecto['titulo']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="id_estudiante" class="form-label">Estudiante</label>
                    <select class="form-select" id="id_estudiante" name="id_estudiante" required>
                        <?php foreach ($estudiantes as $estudiante): ?>
                            <option value="<?php echo $estudiante['id']; ?>"><?php echo $estudiante['nombre']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="id_evento" class="form-label">Evento</label>
                    <select class="form-select" id="id_evento" name="id_evento" required>
                        <?php foreach ($eventos as $evento): ?>
                            <option value="<?php echo $evento['codigo']; ?>"><?php echo $evento['nombre']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tipo_participacion" class="form-label">Tipo de Participación</label>
                    <select class="form-select" id="tipo_participacion" name="tipo_participacion" required>
                        <option value="Ponencia">Ponencia</option>
                        <option value="Poster">Poster</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="calificacion" class="form-label">Calificación</label>
                    <input type="number" class="form-control" id="calificacion" name="calificacion" step="0.01" min="0" max="10" required>
                </div>
                <div class="mb-3">
                    <label for="archivo_certificacion" class="form-label">Archivo de Certificación</label>
                    <input type="file" class="form-control" id="archivo_certificacion" name="archivo_certificacion" accept=".pdf">
                </div>
                <div class="mb-3">
                    <label for="archivo_evidencias" class="form-label">Archivos de Evidencias</label>
                    <input type="file" class="form-control" id="archivo_evidencias" name="archivo_evidencias" accept=".pdf">
                </div>
                <button type="submit" class="btn btn-primary">Registrar</button>
            </form>
        </div>
    </div>
</div>
