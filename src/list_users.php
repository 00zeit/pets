<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Pets | List Users</title>
</head>
<body>
    <center><h1>LIST USERS</h1></center>

    <?php
    if (isset($_GET['status'])): 
        if ($_GET['status'] == 'success'): ?>
            <div class="alert alert-success text-center" role="alert">
                User deleted successfully!
            </div>
            <script>
                // Eliminar el parámetro de la URL después de mostrar el mensaje
                if (history.replaceState) {
                    history.replaceState(null, null, window.location.href.split('?')[0]);
                }
            </script>
        <?php elseif ($_GET['status'] == 'error'): ?>
            <div class="alert alert-danger text-center" role="alert">
                There was an error deleting the user.
            </div>
            <script>
                // Eliminar el parámetro de la URL después de mostrar el mensaje
                if (history.replaceState) {
                    history.replaceState(null, null, window.location.href.split('?')[0]);
                }
            </script>
        <?php endif; 
    endif;
    ?>

    <table class="table table-borderless">
        <tr>
            <th>Fullname</th>
            <th>Email</th>
            <th>Status</th>
            <th>Foto</th>
            <th>Actions</th>
        </tr>
        <?php
        require('../config/database.php');
        $query_users = "
        SELECT 
               id,
               fullname,
               email,
               CASE 
               WHEN status = true THEN 'Active' ELSE 'Inactive' 
               END as status
        FROM users
        ";
        $result = pg_query($conn, $query_users);
        if (!$result) {
            echo "<tr><td colspan='5'>Error fetching users</td></tr>";
        } else {
            while($row = pg_fetch_assoc($result)){
                echo "<tr>";
                    echo "<td>". htmlspecialchars($row['fullname']) ."</td>";
                    echo "<td>". htmlspecialchars($row['email']) ."</td>";
                    echo "<td>". htmlspecialchars($row['status']) ."</td>";
                    echo "<td><img src='photos/usuario_default.png' width='40'></td>";
                    echo "<td>
                        <a href='#'><img src='icons/editar.png' width='40'></a>
                        <a href='backend/delete_user.php?id=". htmlspecialchars($row['id']) ."' onclick='return confirm(\"Are you sure you want to delete this user?\");'><img src='icons/delete.png' width='40'></a>
                     </td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</body>
</html>
