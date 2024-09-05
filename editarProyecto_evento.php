<?php
require 'database.php';
require 'partials/header.php';

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo_proyecto = $_POST['codigo_proyecto'];
    $codigo_evento = $_POST['codigo_evento'];

    try {
        // Actualizar la asociación entre proyecto y evento en la base de datos
        $stmt = $conn->prepare("UPDATE proyecto_evento SET codigo_proyecto = :codigo_proyecto WHERE codigo_evento = :codigo_evento");
        $stmt->bindParam(':codigo_proyecto', $codigo_proyecto);
        $stmt->bindParam(':codigo_evento', $codigo_evento);
        $stmt->execute();

        // Redireccionar a la página de éxito
        header('Location: listarProyectos_eventos.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Obtener la asociación proyecto-evento actual
$codigo_proyecto = $_GET['codigo_proyecto'];
$codigo_evento = $_GET['codigo_evento'];

// Obtener los datos del proyecto
$stmtProyecto = $conn->prepare("SELECT codigo, titulo FROM proyecto WHERE codigo = :codigo_proyecto");
$stmtProyecto->bindParam(':codigo_proyecto', $codigo_proyecto);
$stmtProyecto->execute();
$proyecto = $stmtProyecto->fetch(PDO::FETCH_ASSOC);

// Obtener los datos del evento
$stmtEvento = $conn->prepare("SELECT codigo, nombre FROM evento WHERE codigo = :codigo_evento");
$stmtEvento->bindParam(':codigo_evento', $codigo_evento);
$stmtEvento->execute();
$evento = $stmtEvento->fetch(PDO::FETCH_ASSOC);

// Cerrar la conexión
$conn = null;
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Editar Proyecto en Evento</h2>
        </div>
        <div class="card-body">
            <form action="editarProyecto_evento.php" method="POST">
                <div class="mb-3">
                    <label for="codigo_proyecto" class="form-label">Proyecto</label>
                    <input type="text" class="form-control" id="codigo_proyecto" name="codigo_proyecto" value="<?php echo $proyecto['codigo']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="codigo_evento" class="form-label">Evento</label>
                    <input type="text" class="form-control" id="codigo_evento" name="codigo_evento" value="<?php echo $evento['codigo']; ?>" readonly>
                </div>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </form>
        </div>
    </div>
</div>
