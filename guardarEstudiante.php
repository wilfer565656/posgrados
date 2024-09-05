<?php
require_once('partials/header.php');
require_once('database.php');

// Obtener los datos del formulario
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

try {
    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO estudiantes (nombre, identificacion, codigo_estudiantil, direccion, telefono, correo, genero, fecha_nacimiento, semestre, foto, archivo_matricula, programa_academico, fecha_vinculacion_semillero, estado) 
            VALUES (:nombre, :identificacion, :codigo_estudiantil, :direccion, :telefono, :correo, :genero, :fecha_nacimiento, :semestre, :foto, :archivo_matricula, :programa_academico, :fecha_vinculacion_semillero, :estado)";

    // Preparar la consulta para su ejecución
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros con los valores
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

    // Ejecutar la consulta
    if ($stmt->execute()) {
        header('Location: listarEstudiante.php');

    } else {
        echo "Error al guardar los datos.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Cerrar la conexión
$conn = null;
?>
 