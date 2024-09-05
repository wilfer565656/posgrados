<?php
require 'database.php';
require 'partials/header.php';
try {
    // Consultar la tabla estudiantes
    $stmt = $conn->query("SELECT * FROM estudiantes");
    $estudiantes = $stmt->fetchAll(PDO::FETCH_ASSOC);


    echo '<table class="table table-striped m-4">';
    echo '<thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Identificación</th>
            <th>Programa</th>
            <th>Código Estudiantil</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>Foto</th>
            <th>Acciones</th>
        </tr>
    </thead>';
    echo '<tbody>';
    foreach ($estudiantes as $estudiante) {
        echo '<tr>';
        echo '<td>' . $estudiante['id'] . '</td>';
        echo '<td>' . $estudiante['nombre'] . '</td>';
        echo '<td>' . $estudiante['identificacion'] . '</td>';
        echo '<td>' . $estudiante['programa_academico'] . '</td>';
        echo '<td>' . $estudiante['codigo_estudiantil'] . '</td>';
        echo '<td>' . $estudiante['telefono'] . '</td>';
        echo '<td>' . $estudiante['correo'] . '</td>';
        echo '<td><img src="assets/img/' . $estudiante['foto'] . '" alt="" width="100"></td>';

        echo '<td>';
        echo '<a href="editarEstudiante.php?id=' . $estudiante['id'] . '" class="btn btn-primary m-2">Editar</a>';
        echo '<a href="eliminar.php?id=' . $estudiante['id'] . '" class="btn btn-danger m-2">Eliminar</a>';
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