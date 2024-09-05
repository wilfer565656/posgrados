<?php
require 'database.php';

// Verificar si se recibió el código del evento como parámetro
if (!isset($_GET['codigo'])) {
    header('Location: listarEvento.php');
    exit();
}

$codigo = $_GET['codigo'];

// Eliminar el evento de la tabla
$stmt = $conn->prepare("DELETE FROM evento WHERE codigo = :codigo");
$stmt->bindParam(':codigo', $codigo);
$stmt->execute();

// Redireccionar a la página de éxito
header('Location: listarEvento.php');
exit();
?>
