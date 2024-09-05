<?php
require 'database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los datos del estudiante con el ID especificado
    $stmt = $conn->prepare("SELECT * FROM estudiantes WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $estudiante = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$estudiante) {
        die("Estudiante no encontrado");
    }
} else {
    die("ID de estudiante no especificado");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados por el formulario
    $nombre = $_POST['nombre'];
    $identificacion = $_POST['identificacion'];
    $codigo_estudiantil = $_POST['codigo_estudiantil'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $genero = $_POST['genero'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $semestre = $_POST['semestre'];
    $foto = isset($_POST['foto']) ? $_POST['foto'] : '';
    $archivo_matricula = isset($_POST['archivo_matricula']) ? $_POST['archivo_matricula'] : '';

    $programa_academico = $_POST['programa_academico'];
    $fecha_vinculacion_semillero = $_POST['fecha_vinculacion_semillero'];
    $estado = $_POST['estado'];

    // Actualizar los datos del estudiante en la base de datos
    $stmt = $conn->prepare("UPDATE estudiantes SET nombre = :nombre, identificacion = :identificacion, codigo_estudiantil = :codigo_estudiantil, direccion = :direccion, telefono = :telefono, correo = :correo, genero = :genero, fecha_nacimiento = :fecha_nacimiento, semestre = :semestre, foto = :foto, archivo_matricula = :archivo_matricula, programa_academico = :programa_academico, fecha_vinculacion_semillero = :fecha_vinculacion_semillero, estado = :estado WHERE id = :id");
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':identificacion', $identificacion);
    $stmt->bindParam(':codigo_estudiantil', $codigo_estudiantil);
    $stmt->bindParam(':direccion', $direccion);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':genero', $genero);
    $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $stmt->bindParam(':semestre', $semestre);
    $stmt->bindParam(':foto', $foto);
    $stmt->bindParam(':archivo_matricula', $archivo_matricula);
    $stmt->bindParam(':programa_academico', $programa_academico);
    $stmt->bindParam(':fecha_vinculacion_semillero', $fecha_vinculacion_semillero);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        // Redirigir a la página de lista de estudiantes
        header('Location: logout.php');
    } else {
        die("Error al actualizar el estudiante");
    }
}

// Cerrar la conexión
$conn = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Estudiante</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="card p-3">
            <div class="card-header">Editar Estudiante</div>
            <div class="card-body">
                <form method="post" action="editarEstudiante.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                            <input name="nombre" class="form-control" id="nombre" placeholder="Nombre" type="text"
                                value="<?php echo $estudiante['nombre']; ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="identificacion" class="form-label">Identificación</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                            <input name="identificacion" class="form-control" id="identificacion"
                                placeholder="Identificación" type="text"
                                value="<?php echo $estudiante['identificacion']; ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="codigo_estudiantil" class="form-label">Código Estudiantil</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-graduation-cap"></i></span>
                            <input name="codigo_estudiantil" class="form-control" id="codigo_estudiantil"
                                placeholder="Código Estudiantil" type="text"
                                value="<?php echo $estudiante['codigo_estudiantil']; ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                            <input name="direccion" class="form-control" id="direccion" placeholder="Dirección"
                                type="text" value="<?php echo $estudiante['direccion']; ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-phone"></i></span>
                            <input name="telefono" class="form-control" id="telefono" placeholder="Teléfono" type="text"
                                value="<?php echo $estudiante['telefono']; ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                            <input name="correo" class="form-control" id="correo" placeholder="Correo" type="email"
                                value="<?php echo $estudiante['correo']; ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="genero" class="form-label">Género</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-venus-mars"></i></span>
                            <select name="genero" class="form-control" id="genero" required>
                                <option value="Masculino" <?php if ($estudiante['genero'] == 'Masculino')
                                    echo 'selected'; ?>>Masculino</option>
                                <option value="Femenino" <?php if ($estudiante['genero'] == 'Femenino')
                                    echo 'selected'; ?>>Femenino</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            <input name="fecha_nacimiento" class="form-control" id="fecha_nacimiento"
                                placeholder="Fecha de Nacimiento" type="date"
                                value="<?php echo $estudiante['fecha_nacimiento']; ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="semestre" class="form-label">Semestre</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-graduation-cap"></i></span>
                            <input name="semestre" class="form-control" id="semestre" placeholder="Semestre"
                                type="number" value="<?php echo $estudiante['semestre']; ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-image"></i></span>
                            <input name="foto" class="form-control-file" id="foto" type="file">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="archivo_matricula" class="form-label">Archivo de Matrícula</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-file"></i></span>
                            <input name="archivo_matricula" class="form-control-file" id="archivo_matricula"
                                type="file">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="programa_academico" class="form-label">Programa Académico</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-book"></i></span>
                            <input name="programa_academico" class="form-control" id="programa_academico"
                                placeholder="Programa Académico" type="text"
                                value="<?php echo $estudiante['programa_academico']; ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_vinculacion_semillero" class="form-label">Fecha de Vinculación al
                            Semillero</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            <input name="fecha_vinculacion_semillero" class="form-control"
                                id="fecha_vinculacion_semillero" placeholder="Fecha de Vinculación al Semillero"
                                type="date" value="<?php echo $estudiante['fecha_vinculacion_semillero']; ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-check-circle"></i></span>
                            <select name="estado" class="form-control" id="estado" required>
                                <option value="Activo" <?php if ($estudiante['estado'] == 'Activo')
                                    echo 'selected'; ?>>
                                    Activo</option>
                                <option value="Inactivo" <?php if ($estudiante['estado'] == 'Inactivo')
                                    echo 'selected'; ?>>Inactivo</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>