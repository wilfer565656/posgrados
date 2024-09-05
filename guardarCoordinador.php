<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtener los datos del formulario
  $nombre = $_POST['nombre'];
  $identificacion = $_POST['identificacion'];
  $direccion = $_POST['direccion'];
  $telefono = $_POST['telefono'];
  $correo = $_POST['correo'];
  $genero = $_POST['genero'];
  $foto = $_POST['foto'];
  $fecha_nacimiento = $_POST['fecha_nacimiento'];
  $programa_academico = $_POST['programa_academico'];
  $areas_conocimiento = $_POST['areas_conocimiento'];
  $fecha_vinculacion = $_POST['fecha_vinculacion'];
  $acuerdo_nombramiento = $_POST['acuerdo_nombramiento'];

  // Insertar los datos en la base de datos utilizando PDO
  $sql = "INSERT INTO coordinador (nombre, identificacion, direccion, telefono, correo, genero, foto, fecha_nacimiento, programa_academico, areas_conocimiento, fecha_vinculacion, acuerdo_nombramiento) 
          VALUES (:nombre, :identificacion, :direccion, :telefono, :correo, :genero, :foto, :fecha_nacimiento, :programa_academico, :areas_conocimiento, :fecha_vinculacion, :acuerdo_nombramiento)";
  
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':nombre', $nombre);
  $stmt->bindParam(':identificacion', $identificacion);
  $stmt->bindParam(':direccion', $direccion);
  $stmt->bindParam(':telefono', $telefono);
  $stmt->bindParam(':correo', $correo);
  $stmt->bindParam(':genero', $genero);
  $stmt->bindParam(':foto', $foto);
  $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
  $stmt->bindParam(':programa_academico', $programa_academico);
  $stmt->bindParam(':areas_conocimiento', $areas_conocimiento);
  $stmt->bindParam(':fecha_vinculacion', $fecha_vinculacion);
  $stmt->bindParam(':acuerdo_nombramiento', $acuerdo_nombramiento);
  
  if ($stmt->execute()) {
    // Registro exitoso, redireccionar a la página de éxito
    header('Location: listarCoordinador.php');
    exit();
  } else {
    // Error al insertar en la base de datos, mostrar mensaje de error
    echo 'Error: ' . $stmt->errorInfo()[2];
  }
}

$conn = null; // Cerrar la conexión a la base de datos
?>
