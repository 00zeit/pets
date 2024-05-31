<?php
require('../../config/database.php'); // Asegúrate de que esta ruta es correcta

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Preparar y ejecutar la consulta para eliminar el usuario
    $query = "DELETE FROM users WHERE id = $1";
    $result = pg_query_params($conn, $query, array($user_id));

    if ($result) {
        // Redirigir con un estado de éxito
        header("Location: ../list_users.php?status=success");
        exit(); // Asegúrate de salir después de la redirección
    } else {
        // Redirigir con un estado de error
        header("Location: ../list_users.php?status=error");
        exit(); // Asegúrate de salir después de la redirección
    }
} else {
    // Redirigir con un estado de error si no se proporciona el ID
    header("Location: ../list_users.php?status=error");
    exit(); // Asegúrate de salir después de la redirección
}
?>