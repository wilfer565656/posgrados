<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_proyecto']) && isset($_GET['id_estudiante'])) {
    $id_proyecto = $_GET['id_proyecto'];
    $id_estudiante = $_GET['id_estudiante'];

    try {
        $stmt = $conn->prepare("DELETE FROM proyecto_estudiante WHERE id_proyecto = :id_proyecto AND id_estudiante = :id_estudiante");
        $stmt->bindParam(':id_proyecto', $id_proyecto);
        $stmt->bindParam(':id_estudiante', $id_estudiante);
        $stmt->execute();

        // Redireccionar a la página de éxito
        header('Location: listarProyectoEstudiante.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    die("Acceso inválido");
}

// Cerrar la conexión
$conn = null;
?>
