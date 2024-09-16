<?php
include '../config.php';

try {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $parcours = $_POST['parcours'];
    $sexe = $_POST['sexe'];
    $date_naissance = $_POST['date_naissance'];
    $adresse = $_POST['adresse'];

    // Préparation de la requête d'insertion avec des paramètres
    $sql = "INSERT INTO etudiants (nom, prenom, id_parcours, sexe, date_naissance, adresse)
            VALUES (:nom, :prenom, :parcours, :sexe, :date_naissance, :adresse)";

    // Préparation de la requête avec PDO
    $stmt = $pdo->prepare($sql);

    // Liaison des paramètres avec les valeurs récupérées du formulaire
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':parcours', $parcours);
    $stmt->bindParam(':sexe', $sexe);
    $stmt->bindParam(':date_naissance', $date_naissance);
    $stmt->bindParam(':adresse', $adresse);

    // Exécution de la requête
    if ($stmt->execute()) {
        // Redirection vers la liste des étudiants si l'insertion est réussie
        header("Location: list_students.php");
    } else {
        echo "Erreur lors de l'insertion des données.";
    }

} catch (PDOException $e) {
    // En cas d'erreur, afficher le message
    echo "Erreur de connexion : " . $e->getMessage();
}
?>
