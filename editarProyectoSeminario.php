<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['codigo_proyecto']) && isset($_GET['id_semillero'])) {
    $codigo_proyecto = $_GET['codigo_proyecto'];
    $id_semillero = $_GET['id_semillero'];

    // Obtener información del proyecto y semillero
    $stmtProyecto = $conn->prepare("SELECT * FROM proyecto WHERE codigo = :codigo_proyecto");
    $stmtProyecto->bindParam(':codigo_proyecto', $codigo_proyecto);
    $stmtProyecto->execute();
    $proyecto = $stmtProyecto->fetch(PDO::FETCH_ASSOC);

    $stmtSemillero = $conn->prepare("SELECT * FROM semillero WHERE id = :id_semillero");
    $stmtSemillero->bindParam(':id_semillero', $id_semillero);
    $stmtSemillero->execute();
    $semillero = $stmtSemillero->fetch(PDO::FETCH_ASSOC);

    // Manejo del formulario de edición
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nuevo_codigo = $_POST['nuevo_codigo'];
        $nuevo_titulo = $_POST['nuevo_titulo'];

        // Actualizar la información del proyecto
        $stmtActualizar = $conn->prepare("UPDATE proyecto SET codigo = :nuevo_codigo, titulo = :nuevo_titulo WHERE codigo = :codigo_proyecto");
        $stmtActualizar->bindParam(':nuevo_codigo', $nuevo_codigo);
        $stmtActualizar->bindParam(':nuevo_titulo', $nuevo_titulo);
        $stmtActualizar->bindParam(':codigo_proyecto', $codigo_proyecto);

        if ($stmtActualizar->execute()) {
            // Redirigir a la página de listado de proyectos en semilleros
            header("Location: listarProyectosSeminario.php");
            exit();
        } else {
            $error_message = "Error al actualizar la información del proyecto";
        }
    }
} else {
    header("Location: listarProyectosSeminario.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<?php require 'partials/head.php' ?>

<body>
    <?php require 'partials/header.php' ?>

    <div class="container mt-5">
        <h2>Editar Proyecto en Semillero</h2>
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        <form method="post">
            <div class="mb-3">
                <label for="nuevo_codigo" class="form-label">Nuevo Código del Proyecto</label>
                <input type="text" class="form-control" name="nuevo_codigo" value="<?= $proyecto['codigo']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nuevo_titulo" class="form-label">Nuevo Título del Proyecto</label>
                <input type="text" class="form-control" name="nuevo_titulo" value="<?= $proyecto['titulo']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
