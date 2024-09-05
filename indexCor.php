<?php
session_start();

require 'database.php';

if (isset($_SESSION['user_identificacionC'])) {
    $records = $conn->prepare('SELECT * FROM coordinador WHERE identificacion = :id');
    $records->bindParam(':id', $_SESSION['user_identificacionC']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $userCor = null;

    if (count($results) > 0) {

        $userCor = $results;

        $stmt = $conn->query("SELECT * FROM evento");
        $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt1 = $conn->prepare('SELECT * FROM semillero WHERE id_coordinador = :id');
        $stmt1->bindParam(':id', $userCor['id']);
        $stmt1->execute();
        $semilleros = $stmt1->fetchAll(PDO::FETCH_ASSOC);

        // Consulta SQL para obtener la lista de estudiantes en semilleros
        $sql = $conn->prepare("SELECT es.id_estudiante, es.id_semillero, e.nombre AS nombre_estudiante, s.nombre AS nombre_semillero
                FROM estudiante_semillero AS es
                INNER JOIN estudiantes AS e ON es.id_estudiante = e.id
                INNER JOIN semillero AS s ON es.id_semillero = s.id
                WHERE s.id_coordinador = :id_coordinador");

        $sql->bindParam(':id_coordinador', $userCor['id']);
        $sql->execute();


        // Obtener la lista de proyectos con sus eventos relacionados
        $stmt2 = $conn->prepare("SELECT proyecto.codigo, proyecto.titulo, GROUP_CONCAT(evento.nombre SEPARATOR ', ') 
        AS eventos FROM proyecto LEFT JOIN proyecto_evento ON proyecto.codigo = proyecto_evento.codigo_proyecto 
        LEFT JOIN evento ON proyecto_evento.codigo_evento = evento.codigo GROUP BY proyecto.codigo, proyecto.titulo");
        $stmt2->execute();
        $proyectos = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        $sql2 = "SELECT p.codigo AS codigo_proyecto, p.titulo AS titulo_proyecto, s.nombre AS nombre_semillero
        FROM proyecto_semillero ps
        INNER JOIN proyecto p ON ps.id_proyecto = p.codigo
        INNER JOIN semillero s ON ps.id_semillero = s.id
        WHERE s.id_coordinador = :id_coordinador;";
        $stmt = $conn->prepare($sql2);
        $stmt->bindParam(':id_coordinador', $userCor['id']);
        $stmt->execute();
        $proyectos_semillero = $stmt->fetchAll(PDO::FETCH_ASSOC);




        // Cerrar la conexión
        $conn = null;


    }
    // Obtener todos los eventos de la tabla

}
?>

<!DOCTYPE html>
<html>
<?php require 'partials/head.php' ?>

<body>
    <?php require 'partials/header.php' ?>

    <?php if (!empty($userCor)): ?>
        <div class="row m-2">
            <h3>Bienvenido,
                <?= $userCor['nombre']; ?>
            </h3>
            <div class="col-md-3">
                <h4>Fecha de nacimiento:
                    <?= $userCor['fecha_nacimiento']; ?>
                </h4>
            </div>
            <div class="col-md-3">
                <h4>
                    Dirección :
                    <?= $userCor['direccion']; ?>

                </h4>
            </div>
            <div class="col-md-3">
                <h4>telefono :
                    <?= $userCor['telefono']; ?>
                </h4>
            </div>
            <div class="col-md-3">
                <h4>
                    genero :
                    <?= $userCor['genero']; ?>
                </h4>

            </div>


        </div>

        <div class="container m-4">
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

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($eventos as $evento): ?>
                                <tr>
                                    <td>
                                        <?= $evento['codigo'] ?>
                                    </td>
                                    <td>
                                        <?= $evento['nombre'] ?>
                                    </td>
                                    <td>
                                        <?= $evento['fecha_inicio'] ?>
                                    </td>
                                    <td>
                                        <?= $evento['fecha_fin'] ?>
                                    </td>
                                    <td>
                                        <?= $evento['lugar'] ?>
                                    </td>
                                    <td>
                                        <?= $evento['tipo'] ?>
                                    </td>
                                    <td>
                                        <?= $evento['modalidad'] ?>
                                    </td>
                                    <td>
                                        <?= $evento['clasificacion'] ?>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="container m-4">
            <div class="card p-3">
                <div class="card-header"> proyectos para ponencia en eventos </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Código</th>
                                <th scope="col">Título</th>
                                <th scope="col">Eventos</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($proyectos as $proyecto): ?>
                                <tr>
                                    <td>
                                        <?php echo $proyecto['codigo']; ?>
                                    </td>
                                    <td>
                                        <?php echo $proyecto['titulo']; ?>
                                    </td>
                                    <td>
                                        <?php echo $proyecto['eventos']; ?>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <div class="container m-4">
            <div class="card m-1">
                <div class="card-header">
                    <h2>Semilleros</h2>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>correo</th>
                                <th>Descripción</th>
                                <th>linea inv</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($semilleros as $semillero): ?>
                                <tr>
                                    <td>
                                        <?php echo $semillero['id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $semillero['nombre']; ?>
                                    </td>
                                    <td>
                                        <?php echo $semillero['correo']; ?>
                                    </td>

                                    <td>
                                        <?php echo $semillero['descripcion']; ?>
                                    </td>
                                    <td>
                                        <?php echo $semillero['lineas_investigacion']; ?>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>







        <div class="container m-4">
            <div class="card">
                <div class="card-header">
                    <h2>Lista de Estudiantes en Semilleros</h2>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID Estudiante</th>
                                <th>ID Semillero</th>
                                <th>Nombre del Estudiante</th>
                                <th>Nombre del Semillero</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($registro = $sql->fetch(PDO::FETCH_ASSOC)): ?>
                                <tr>
                                    <td>
                                        <?php echo $registro['id_estudiante']; ?>
                                    </td>
                                    <td>
                                        <?php echo $registro['id_semillero']; ?>
                                    </td>
                                    <td>
                                        <?php echo $registro['nombre_estudiante']; ?>
                                    </td>
                                    <td>
                                        <?php echo $registro['nombre_semillero']; ?>
                                    </td>

                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="container m-4">
            <div class="card">
                <div class="card-headr">
                    <h2>Proyectos en Semilleros del Coordinador</h2>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Código del Proyecto</th>
                                <th>Título del Proyecto</th>
                                <th>Nombre del Semillero</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($proyectos_semillero as $proyecto_semillero): ?>
                                <tr>
                                    <td>
                                        <?= $proyecto_semillero['codigo_proyecto']; ?>
                                    </td>
                                    <td>
                                        <?= $proyecto_semillero['titulo_proyecto']; ?>
                                    </td>
                                    <td>
                                        <?= $proyecto_semillero['nombre_semillero']; ?>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>



        </div>





    <?php else: ?>
        <div class="container text-center mt-5">
            <h1>Para continuar</h1>
            <p>
                <a href="loginCor.php" class="btn btn-primary m-2">Iniciar sesión </a> o

            </p>
        </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
</body>

</html>