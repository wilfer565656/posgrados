<?php
require 'database.php';
require 'partials/header.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los datos del proyecto con el ID especificado
    $stmt = $conn->prepare("SELECT * FROM proyecto WHERE codigo = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $proyecto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$proyecto) {
        die("Proyecto no encontrado");
    }
} else {
    die("ID de proyecto no especificado");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados por el formulario
    $titulo = $_POST['titulo'];
    $tipo_proyecto = $_POST['tipo_proyecto'];
    $estado = $_POST['estado'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_finalizacion = $_POST['fecha_finalizacion'];

    // Actualizar los datos del proyecto en la base de datos
    $stmt = $conn->prepare("UPDATE proyecto SET titulo = :titulo, tipo_proyecto = :tipo_proyecto, estado = :estado, fecha_inicio = :fecha_inicio, fecha_finalizacion = :fecha_finalizacion WHERE codigo = :id");
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':tipo_proyecto', $tipo_proyecto);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':fecha_inicio', $fecha_inicio);
    $stmt->bindParam(':fecha_finalizacion', $fecha_finalizacion);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        // Redirigir a la página de lista de proyectos
        header('Location: listarProyectos.php');
        exit();
    } else {
        die("Error al actualizar el proyecto");
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
    <title>Editar Proyecto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="card p-3">
            <div class="card-header">Editar Proyecto</div>
            <div class="card-body">
                <form action="editarProyecto.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $proyecto['titulo']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="tipo_proyecto" class="form-label">Tipo de Proyecto</label>
                        <input type="text" class="form-control" id="tipo_proyecto" name="tipo_proyecto" value="<?php echo $proyecto['tipo_proyecto']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-check"></i></span>
                            <select name="estado" class="form-select" id="estado" required>
                                <option value="Activo" <?php if ($proyecto['estado'] == 'Activo') { echo 'selected'; } ?>>Activo</option>
                                <option value="Inactivo" <?php if ($proyecto['estado'] == 'Inactivo') { echo 'selected'; } ?>>Inactivo</option>
                                <option value="En Progreso" <?php if ($proyecto['estado'] == 'En Progreso') { echo 'selected'; } ?>>En Progreso</option>
                                <option value="Completado" <?php if ($proyecto['estado'] == 'Completado') { echo 'selected'; } ?>>Completado</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo $proyecto['fecha_inicio']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_finalizacion" class="form-label">Fecha de Finalización</label>
                        <input type="date" class="form-control" id="fecha_finalizacion" name="fecha_finalizacion" value="<?php echo $proyecto['fecha_finalizacion']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="archivo_propuesta" class="form-label">Archivo de Propuesta</label>
                        <input type="file" class="form-control" id="archivo_propuesta" name="archivo_propuesta" accept=".pdf">
                    </div>
                    <div class="mb-3">
                        <label for="archivo_proyecto_final" class="form-label">Archivo de Proyecto Final</label>
                        <input type="file" class="form-control" id="archivo_proyecto_final" name="archivo_proyecto_final" accept=".pdf">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
