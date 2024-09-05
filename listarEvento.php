<?php
require 'database.php';
require 'partials/header.php';

// Obtener todos los eventos de la tabla
$stmt = $conn->query("SELECT * FROM evento");
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Eventos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="card p-3">
            <div class="card-header">Lista de Eventos</div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Fecha de Inicio</th>
                            <th>Fecha de Fin</th>
                            <th>Lugar</th>
                            <th>Tipo</th>
                            <th>Modalidad</th>
                            <th>Clasificación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($eventos as $evento) : ?>
                            <tr>
                                <td><?= $evento['codigo'] ?></td>
                                <td><?= $evento['nombre'] ?></td>
                                <td><?= $evento['fecha_inicio'] ?></td>
                                <td><?= $evento['fecha_fin'] ?></td>
                                <td><?= $evento['lugar'] ?></td>
                                <td><?= $evento['tipo'] ?></td>
                                <td><?= $evento['modalidad'] ?></td>
                                <td><?= $evento['clasificacion'] ?></td>
                                <td>
                                    <a href="editarEvento.php?codigo=<?= $evento['codigo'] ?>" class="btn btn-primary btn-sm">Editar</a>
                                    <a href="eliminarEvento.php?codigo=<?= $evento['codigo'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
