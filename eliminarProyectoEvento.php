<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['codigo_proyecto']) && isset($_GET['codigo_evento'])) {
    $codigo_proyecto = $_GET['codigo_proyecto'];
    $codigo_evento = $_GET['codigo_evento'];

    // Eliminar la relación entre el proyecto y el evento
    $stmtEliminar = $conn->prepare("DELETE FROM proyecto_evento WHERE codigo_proyecto = :codigo_proyecto AND codigo_evento = :codigo_evento");
    $stmtEliminar->bindParam(':codigo_proyecto', $codigo_proyecto);
    $stmtEliminar->bindParam(':codigo_evento', $codigo_evento);

    if ($stmtEliminar->execute()) {
        // Redirigir a la página de listado de proyectos con eventos
        header("Location: listarProyecto_evento.php");
        exit();
    } else {
        $error_message = "Error al eliminar la relación entre el proyecto y el evento";
    }
} else {
    header("Location: listarProyecto_eventos.php");
    exit();
}
?>
