<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css">
		<title>validation_seance</title>
	</head>
	<body>
		<?php
  echo "<h1>Valider une séance</h1>";

  include 'connexion.php';

  echo "<form method='POST' action='valider_seance.php' > ";

	$query = "SELECT * FROM `seances` WHERE DateSeance <= CURDATE()";
	//recuperation des seances dans le passé
	// echo "<p> $query </p>";
  $result = mysqli_query($connect, $query);

  if (!$result) {
      echo "<br>Erreur : " . mysqli_error($connect);
  } else {

      echo "<p> <label for='menuChoixSeance'>Choisir une séance :</label> <br />";
      $nb_seance = mysqli_num_rows($result);
      echo "<select name='menuChoixSeance' size='$nb_seance'>";

      while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {

					$query = "SELECT nom FROM `themes` WHERE Idtheme = $row[3]";
					//recuperation du nom des themes pour affichage
					// echo "<p> $query </p>"
          $result2 = mysqli_query($connect, $query);

          if (!$result2) {
              echo "<br>Erreur : " . mysqli_error($connect);
          } else {

              $theme = mysqli_fetch_array($result2, MYSQLI_NUM);
              echo "<option value='$row[0]'> $theme[0] | $row[1] </option>";

          }
      }
      echo "</select> </p>";
      echo "<input type='submit' value='Valider cette séance'>";
      echo "</form>";
  }

  mysqli_close($connect);
  ?>
	</body>
</html>