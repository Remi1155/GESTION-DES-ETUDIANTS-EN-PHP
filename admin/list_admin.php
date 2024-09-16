<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: login_form.php");
    exit();
}

require_once '../config.php';

try {

    $stmt = $pdo->prepare("SELECT * FROM admin");
    $stmt->execute();

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" href="../styles/list.css">
</head>

<body>
    <div id="container">
        <h2>Welcome <?php $_SESSION['name'] ?></h2>

        <!-- Bouton pour ajouter un utilisateur -->
        <a href="./add_admin.php"><button>Add Admin</button></a>
        <!-- Bouton pour se deconnecter -->
        <a href="../students/list_students.php"><button>Back to students list</button></a>


        <!-- Tableau listant les utilisateurs -->
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>Admin name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>

            <?php
            if (count($users) > 0) {
                foreach ($users as $user) {
                    echo "<tr>
                    <td>" . htmlspecialchars($user['name']) . "</td>
                    <td>" . htmlspecialchars($user['email']) . "</td>
                    <td>
                        <a href='delete_admin.php?id=" . $user['id'] . "' onclick='return confirm(\"Are you sure you want to delete this user?\");'>
                            <button>Delete</button>
                        </a>
                        <a href='view_admin.php?id=" . $user['id'] . "' ><button>Detail</button></a>
                        <a href='edit_admin.php?id=" . $user['id'] . "'><button>Edit</button></a>
                    </td>
                  </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No users found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>

<?php
$conn = null; // Fermer la connexion à la base de données
?>