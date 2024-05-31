<?php
require('../config/database.php');

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Preparar y ejecutar la consulta para eliminar el usuario
    $query = "DELETE FROM users WHERE id = $1";
    $result = pg_query_params($conn, $query, array($user_id));

    if ($result) {
        header("Location: list_users.php?status=success");
    } else {
        header("Location: list_users.php?status=error");
    }
} else {
    header("Location: list_users.php?status=error");
}
?>
