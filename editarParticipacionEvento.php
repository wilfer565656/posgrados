<?php
require 'database.php';
require 'partials/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_participacion = $_POST['id_participacion'];
    $calificacion = $_POST['calificacion'];
    // Agrega aquí la actualización de los demás campos de la participación
    $archivo_certificacion = $_POST['archivo_certificacion'];
    $archivo_evidencias = $_POST['archivo_evidencias'];

    try {
        $stmt = $conn->prepare("UPDATE participacion_evento SET calificacion = :calificacion, archivo_certificacion = :archivo_certificacion, archivo_evidencias = :archivo_evidencias WHERE id_participacion = :id_participacion");
        $stmt->bindParam(':calificacion', $calificacion);
        // Agrega aquí los bindParam de los demás campos de la participación
        $stmt->bindParam(':archivo_certificacion', $archivo_certificacion);
        $stmt->bindParam(':archivo_evidencias', $archivo_evidencias);
        $stmt->bindParam(':id_participacion', $id_participacion);
        $stmt->execute();

        // Redireccionar a la página de éxito
        header('Location: listarParticipacionEvento.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    if (isset($_GET['id_participacion'])) {
        $id_participacion = $_GET['id_participacion'];

        try {
            $stmtParticipacion = $conn->prepare("SELECT * FROM participacion_evento WHERE id_participacion = :id_participacion");
            $stmtParticipacion->bindParam(':id_participacion', $id_participacion);
            $stmtParticipacion->execute();
            $participacion = $stmtParticipacion->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        header('Location: listarParticipacionEvento.php');
        exit();
    }
}

// Cerrar la conexión
$conn = null;
?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Editar Participación en Evento</h2>
        </div>
        <div class="card-body">
            <form action="editarParticipacionEvento.php" method="POST">
                <input type="hidden" name="id_participacion" value="<?php echo $participacion['id_participacion']; ?>">
                <div class="mb-3">
                    <label for="calificacion" class="form-label">Calificación</label>
                    <input type="number" step="0.01" class="form-control" id="calificacion" name="calificacion" value="<?php echo $participacion['calificacion']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="archivo_certificacion" class="form-label">Archivo de Certificación</label>
                    <input type="text" class="form-control" id="archivo_certificacion" name="archivo_certificacion" value="<?php echo $participacion['archivo_certificacion']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="archivo_evidencias" class="form-label">Archivo de Evidencias</label>
                    <input type="text" class="form-control" id="archivo_evidencias" name="archivo_evidencias" value="<?php echo $participacion['archivo_evidencias']; ?>" required>
                </div>
                <!-- Agrega aquí los campos adicionales de la participación -->
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </form>
        </div>
    </div>
</div>
