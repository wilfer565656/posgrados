<?php
require 'database.php';
require 'partials/header.php';

// Verificar si se ha proporcionado un ID válido
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Consultar el coordinador con el ID especificado
        $stmt = $conn->prepare("SELECT * FROM coordinador WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $coordinador = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si el coordinador existe
        if (!$coordinador) {
            echo '<div class="alert alert-danger m-4">El coordinador no existe.</div>';
            echo '<a href="listarCoordinador.php" class="btn btn-primary m-4">Volver</a>';
            exit();
        }

        // Procesar el formulario cuando se envía
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos del formulario
            $nombre = $_POST['nombre'];
            $identificacion = $_POST['identificacion'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $correo = $_POST['correo'];
            $genero = $_POST['genero'];
            $fechaNacimiento = $_POST['fecha_nacimiento'];
            $programaAcademico = $_POST['programa_academico'];
            $areasConocimiento = $_POST['areas_conocimiento'];
            $fechaVinculacion = $_POST['fecha_vinculacion'];
            $acuerdoNombramiento = $_POST['acuerdo_nombramiento'];

            // Actualizar los datos del coordinador en la base de datos
            $stmt = $conn->prepare("UPDATE coordinador SET nombre = :nombre, identificacion = :identificacion, direccion = :direccion, telefono = :telefono, correo = :correo, genero = :genero, fecha_nacimiento = :fechaNacimiento, programa_academico = :programaAcademico, areas_conocimiento = :areasConocimiento, fecha_vinculacion = :fechaVinculacion, acuerdo_nombramiento = :acuerdoNombramiento WHERE id = :id");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':identificacion', $identificacion);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':genero', $genero);
            $stmt->bindParam(':fechaNacimiento', $fechaNacimiento);
            $stmt->bindParam(':programaAcademico', $programaAcademico);
            $stmt->bindParam(':areasConocimiento', $areasConocimiento);
            $stmt->bindParam(':fechaVinculacion', $fechaVinculacion);
            $stmt->bindParam(':acuerdoNombramiento', $acuerdoNombramiento);
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
                // Redireccionar al listado de coordinadores después de guardar los cambios
                header('Location: listarCoordinador.php');
                exit();
            } else {
                echo '<div class="alert alert-danger m-4">Error al actualizar el coordinador.</div>';
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Si no se proporciona un ID válido, mostrar un mensaje de error
    echo '<div class="alert alert-danger m-4">ID inválido.</div>';
    echo '<a href="listarCoordinador.php" class="btn btn-primary m-4">Volver</a>';
    exit();
}
?>

<div class="container m-4">
    <h2>Editar Coordinador</h2>

    <form method="POST">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $coordinador['nombre']; ?>" required>
        </div>
        <div class="form-group">
            <label for="identificacion">Identificación:</label>
            <input type="text" class="form-control" id="identificacion" name="identificacion" value="<?php echo $coordinador['identificacion']; ?>" required>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección:</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $coordinador['direccion']; ?>" required>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $coordinador['telefono']; ?>" required>
        </div>
        <div class="form-group">
            <label for="correo">Correo:</label>
            <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $coordinador['correo']; ?>" required>
        </div>
        <div class="form-group">
            <label for="genero">Género:</label>
            <select class="form-control" id="genero" name="genero" required>
                <option value="M" <?php echo $coordinador['genero'] === 'M' ? 'selected' : ''; ?>>Masculino</option>
                <option value="F" <?php echo $coordinador['genero'] === 'F' ? 'selected' : ''; ?>>Femenino</option>
            </select>
        </div>
        <div class="form-group">
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $coordinador['fecha_nacimiento']; ?>" required>
        </div>
        <div class="form-group">
            <label for="programa_academico">Programa Académico:</label>
            <input type="text" class="form-control" id="programa_academico" name="programa_academico" value="<?php echo $coordinador['programa_academico']; ?>" required>
        </div>
        <div class="form-group">
            <label for="areas_conocimiento">Áreas de Conocimiento:</label>
            <textarea class="form-control" id="areas_conocimiento" name="areas_conocimiento" required><?php echo $coordinador['areas_conocimiento']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="fecha_vinculacion">Fecha de Vinculación al Semillero:</label>
            <input type="date" class="form-control" id="fecha_vinculacion" name="fecha_vinculacion" value="<?php echo $coordinador['fecha_vinculacion']; ?>" required>
        </div>
        <div class="form-group">
            <label for="acuerdo_nombramiento">Acuerdo de Nombramiento:</label>
            <input type="text" class="form-control" id="acuerdo_nombramiento" name="acuerdo_nombramiento" value="<?php echo $coordinador['acuerdo_nombramiento']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
        <a href="listarCoordinador.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

