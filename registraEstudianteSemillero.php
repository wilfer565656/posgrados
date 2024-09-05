<?php
require 'database.php';
require 'partials/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_estudiante = $_POST['id_estudiante'];
    $id_semillero = $_POST['id_semillero'];

    try {
        $stmt = $conn->prepare("INSERT INTO estudiante_semillero (id_estudiante, id_semillero) VALUES (:id_estudiante, :id_semillero)");
        $stmt->bindParam(':id_estudiante', $id_estudiante);
        $stmt->bindParam(':id_semillero', $id_semillero);
        $stmt->execute();

        // Redireccionar a la página de éxito
        header('Location: listarEstudianteSemillero.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Obtener la lista de estudiantes y semilleros para el formulario
$stmtEstudiantes = $conn->prepare("SELECT id, nombre FROM estudiantes");
$stmtEstudiantes->execute();
$estudiantes = $stmtEstudiantes->fetchAll(PDO::FETCH_ASSOC);

$stmtSemilleros = $conn->prepare("SELECT id, nombre FROM semillero");
$stmtSemilleros->execute();
$semilleros = $stmtSemilleros->fetchAll(PDO::FETCH_ASSOC);

// Cerrar la conexión
$conn = null;
?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Registrar Estudiante en Semillero</h2>
        </div>
        <div class="card-body">
            <form action="registraEstudianteSemillero.php" method="POST">
                <div class="mb-3">
                    <label for="id_estudiante" class="form-label">Estudiante</label>
                    <select class="form-select" id="id_estudiante" name="id_estudiante" required>
                        <?php foreach ($estudiantes as $estudiante): ?>
                            <option value="<?php echo $estudiante['id']; ?>"><?php echo $estudiante['nombre']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="id_semillero" class="form-label">Semillero</label>
                    <select class="form-select" id="id_semillero" name="id_semillero" required>
                        <?php foreach ($semilleros as $semillero): ?>
                            <option value="<?php echo $semillero['id']; ?>"><?php echo $semillero['nombre']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Registrar</button>
            </form>
        </div>
    </div>
</div>
