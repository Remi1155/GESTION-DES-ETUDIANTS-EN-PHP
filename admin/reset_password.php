<?php
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    try {
        // Recherche de l'utilisateur
        $stmt = $pdo->prepare("SELECT * FROM admin WHERE name = :name AND email = :email");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {

            $password = $user['password'];

            // Envoyer un email
            $to = $email;
            $subject = "Password Recovery";
            $message = "Hello " . $name . ", your password is: " . $password;
            $headers = "From: admin@admin.com\r\n";

            if (mail($to, $subject, $message, $headers)) {
                $echo = "Password sent to your email!";
            } else {
                $echo = "Failed to send email.";
            }
        } else {
            echo "Invalid name or email!";
        }
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }

    $pdo = null;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../styles/edit.css">
</head>

<body>
    <div id="container">
        <h2>Reset Password</h2>
        <form action="./reset_password.php" method="POST">
            <label for="name">Username:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <input type="submit" value="Send Password">
        </form>
        <a href="../index.html"><button>Back</button></a>
        <?php
        if (!empty($echo)) {
            echo $echo; 
        }
        ?>
    </div>
</body>

</html>