<?php
// Connexion à la base de données avec PDO

include '../config.php';

try {

    // Récupération des données du formulaire
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $parcours = $_POST['parcours'];
    $sexe = $_POST['sexe'];
    $date_naissance = $_POST['date_naissance'];
    $adresse = $_POST['adresse'];

    // Préparation de la requête de mise à jour
    $sql = "UPDATE etudiants SET nom = :nom, prenom = :prenom, id_parcours = :parcours, sexe = :sexe, date_naissance = :date_naissance, adresse = :adresse WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    // Liaison des paramètres
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':parcours', $parcours);
    $stmt->bindParam(':sexe', $sexe);
    $stmt->bindParam(':date_naissance', $date_naissance);
    $stmt->bindParam(':adresse', $adresse);
    $stmt->bindParam(':id', $id);

    // Exécution de la requête
    if ($stmt->execute()) {
        header("Location: list_students.php");
    } else {
        echo "Erreur lors de la mise à jour.";
    }

} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>
