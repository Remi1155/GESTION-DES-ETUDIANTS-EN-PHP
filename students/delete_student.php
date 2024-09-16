<?php
// Connexion à la base de données avec PDO

include '../config.php';

try {

    // Récupération de l'ID de l'étudiant depuis l'URL
    $id = $_GET['id'];

    // Préparation de la requête de suppression
    $sql = "DELETE FROM etudiants WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);

    // Exécution de la requête
    if ($stmt->execute()) {
        header("Location: list_students.php");
    } else {
        echo "Erreur lors de la suppression.";
    }

} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>
