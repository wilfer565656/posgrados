<?php
require 'database.php';
require 'partials/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo_proyecto = $_POST['codigo_proyecto'];
    $codigo_evento = $_POST['codigo_evento'];

    try {
        $stmt = $conn->prepare("INSERT INTO proyecto_evento (codigo_proyecto, codigo_evento) VALUES (:codigo_proyecto, :codigo_evento)");
        $stmt->bindParam(':codigo_proyecto', $codigo_proyecto);
        $stmt->bindParam(':codigo_evento', $codigo_evento);
        $stmt->execute();

        // Redireccionar a la página de éxito
        header('Location: listarProyecto_evento.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Obtener la lista de proyectos y eventos para el formulario
$stmtProyectos = $conn->prepare("SELECT codigo, titulo FROM proyecto");
$stmtProyectos->execute();
$proyectos = $stmtProyectos->fetchAll(PDO::FETCH_ASSOC);

$stmtEventos = $conn->prepare("SELECT codigo, nombre FROM evento");
$stmtEventos->execute();
$eventos = $stmtEventos->fetchAll(PDO::FETCH_ASSOC);

// Cerrar la conexión
$conn = null;
?>
<div class="container">




    <div class="card">

        <div class="card-header">
            <h2>Registrar Proyecto que paricipara en Evento</h2>

        </div>
        <div class="card-body">
            <form action="registrarProyecto_evento.php" method="POST">
                <div class="mb-3">
                    <label for="codigo_proyecto" class="form-label">Proyecto</label>
                    <select class="form-select" id="codigo_proyecto" name="codigo_proyecto" required>
                        <?php foreach ($proyectos as $proyecto): ?>
                            <option value="<?php echo $proyecto['codigo']; ?>"><?php echo $proyecto['titulo']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="codigo_evento" class="form-label">Evento</label>
                    <select class="form-select" id="codigo_evento" name="codigo_evento" required>
                        <?php foreach ($eventos as $evento): ?>
                            <option value="<?php echo $evento['codigo']; ?>"><?php echo $evento['nombre']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Registrar</button>
            </form>

        </div>
    </div>


</div>