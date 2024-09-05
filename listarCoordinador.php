<?php
require 'database.php';
require 'partials/header.php';

try {
    // Consultar la tabla coordinador
    $stmt = $conn->query("SELECT * FROM coordinador");
    $coordinadores = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<table class="table table-striped m-4">';
    echo '<thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Identificación</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>Género</th>
            <th>Foto</th>
            <th>Fecha de Nacimiento</th>
            <th>Programa Académico</th>
            <th>Áreas de Conocimiento</th>
            <th>Fecha de Vinculación al Semillero</th>
            <th>Acuerdo de Nombramiento</th>
            <th>Acciones</th>
        </tr>
    </thead>';
    echo '<tbody>';
    foreach ($coordinadores as $coordinador) {
        echo '<tr>';
        echo '<td>' . $coordinador['id'] . '</td>';
        echo '<td>' . $coordinador['nombre'] . '</td>';
        echo '<td>' . $coordinador['identificacion'] . '</td>';
        echo '<td>' . $coordinador['direccion'] . '</td>';
        echo '<td>' . $coordinador['telefono'] . '</td>';
        echo '<td>' . $coordinador['correo'] . '</td>';
        echo '<td>' . $coordinador['genero'] . '</td>';
        echo '<td><img src="assets/img/' . $coordinador['foto'] . '" alt="" width="100"></td>';
        echo '<td>' . $coordinador['fecha_nacimiento'] . '</td>';
        echo '<td>' . $coordinador['programa_academico'] . '</td>';
        echo '<td>' . $coordinador['areas_conocimiento'] . '</td>';
        echo '<td>' . $coordinador['fecha_vinculacion'] . '</td>';
        echo '<td>' . $coordinador['acuerdo_nombramiento'] . '</td>';

        echo '<td>';
        echo '<a href="editarCoordinador.php?id=' . $coordinador['id'] . '" class="btn btn-primary m-2">Editar</a>';
        echo '<a href="eliminarCoordinador.php?id=' . $coordinador['id'] . '" class="btn btn-danger m-2">Eliminar</a>';
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
