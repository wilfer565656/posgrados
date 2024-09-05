<?php
require 'database.php';

// Obtener la lista de proyectos y semilleros para mostrar en los select
$stmtProyectos = $conn->query("SELECT codigo, titulo FROM proyecto");
$proyectos = $stmtProyectos->fetchAll(PDO::FETCH_ASSOC);

$stmtSemilleros = $conn->query("SELECT id, nombre FROM semillero");
$semilleros = $stmtSemilleros->fetchAll(PDO::FETCH_ASSOC);

// Manejo del formulario de registro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_proyecto = $_POST['id_proyecto'];
    $id_semillero = $_POST['id_semillero'];

    // Insertar la relación en la tabla proyecto_semillero
    $stmt = $conn->prepare("INSERT INTO proyecto_semillero (id_proyecto, id_semillero) VALUES (:id_proyecto, :id_semillero)");
    $stmt->bindParam(':id_proyecto', $id_proyecto);
    $stmt->bindParam(':id_semillero', $id_semillero);

    if ($stmt->execute()) {
        // Redirigir a alguna página de éxito
        header("Location: index.php");
        exit();
    } else {
        $error_message = "Error al registrar el proyecto en el semillero";
    }
}
?>

<!DOCTYPE html>
<html>
<?php require 'partials/head.php' ?>

<body>
    <?php require 'partials/header.php' ?>

    <div class="container mt-5">
        <h2>Registrar Proyecto en Semillero</h2>
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        <form method="post">
            <div class="mb-3">
                <label for="id_proyecto" class="form-label">Seleccione el Proyecto</label>
                <select class="form-select" name="id_proyecto" required>
                    <option value="" disabled selected>Seleccione un proyecto</option>
                    <?php foreach ($proyectos as $proyecto): ?>
                        <option value="<?= $proyecto['codigo'] ?>"><?= $proyecto['titulo'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_semillero" class="form-label">Seleccione el Semillero</label>
                <select class="form-select" name="id_semillero" required>
                    <option value="" disabled selected>Seleccione un semillero</option>
                    <?php foreach ($semilleros as $semillero): ?>
                        <option value="<?= $semillero['id'] ?>"><?= $semillero['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
