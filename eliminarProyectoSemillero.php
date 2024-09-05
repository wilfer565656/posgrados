<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_relacion'])) {
    $id_relacion = $_GET['id_relacion'];

    // Obtener información de la relación proyecto_semillero
    $stmtRelacion = $conn->prepare("SELECT * FROM proyecto_semillero WHERE id = :id_relacion");
    $stmtRelacion->bindParam(':id_relacion', $id_relacion);
    $stmtRelacion->execute();
    $relacion = $stmtRelacion->fetch(PDO::FETCH_ASSOC);

    if ($relacion) {
        // Eliminar la relación de proyecto_semillero
        $stmtEliminar = $conn->prepare("DELETE FROM proyecto_semillero WHERE id = :id_relacion");
        $stmtEliminar->bindParam(':id_relacion', $id_relacion);

        if ($stmtEliminar->execute()) {
            // Redirigir a la página de listado de proyectos en semilleros
            header("Location: listarProyectoSemiLlero.php");
            exit();
        } else {
            $error_message = "Error al eliminar la relación proyecto-semillero";
        }
    } else {
        header("Location: listarProyectoSemillero.php");
        exit();
    }
} else {
    header("Location: listarProyectoSemillero.php");
    exit();
}
?>
