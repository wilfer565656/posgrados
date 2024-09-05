<?php
require 'database.php';
require 'partials/header.php';

// Obtener la lista de proyectos con sus eventos relacionados
$stmt = $conn->prepare("SELECT proyecto.codigo, proyecto.titulo, proyecto_evento.codigo_evento, evento.nombre AS nombre_evento
                       FROM proyecto
                       INNER JOIN proyecto_evento ON proyecto.codigo = proyecto_evento.codigo_proyecto
                       INNER JOIN evento ON proyecto_evento.codigo_evento = evento.codigo");
$stmt->execute();
$proyectos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Cerrar la conexión
$conn = null;
?>

<h2>Listar Proyectos con Eventos</h2>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Código proyecto</th>
            <th scope="col">Código evento</th>
            <th scope="col">proyecto</th>
            <th scope="col">Evento</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($proyectos as $proyecto): ?>
            <tr>
                <td>
                    <?php echo $proyecto['codigo']; ?>
                </td>
                <td>
                    <?php echo $proyecto['codigo_evento']; ?>
                </td>
                <td>
                    <?php echo $proyecto['titulo']; ?>
                </td>
                <td>
                    <?php echo $proyecto['nombre_evento']; ?>
                </td>
                <td>
                    <a href="eliminarProyectoEvento.php?codigo_proyecto=<?php echo $proyecto['codigo']; ?>&codigo_evento=<?php echo $proyecto['codigo_evento']; ?>"
                        class="btn btn-danger btn-sm">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
