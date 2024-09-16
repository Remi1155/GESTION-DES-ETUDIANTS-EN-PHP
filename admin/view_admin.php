<?php
require_once '../config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Récupérer les détails de l'utilisateur
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Detail</title>
    <link rel="stylesheet" href="../styles/detail.css">
</head>

<body>
    <div id="container">
        <h2>Admin Details</h2>
        <?php if ($user): ?>
            <p><strong>Admin name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>Password:</strong> <?php echo htmlspecialchars($user['password']); ?></p>
        <?php endif; ?>
        <a href="list_admin.php"><button>Back to User List</button></a>
    </div>
</body>

</html>