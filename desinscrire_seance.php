<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css">
	</head>
	<body>
	<?php

  include 'connexion.php';

  $seance = $_POST["menuChoixSeance"];
  $eleve = $_POST["eleve"];

  echo "<h1>Recapitulatif de la désinscription</h1>";

  if (empty($seance) || empty($eleve)) {

      echo "<p> Veuillez selectionner une séance et un élève<p>";
      echo "<a class='bou' href='desinscription_seance.php' target='contenu'>Retour</a>";

  } else {

      $query = "DELETE FROM inscriptions WHERE idseance = '$seance' AND id_eleve = '$eleve'";
      echo "<p>$query</p>";
      $result = mysqli_query($connect, $query);

      if (!$result) {
          echo "<br>Erreur : " . mysqli_error($connect);
      } else {

          echo "<p>La désinscription à bien été effectuée.</p>";
					
      }
  }

  mysqli_close($connect);
  ?>
	</body>
</html>