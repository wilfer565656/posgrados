<?php
require 'database.php';
require 'partials/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo = $_POST['titulo'];
    $tipo_proyecto = $_POST['tipo_proyecto'];
    $estado = $_POST['estado'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_finalizacion = $_POST['fecha_finalizacion'];

    // Procesar y guardar archivos
    $archivo_propuesta = '';
    $archivo_proyecto_final = '';

    if (isset($_FILES['archivo_propuesta']) && $_FILES['archivo_propuesta']['error'] === UPLOAD_ERR_OK) {
        $archivo_propuesta = $_FILES['archivo_propuesta']['name'];
        move_uploaded_file($_FILES['archivo_propuesta']['tmp_name'], 'uploads/' . $archivo_propuesta);
    }

    if (isset($_FILES['archivo_proyecto_final']) && $_FILES['archivo_proyecto_final']['error'] === UPLOAD_ERR_OK) {
        $archivo_proyecto_final = $_FILES['archivo_proyecto_final']['name'];
        move_uploaded_file($_FILES['archivo_proyecto_final']['tmp_name'], 'uploads/' . $archivo_proyecto_final);
    }

    // Insertar los datos en la tabla proyecto
    try {
        $stmt = $conn->prepare("INSERT INTO proyecto ( titulo, tipo_proyecto, estado, fecha_inicio, fecha_finalizacion, archivo_propuesta, archivo_proyecto_final)
            VALUES ( :titulo, :tipo_proyecto, :estado, :fecha_inicio, :fecha_finalizacion, :archivo_propuesta, :archivo_proyecto_final)");

        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':tipo_proyecto', $tipo_proyecto);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio);
        $stmt->bindParam(':fecha_finalizacion', $fecha_finalizacion);
        $stmt->bindParam(':archivo_propuesta', $archivo_propuesta);
        $stmt->bindParam(':archivo_proyecto_final', $archivo_proyecto_final);
        $stmt->execute();

        // Redireccionar a la página de éxito
        header('Location: listarProyectos.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Cerrar la conexión
$conn = null;
?>

<h2>Registrar Proyecto</h2>
<div class="container">



    <form action="registrarProyecto.php" method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>
        <div class="mb-3">
            <label for="tipo_proyecto" class="form-label">Tipo de Proyecto</label>
            <input type="text" class="form-control" id="tipo_proyecto" name="tipo_proyecto" required>
        </div>
        <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-check"></i></span>
                            <select name="estado" class="form-select" id="estado" required>
                                <option value="Activo" >Activo</option>
                                <option value="Inactivo" >Inactivo</option>
                                <option value="En Progreso" >En Progreso</option>
                                <option value="Completado" >Completado</option>
                            </select>
                        </div>
                    </div>
        <div class="mb-3">
            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
        </div>
        <div class="mb-3">
            <label for="fecha_finalizacion" class="form-label">Fecha de Finalización</label>
            <input type="date" class="form-control" id="fecha_finalizacion" name="fecha_finalizacion" required>
        </div>
        <div class="mb-3">
            <label for="archivo_propuesta" class="form-label">Archivo de Propuesta</label>
            <input type="file" class="form-control" id="archivo_propuesta" name="archivo_propuesta" accept=".pdf">
        </div>
        <div class="mb-3">
            <label for="archivo_proyecto_final" class="form-label">Archivo de Proyecto Final</label>
            <input type="file" class="form-control" id="archivo_proyecto_final" name="archivo_proyecto_final"
                accept=".pdf">
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>