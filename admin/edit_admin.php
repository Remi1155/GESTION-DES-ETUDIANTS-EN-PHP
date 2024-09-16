<?php
require_once '../config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {

        $stmt = $pdo->prepare("SELECT * FROM admin WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            echo "User not found";
        }
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Mise à jour de l'utilisateur
        $stmt = $pdo->prepare("UPDATE admin SET name = :name, email = :email, password = :password WHERE id = :id");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: list_admin.php");
            exit();
        } else {
            echo "Error: Could not update user.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="../styles/edit.css">
</head>

<body>
    <div id="container">
        <h1>Edit Admin Info</h1>
        <form action="edit_admin.php?id=<?php echo $id; ?>" method="POST">
            <label for="name">Admin name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="<?php echo htmlspecialchars($user['password']); ?>" required><br><br>

            <input type="submit" value="Update User">
        </form>
        <a href="list_admin.php"><button>Cancel</button></a>
    </div>
</body>

</html>