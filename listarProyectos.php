<?php
require 'database.php';
require 'partials/header.php';

try {
    // Consultar la tabla proyecto
    $stmt = $conn->query("SELECT * FROM proyecto");
    $proyectos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<table class="table table-striped m-4">';
    echo '<thead>
        <tr>
            
            <th>Código</th>
            <th>Título</th>
            <th>Tipo de Proyecto</th>
            <th>Estado</th>
            <th>Fecha de Inicio</th>
            <th>Fecha de Finalización</th>
            <th>Archivo de Propuesta</th>
            <th>Archivo de Proyecto Final</th>
            <th>Acciones</th>
        </tr>
    </thead>';
    echo '<tbody>';
    foreach ($proyectos as $proyecto) {
        echo '<tr>';
       
        echo '<td>' . $proyecto['codigo'] . '</td>';
        echo '<td>' . $proyecto['titulo'] . '</td>';
        echo '<td>' . $proyecto['tipo_proyecto'] . '</td>';
        echo '<td>' . $proyecto['estado'] . '</td>';
        echo '<td>' . $proyecto['fecha_inicio'] . '</td>';
        echo '<td>' . $proyecto['fecha_finalizacion'] . '</td>';
        echo '<td>' . $proyecto['archivo_propuesta'] . '</td>';
        echo '<td>' . $proyecto['archivo_proyecto_final'] . '</td>';

        echo '<td>';
        echo '<a href="editarProyecto.php?id=' . $proyecto['codigo'] . '" class="btn btn-primary m-2">Editar</a>';
        echo '<a href="eliminarProyecto.php?id=' . $proyecto['codigo'] . '" class="btn btn-danger m-2">Eliminar</a>';
        echo '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Cerrar la conexión
$conn = null;
?>
