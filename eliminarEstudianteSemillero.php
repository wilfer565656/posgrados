<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_estudiante']) && isset($_GET['id_semillero'])) {
    $id_estudiante = $_GET['id_estudiante'];
    $id_semillero = $_GET['id_semillero'];

    try {
        $stmt = $conn->prepare("DELETE FROM estudiante_semillero WHERE id_estudiante = :id_estudiante AND id_semillero = :id_semillero");
        $stmt->bindParam(':id_estudiante', $id_estudiante);
        $stmt->bindParam(':id_semillero', $id_semillero);
        $stmt->execute();

        // Redireccionar a la página de éxito
        header('Location: listarEstudianteSemillero.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
