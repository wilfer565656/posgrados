<?php
require 'database.php';

// Verificar si se ha recibido el parámetro 'id' en la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Aquí iría la lógica para eliminar el estudiante con el ID proporcionado

    // Ejemplo de código para eliminar un estudiante usando la conexión a la base de datos
    try {
        // Preparar la consulta SQL para eliminar el estudiante
        $consulta = $conn->prepare('DELETE FROM coordinador WHERE id = :id');

        // Asignar el valor del parámetro 'id' a la consulta
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);

        // Ejecutar la consulta
        $consulta->execute();

        // Redireccionar a la página de listado de estudiantes después de eliminar exitosamente
        header('Location: listarCoordinador.php');
        exit();
    } catch (PDOException $e) {
        // Manejo de errores en caso de que ocurra un problema con la base de datos
        echo "Error: " . $e->getMessage();
    }
} else {
    // Redireccionar a la página de listado de estudiantes si no se proporciona el parámetro 'id'
    header('Location: listarCoordinador.php');
    exit();
}
?>
