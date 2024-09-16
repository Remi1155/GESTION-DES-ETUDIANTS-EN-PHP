<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Formulaire d'inscription</title>
  <link rel="stylesheet" href="../styles/edit.css">
</head>

<body>
  <div id="container">
    <h1>Formulaire d'inscription</h1>
    <form action="save_student.php" method="POST">

      <!-- Nom -->
      <label for="nom">Nom:</label>
      <input type="text" id="nom" name="nom" required />

      <!-- Prénom -->
      <label for="prenom">Prénom(s):</label>
      <input type="text" id="prenom" name="prenom" required />

      <!-- Parcours -->
      <label for="parcours">Parcours:</label>
      <select id="parcours" name="parcours" required>
        <?php
        include '../config.php';

        try {
          $query = 'SELECT id, nom_parcours FROM parcours';
          $stmt = $pdo->prepare($query);
          $stmt->execute();

          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='{$row['id']}'>{$row['nom_parcours']}</option>";
          }
        } catch (PDOException $e) {
          echo 'Erreur lors de la récupération des parcours : ' . $e->getMessage();
        }
        ?>
      </select>

      <!-- Sexe -->
      <label>Sexe:</label>
      <input type="radio" id="masculin" name="sexe" value="Masculin" required />
      <label for="masculin" style="font-size:small">Masculin</label>
      <input type="radio" id="feminin" name="sexe" value="Féminin" />
      <label for="feminin" style="font-size:small">Féminin</label>

      <!-- Date de naissance -->
      <label for="date_naissance">Date de naissance:</label>
      <input type="date" id="date_naissance" name="date_naissance" required />

      <!-- Adresse -->
      <label for="adresse">Adresse:</label>
      <input type="text" id="adresse" name="adresse" required />

      <input type="submit" value="Soumettre" />
    </form>
    <a href="./list_students.php"><button>Retour la liste</button></a>
  </div>
</body>

</html>