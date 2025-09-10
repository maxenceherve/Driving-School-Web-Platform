<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css">
	</head>
	<body>
		<?php
  $nom = $_POST["nom"];
  $desc = $_POST["desc"];

  include 'connexion.php';

  $nom = mysqli_real_escape_string($connect, $nom);
  $desc = mysqli_real_escape_string($connect, $desc);

  echo "<h1> Récupitulatif de l'ajout :</h1>";

  if (empty($nom)) {

      echo "<p> Veuillez rentrer le nom du thème </p>";
      echo "<a class='bou' href='ajout_theme.html' target='contenu'>Retour</a>";

  } else {

			$query = "SELECT * FROM `themes` WHERE nom='$nom' and supprime='1'"; //on verifie que le thème n'a pas déjà été créer puis désactiver
			// echo "<p> $query </p>";
      $verif = mysqli_query($connect, $query);

      if (!empty(mysqli_fetch_array($verif))) {

          echo "Ce theme avais déjà été créer avant mais était supprimé, il va donc être réactivé !";

          $query = "UPDATE themes SET supprime = 0, descriptif = " . "'$desc'" . " WHERE nom = '$nom' ;";
          // echo "<p>$query</p>";
          $result = mysqli_query($connect, $query);

          if (!$result) {
              echo "<br>Erreur : " . mysqli_error($connect);
          } else {

              echo "<p>Le thème $nom à bien été réactivé et sa description à bien été mise à jour !</p>";

          }
      } else {

					$query = "SELECT * FROM `themes` WHERE nom='$nom' and supprime='0'"; //on recupere maintenant que le theme n'existe pas déjà et est actif (doublon)
					// echo "<p>$query</p>";
					$verif2 = mysqli_query($connect, $query);

          if (!empty(mysqli_fetch_array($verif2))) {

              echo "<p> Ce thème existe déjà et est actif !</p>";
              echo "<a class='bou' href='ajout_theme.html' target='contenu'>Retour</a>";

          } else {

              $query = "INSERT INTO `themes` VALUES (NULL,'$nom',0,'$desc')";
              echo "<p>$query</p>";
              $result = mysqli_query($connect, $query);

              if (!$result) {
                  echo "<br>Erreur : " . mysqli_error($connect);
              } else {

                  echo "<p>Le thème $nom à bien été ajouté !</p>";

              }
          }
      }
  }

  mysqli_close($connect);
  ?>
	</body>
</html>