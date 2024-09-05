<?php
require 'database.php';
require 'partials/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_proyecto = $_POST['id_proyecto'];
    $id_estudiante = $_POST['id_estudiante'];

    try {
        $stmt = $conn->prepare("UPDATE proyecto_estudiante SET id_proyecto = :id_proyecto WHERE id_estudiante = :id_estudiante");
        $stmt->bindParam(':id_proyecto', $id_proyecto);
        $stmt->bindParam(':id_estudiante', $id_estudiante);
        $stmt->execute();

        // Redireccionar a la página de éxito
        header('Location: listarProyectoEstudiante.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Obtener la lista de proyectos y estudiantes para el formulario
$stmtProyectos = $conn->prepare("SELECT codigo, titulo FROM proyecto");
$stmtProyectos->execute();
$proyectos = $stmtProyectos->fetchAll(PDO::FETCH_ASSOC);

$stmtEstudiantes = $conn->prepare("SELECT id, nombre FROM estudiantes");
$stmtEstudiantes->execute();
$estudiantes = $stmtEstudiantes->fetchAll(PDO::FETCH_ASSOC);

// Cerrar la conexión
$conn = null;
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Editar Proyecto de Estudiante</h2>
        </div>
        <div class="card-body">
            <form action="editarProyectoEstudiante.php" method="POST">
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
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </form>
        </div>
    </div>
</div>
