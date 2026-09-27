<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css">
		<title>inscription_eleve</title>
	</head>
	<body>
		<?php

  echo "<h1>Inscrire un élève à une séance</h1>";

  include 'connexion.php';

  echo "<form method='POST' action='inscrire_eleve.php' > ";

  $query = "SELECT * FROM `seances` WHERE DateSeance >= CURDATE()"; //recuperations de toutes les seances futures
	// echo "<p> $query </p>";
  $result = mysqli_query($connect, $query);

  if (!$result) {
      echo "<br>Erreur : " . mysqli_error($connect);
  } else {

      echo "<p> <label for='menuChoixSeance'>Choisir une séance :</label> <br />";
      $nb_seance = mysqli_num_rows($result);
      echo "<select name='menuChoixSeance' size='$nb_seance' required>";

      while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {

					$query = "SELECT nom FROM `themes` WHERE Idtheme = $row[3]"; //récuperation du nom des thèmes pour la sélection
					// echo "<p>$query</p>";
          $result2 = mysqli_query($connect, $query);

          if (!$result2) {
              echo "<br>Erreur : " . mysqli_error($connect);
          } else {

              $theme = mysqli_fetch_array($result2, MYSQLI_NUM);
              echo "<option value='$row[0]'>$theme[0] | $row[1] </option>";

          }
      }

      echo "</select> </p>";

			$query = "SELECT * FROM `eleves`"; //recuperation de tous les élèves
			// echo "<p> $query </p>";
      $result = mysqli_query($connect, $query);

      if (!$result) {
          echo "<br>Erreur : " . mysqli_error($connect);
      } else {

          echo "<p> <label for='menuChoixEleve'>Choisir un élève :</label> <br />";
          $nb_eleves = mysqli_num_rows($result);
          echo "<select name='menuChoixEleve' size='$nb_eleves' required>";

          while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {

              echo "<option value='$row[0]'>$row[1] $row[2] </option>";

          }

          echo "</select> </p>";
          echo "<input type='submit' value='Inscrire'>";
          echo "</form>";
      }
  }
  mysqli_close($connect);
  ?>
	</body>
</html>