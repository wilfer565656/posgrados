<?php
require 'database.php';
require 'partials/header.php';

// Obtener la lista de proyectos y estudiantes asignados
$stmt = $conn->prepare("SELECT pe.*, p.titulo AS nombre_proyecto, e.nombre AS nombre_estudiante FROM proyecto_estudiante pe 
                       INNER JOIN proyecto p ON pe.id_proyecto = p.codigo 
                       INNER JOIN estudiantes e ON pe.id_estudiante = e.id");
$stmt->execute();
$proyectos_estudiantes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Cerrar la conexión
$conn = null;
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Proyectos Asignados a Estudiantes</h2>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID Proyecto</th>
                        <th>Nombre Proyecto</th>
                        <th>ID Estudiante</th>
                        <th>Nombre Estudiante</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($proyectos_estudiantes as $pe): ?>
                        <tr>
                            <td><?php echo $pe['id_proyecto']; ?></td>
                            <td><?php echo $pe['nombre_proyecto']; ?></td>
                            <td><?php echo $pe['id_estudiante']; ?></td>
                            <td><?php echo $pe['nombre_estudiante']; ?></td>
                            <td>
                                <a href="eliminarProyectoEstudiante.php?id_proyecto=<?php echo $pe['id_proyecto']; ?>&id_estudiante=<?php echo $pe['id_estudiante']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
