<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css">
		<title>suppresion_theme</title>
	</head>
	<body>
		<?php

  echo "<h1>Supprimer thème</h1>";

  include 'connexion.php';

  echo "<form method='POST' action='supprimer_theme.php' > ";

	$query = "SELECT * FROM `themes` WHERE supprime=0"; //on recupere tous les thèmes actifs
	// echo "<p> $query </p>";
  $result = mysqli_query($connect, $query);

  if (!$result) {
      echo "<br>Erreur : " . mysqli_error($connect);
  } else {

      $nb_themes = mysqli_num_rows($result);
      echo "<p><label for='menuChoixTheme'>Choisir un thème:</label> <br>";
      echo "<select name='menuChoixTheme' size='$nb_themes'>";

      while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {

          echo "<option value='$row[0]'>$row[1]</option>";

      }

      echo "</select> </p>";
      echo "<input type='submit' value='Supprimer ce thème'>";
      echo "</form>";
  }

  mysqli_close($connect);
  ?>
	</body>
</html>