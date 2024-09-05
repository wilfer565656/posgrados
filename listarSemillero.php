<?php
require 'database.php';
require 'partials/header.php';

try {
    // Consultar la tabla semillero
    $stmt = $conn->query("SELECT * FROM semillero");
    $semilleros = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<table class="table table-striped m-4">';
    echo '<thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Logo</th>
            <th>Descripción</th>
            <th>Misión</th>
            <th>Visión</th>
            <th>Valores</th>
            <th>Objetivos</th>
            <th>Líneas de Investigación</th>
            <th>Archivo de Presentación</th>
            <th>Fecha de Resolución</th>
            <th>Número de Resolución</th>
            <th>Archivo de Resolución</th>
            <th>ID Coordinador</th>
            <th>Acciones</th>
        </tr>
    </thead>';
    echo '<tbody>';
    foreach ($semilleros as $semillero) {
        echo '<tr>';
        echo '<td>' . $semillero['id'] . '</td>';
        echo '<td>' . $semillero['nombre'] . '</td>';
        echo '<td>' . $semillero['correo'] . '</td>';
        echo '<td><img src="' . $semillero['logo'] . '" alt="" width="100"></td>';
        echo '<td>' . $semillero['descripcion'] . '</td>';
        echo '<td>' . $semillero['mision'] . '</td>';
        echo '<td>' . $semillero['vision'] . '</td>';
        echo '<td>' . $semillero['valores'] . '</td>';
        echo '<td>' . $semillero['objetivos'] . '</td>';
        echo '<td>' . $semillero['lineas_investigacion'] . '</td>';
        echo '<td>' . $semillero['archivo_presentacion'] . '</td>';
        echo '<td>' . $semillero['fecha_resolucion'] . '</td>';
        echo '<td>' . $semillero['numero_resolucion'] . '</td>';
        echo '<td>' . $semillero['archivo_resolucion'] . '</td>';
        echo '<td>' . $semillero['id_coordinador'] . '</td>';

        echo '<td>';
        echo '<a href="editarSemillero.php?id=' . $semillero['id'] . '" class="btn btn-primary m-2">Editar</a>';
        echo '<a href="eliminarSemillero.php?id=' . $semillero['id'] . '" class="btn btn-danger m-2">Eliminar</a>';
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
