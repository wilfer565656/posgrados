<?php
require 'database.php';

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$logo = $_POST['logo'];
$descripcion = $_POST['descripcion'];
$mision = $_POST['mision'];
$vision = $_POST['vision'];
$valores = $_POST['valores'];
$objetivos = $_POST['objetivos'];
$lineas_investigacion = $_POST['lineas_investigacion'];
$archivo_presentacion = $_POST['archivo_presentacion'];
$fecha_resolucion = $_POST['fecha_resolucion'];
$numero_resolucion = $_POST['numero_resolucion'];
$archivo_resolucion = $_POST['archivo_resolucion'];
$id_coordinador = $_POST['id_coordinador'];

try {
    // Insertar los datos en la tabla 'semillero'
    $stmt = $conn->prepare("INSERT INTO semillero (nombre, correo, logo, descripcion, mision, vision, valores, objetivos, lineas_investigacion, archivo_presentacion, fecha_resolucion, numero_resolucion, archivo_resolucion, id_coordinador)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$nombre, $correo, $logo, $descripcion, $mision, $vision, $valores, $objetivos, $lineas_investigacion, $archivo_presentacion, $fecha_resolucion, $numero_resolucion, $archivo_resolucion, $id_coordinador]);
    header('Location: listarSemillero.php');
    
} catch (PDOException $e) {
    echo "Error al registrar el semillero: " . $e->getMessage();
}

// Cerrar la conexión
$conn = null;
?>
