<?php
require 'database.php';

// Obtener la lista de proyectos y sus semilleros
$sql = "SELECT ps.id as id_relacion, p.codigo AS codigo_proyecto, p.titulo AS titulo_proyecto, s.nombre AS nombre_semillero,s.id as id_semillero
        FROM proyecto_semillero ps
        INNER JOIN proyecto p ON ps.id_proyecto = p.codigo
        INNER JOIN semillero s ON ps.id_semillero = s.id";

$stmtProyectosSeminarios = $conn->query($sql);
$proyectosSeminarios = $stmtProyectosSeminarios->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<?php require 'partials/head.php' ?>

<body>
    <?php require 'partials/header.php' ?>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>Proyectos en Semilleros</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Código de Proyecto</th>
                            <th>Título de Proyecto</th>
                            <th>Semillero</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($proyectosSeminarios as $proyectoSeminario): ?>
                            <tr>
                                <td>
                                    <?php echo $proyectoSeminario['codigo_proyecto']; ?>
                                </td>
                                <td>
                                    <?php echo $proyectoSeminario['titulo_proyecto']; ?>
                                </td>
                                <td>
                                    <?php echo $proyectoSeminario['nombre_semillero']; ?>
                                </td>
                                <td>
                                    
                                    <a href="eliminarProyectoSemillero.php?id_relacion=<?php echo $proyectoSeminario['id_relacion']; ?>"
                                        class="btn btn-danger btn-sm">Eliminar</a>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>

</html>