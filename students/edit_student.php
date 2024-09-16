<?php
// Connexion à la base de données avec PDO
include '../config.php';

try {
  // Récupération de l'ID de l'étudiant depuis l'URL
  $id = $_GET['id'];

  // Préparation de la requête pour récupérer les informations de l'étudiant
  $sql = "SELECT * FROM etudiants WHERE id = :id";
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
  <title>Modifier l'étudiant</title>
  <link rel="stylesheet" href="../styles/edit.css">
</head>

<body>
  <div id="container">
    <h1>Modifier l'étudiant</h1>
    <form action="update_student.php" method="POST">

      <input type="hidden" name="id" value="<?= $student['id'] ?>">

      <!-- Nom -->
      <label for="nom">Nom:</label>
      <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($student['nom']) ?>" required>

      <!-- Prénom -->
      <label for="prenom">Prénom(s):</label>
      <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($student['prenom']) ?>" required>

      <!-- Parcours -->
      <label for="parcours">Parcours:</label>
      <select id="parcours" name="parcours" required>
        <?php
        // Récupérer les parcours pour le menu déroulant
        $query = "SELECT id, nom_parcours FROM parcours";
        $parcoursStmt = $pdo->query($query);
        while ($row = $parcoursStmt->fetch(PDO::FETCH_ASSOC)) {
          $selected = $row['id'] == $student['parcours_id'] ? 'selected' : '';
          echo "<option value=\"{$row['id']}\" $selected>{$row['nom_parcours']}</option>";
        }
        ?>
      </select>

      <!-- Sexe -->
      <label for="sexe">Sexe:</label>
      <input type="radio" id="masculin" name="sexe" value="Masculin" <?= $student['sexe'] == 'Masculin' ? 'checked' : '' ?> required> Masculin
      <input type="radio" id="feminin" name="sexe" value="Féminin" <?= $student['sexe'] == 'Féminin' ? 'checked' : '' ?> required> Féminin

      <!-- Date de naissance -->
      <label for="date_naissance">Date de naissance:</label>
      <input type="date" id="date_naissance" name="date_naissance" value="<?= htmlspecialchars($student['date_naissance']) ?>" required>

      <!-- Adresse -->
      <label for="adresse">Adresse:</label>
      <input type="text" id="adresse" name="adresse" value="<?= htmlspecialchars($student['adresse']) ?>" required>

      <!-- Bouton de mise à jour -->
      <input type="submit" value="Mettre à jour">

    </form>
    <a href="./list_students.php" style="color: white;"><button>Annuler la modification</button></a>
  </div>
</body>

</html>