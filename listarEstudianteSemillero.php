<?php
require 'database.php';
require 'partials/header.php';

// Consulta SQL para obtener la lista de estudiantes en semilleros
$sql = "SELECT es.id_estudiante, es.id_semillero, e.nombre AS nombre_estudiante, s.nombre AS nombre_semillero
        FROM estudiante_semillero AS es
        INNER JOIN estudiantes AS e ON es.id_estudiante = e.id
        INNER JOIN semillero AS s ON es.id_semillero = s.id";
$resultado = $conn->query($sql);

if (!$resultado) {
    echo "Error: " . $conn->error;
}

?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2>Lista de Estudiantes en Semilleros</h2>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID Estudiante</th>
                        <th>ID Semillero</th>
                        <th>Nombre del Estudiante</th>
                        <th>Nombre del Semillero</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <td><?php echo $registro['id_estudiante']; ?></td>
                            <td><?php echo $registro['id_semillero']; ?></td>
                            <td><?php echo $registro['nombre_estudiante']; ?></td>
                            <td><?php echo $registro['nombre_semillero']; ?></td>
                            <td>
                                
                                <a href="eliminarEstudianteSemillero.php?id_estudiante=<?php echo $registro['id_estudiante']; ?>&id_semillero=<?php echo $registro['id_semillero']; ?>"
                                    class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


