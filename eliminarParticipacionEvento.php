<?php
require 'database.php';
require 'partials/header.php';

if (isset($_GET['id_participacion'])) {
    $id_participacion = $_GET['id_participacion'];

    try {
        $stmt = $conn->prepare("DELETE FROM participacion_evento WHERE id_participacion = :id_participacion");
        $stmt->bindParam(':id_participacion', $id_participacion);
        $stmt->execute();

        // Redireccionar a la página de éxito
        header('Location: listarParticipacionEvento.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header('Location: listarParticipacionEvento.php');
    exit();
}

// Cerrar la conexión
$conn = null;
?>
