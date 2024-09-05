<?php
require 'database.php';
require 'partials/header.php';

// Obtener la lista de participaciones en eventos
$stmtParticipaciones = $conn->prepare("SELECT pe.id_participacion, p.titulo AS proyecto, e.nombre AS estudiante, ev.nombre AS evento, pe.tipo_participacion, pe.calificacion
                                      FROM participacion_evento pe
                                      INNER JOIN proyecto p ON pe.id_proyecto = p.codigo
                                      INNER JOIN estudiantes e ON pe.id_estudiante = e.id
                                      INNER JOIN evento ev ON pe.id_evento = ev.codigo");
$stmtParticipaciones->execute();
$participaciones = $stmtParticipaciones->fetchAll(PDO::FETCH_ASSOC);

// Cerrar la conexión
$conn = null;
?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Listado de Participaciones en Eventos</h2>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Proyecto</th>
                        <th>Estudiante</th>
                        <th>Evento</th>
                        <th>Tipo de Participación</th>
                        <th>Calificación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($participaciones as $participacion): ?>
                        <tr>
                            <td><?php echo $participacion['id_participacion']; ?></td>
                            <td><?php echo $participacion['proyecto']; ?></td>
                            <td><?php echo $participacion['estudiante']; ?></td>
                            <td><?php echo $participacion['evento']; ?></td>
                            <td><?php echo $participacion['tipo_participacion']; ?></td>
                            <td><?php echo $participacion['calificacion']; ?></td>
                            <td>
                                <a href="editarParticipacionEvento.php?id_participacion=<?php echo $participacion['id_participacion']; ?>"
                                    class="btn btn-primary btn-sm">Editar</a>
                                <a href="eliminarParticipacionEvento.php?id_participacion=<?php echo $participacion['id_participacion']; ?>"
                                    class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
