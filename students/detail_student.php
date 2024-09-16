<?php
// Connexion à la base de données avec PDO
include '../config.php';

try {
    // Récupération de l'ID de l'étudiant depuis l'URL
    $id = $_GET['id'];

    // Préparation de la requête pour récupérer les informations de l'étudiant
    $sql = "SELECT etudiants.*, parcours.nom_parcours FROM etudiants JOIN parcours ON etudiants.id_parcours = parcours.id WHERE etudiants.id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    // Vérification si l'étudiant existe
    if ($stmt->rowCount() == 0) {
        echo "Étudiant non trouvé.";
        exit;
    }

    $student = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'étudiant</title>
    <link rel="stylesheet" href="../styles/detail.css">
</head>

<body>
    <div id="container">
        <h1>Détails de l'étudiant</h1>
        <p><strong>Nom:</strong> <?= htmlspecialchars($student['nom']) ?></p>
        <p><strong>Prénom(s):</strong> <?= htmlspecialchars($student['prenom']) ?></p>
        <p><strong>Parcours:</strong> <?= htmlspecialchars($student['nom_parcours']) ?></p>
        <p><strong>Sexe:</strong> <?= htmlspecialchars($student['sexe']) ?></p>
        <p><strong>Date de naissance:</strong> <?= htmlspecialchars($student['date_naissance']) ?></p>
        <p><strong>Adresse:</strong> <?= htmlspecialchars($student['adresse']) ?></p>

        <!-- Bouton retour à la liste des étudiants -->
        <a href="list_students.php" class="button"><button>Retour à la liste des étudiants</button></a>
    </div>

</body>

</html>