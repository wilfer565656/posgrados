<?php
session_start();

require 'database.php';

if (isset($_SESSION['user_identificacion'])) {
    $records = $conn->prepare('SELECT * FROM estudiantes WHERE identificacion = :id');
    $records->bindParam(':id', $_SESSION['user_identificacion']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $userEstu = null;

    if (count($results) > 0) {

        $userEstu = $results;

        $stmt = $conn->query("SELECT * FROM evento");
        $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sql = "SELECT es.id_estudiante, es.id_semillero, e.nombre AS nombre_estudiante, s.nombre AS nombre_semillero
        FROM estudiante_semillero AS es
        INNER JOIN estudiantes AS e ON es.id_estudiante = e.id
        INNER JOIN semillero AS s ON es.id_semillero = s.id
        WHERE e.id = :id_estudiante";

        // Suponiendo que $id_estudiante contiene el ID del estudiante que deseas consultar
        $stmt1 = $conn->prepare($sql);
        $stmt1->bindParam(':id_estudiante', $userEstu['id']);
        $stmt1->execute();

        $resultado = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        // Obtener la lista de proyectos y estudiantes asignados
        $stmt2 = $conn->prepare("SELECT pe.*, p.titulo AS nombre_proyecto, e.nombre AS nombre_estudiante FROM proyecto_estudiante pe 
                                INNER JOIN proyecto p ON pe.id_proyecto = p.codigo 
                                INNER JOIN estudiantes e ON pe.id_estudiante = e.id WHERE pe.id_estudiante= :id_estudiante");
        $stmt2->bindParam(':id_estudiante', $userEstu['id']);
        $stmt2->execute();
        $proyectos_estudiantes = $stmt2->fetchAll(PDO::FETCH_ASSOC);


        $stmtParticipaciones = $conn->prepare("SELECT pe.id_participacion, p.titulo AS proyecto, e.nombre AS estudiante, ev.nombre AS evento, pe.tipo_participacion, pe.calificacion
                                      FROM participacion_evento pe
                                      INNER JOIN proyecto p ON pe.id_proyecto = p.codigo
                                      INNER JOIN estudiantes e ON pe.id_estudiante = e.id
                                      INNER JOIN evento ev ON pe.id_evento = ev.codigo WHERE pe.id_estudiante= :id_estudiante");
        $stmtParticipaciones->bindParam(':id_estudiante', $userEstu['id']);
        $stmtParticipaciones->execute();
        $participaciones = $stmtParticipaciones->fetchAll(PDO::FETCH_ASSOC);





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

    <?php if (!empty($userEstu)): ?>
        <div class="row m-2">
            <h3>Bienvenido,
                <?= $userEstu['nombre']; ?>
            </h3>
            <div class="col-md-3">
                <h4>Fecha de nacimiento :
                    <?= $userEstu['fecha_nacimiento']; ?>
                </h4>
            </div>
            <div class="col-md-3">
                <h4>
                    Dirección :
                    <?= $userEstu['direccion']; ?>

                </h4>
            </div>
            <div class="col-md-3">
                <h4>telefono :
                    <?= $userEstu['telefono']; ?>
                </h4>
            </div>
            <div class="col-md-3">
                <h4>
                    genero :
                    <?= $userEstu['genero']; ?>
                </h4>

            </div>
        </div>
        <div class="row m-2">

            <div class="col-md-3">
                <h4>semestre :
                    <?= $userEstu['fecha_nacimiento']; ?>
                </h4>
            </div>
            <div class="col-md-3">
                <h4>
                    programa:
                    <?= $userEstu['programa_academico']; ?>

                </h4>
            </div>
            <div class="col-md-3">
                <?= isset($resultado['nombre_semillero']) ? $resultado['nombre_semillero'] : 'No asignado'; ?>

            </div>
            <div class="col-md-3">
                <h4>

                    <?php echo '<a href="editarEstudiante.php?id=' . $userEstu['id'] . '" class="btn btn-primary m-2">Editar</a>'; ?>
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
            <div class="card ">
                <div class="card-header">
                    <h2>Proyectos Asignados a Estudiantes</h2>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID Proyecto</th>
                                <th>Nombre Proyecto</th>
                                <th>ID Estudiante</th>
                                <th>Nombre Estudiante</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($proyectos_estudiantes as $pe): ?>
                                <tr>
                                    <td>
                                        <?php echo $pe['id_proyecto']; ?>
                                    </td>
                                    <td>
                                        <?php echo $pe['nombre_proyecto']; ?>
                                    </td>
                                    <td>
                                        <?php echo $pe['id_estudiante']; ?>
                                    </td>
                                    <td>
                                        <?php echo $pe['nombre_estudiante']; ?>
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
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($participaciones as $participacion): ?>
                                <tr>
                                    <td>
                                        <?php echo $participacion['id_participacion']; ?>
                                    </td>
                                    <td>
                                        <?php echo $participacion['proyecto']; ?>
                                    </td>
                                    <td>
                                        <?php echo $participacion['estudiante']; ?>
                                    </td>
                                    <td>
                                        <?php echo $participacion['evento']; ?>
                                    </td>
                                    <td>
                                        <?php echo $participacion['tipo_participacion']; ?>
                                    </td>
                                    <td>
                                        <?php echo $participacion['calificacion']; ?>
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
                <a href="loginEstu.php" class="btn btn-primary m-2">Iniciar sesión </a> o

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