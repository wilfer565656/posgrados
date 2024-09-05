<?php
require 'database.php';
require 'partials/header.php';

// Obtener los parámetros de la URL
$id_estudiante = $_GET['id_estudiante'];
$id_semillero = $_GET['id_semillero'];

// Consulta SQL para obtener los datos del estudiante en el semillero
$sql = "SELECT es.id_estudiante, es.id_semillero, e.nombre AS nombre_estudiante, s.nombre AS nombre_semillero
        FROM estudiante_semillero AS es
        INNER JOIN estudiantes AS e ON es.id_estudiante = e.id
        INNER JOIN semillero AS s ON es.id_semillero = s.id
        WHERE es.id_estudiante = :id_estudiante AND es.id_semillero = :id_semillero";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_estudiante', $id_estudiante);
$stmt->bindParam(':id_semillero', $id_semillero);
$stmt->execute();

$registro = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$registro) {
    echo "No se encontraron datos para este estudiante en este semillero.";
    exit();
}

// Si el formulario es enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Realizar las acciones de edición aquí
    // ...

    // Redireccionar a la página de éxito
    header('Location: listarEstudianteSemillero.php');
    exit();
}
?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2>Editar Estudiante en Semillero</h2>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="id_estudiante" class="form-label">ID Estudiante</label>
                    <input type="text" class="form-control" id="id_estudiante" name="id_estudiante" value="<?php echo $registro['id_estudiante']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="id_semillero" class="form-label">ID Semillero</label>
                    <input type="text" class="form-control" id="id_semillero" name="id_semillero" value="<?php echo $registro['id_semillero']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="nombre_estudiante" class="form-label">Nombre del Estudiante</label>
                    <input type="text" class="form-control" id="nombre_estudiante" name="nombre_estudiante" value="<?php echo $registro['nombre_estudiante']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="nombre_semillero" class="form-label">Nombre del Semillero</label>
                    <input type="text" class="form-control" id="nombre_semillero" name="nombre_semillero" value="<?php echo $registro['nombre_semillero']; ?>" readonly>
                </div>
                <!-- Agregar los campos de edición aquí -->
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </form>
        </div>
    </div>
</div>


