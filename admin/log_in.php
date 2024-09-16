<?php
session_start();
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Préparation de la requête SQL
        $stmt = $pdo->prepare("SELECT * FROM admin WHERE name = :name AND email = :email");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Vérification du mot de passe
            if ($password == $user['password']){
                $_SESSION['name'] = $user['name']; // Stockage de la session
                header("Location: list_admin.php"); // Redirection vers la page de bienvenue
                header("Location: ../students/list_students.php");
                exit();
            } else {
                echo "Invalid password!";
            }
        } else {
            echo "Invalid username or email!";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

}
