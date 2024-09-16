<?php
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    try {
        $stmt = $pdo->prepare("INSERT INTO admin (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $password]);

        $echo = htmlspecialchars("User added successfully");
    } catch (PDOException $e) {
        $echo = "Erreur: " . $e->getMessage() . "";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="../styles/edit.css">
</head>

<body>
    <div id="container">
        <h1>Add New Admin</h1>
        <form action="add_admin.php" method="POST">
            <label for="name">Username:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>

            <input type="submit" value="Add User">
        </form>
        <a href="list_admin.php"><button>Back to Admin List</button></a>
        <?php
        if (!empty($echo)) {
            echo $echo;
        }
        ?>
    </div>
</body>

</html>