<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css">
		<title>supprimer_theme</title>
	</head>
	<body>
		<?php
  echo "<h1>Récapitulatif de la suppression</h1>";

  include 'connexion.php';

  $theme = $_POST['menuChoixTheme'];

  $theme = mysqli_real_escape_string($connect, $theme);

  if (empty($theme) ) {

      echo "<p> Veuillez selectionner un thème à supprimer </p>";
      echo "<a class='bou' href='supression_theme.php' target='contenu'>Retour</a>";

  } else {
      $query = "UPDATE themes SET supprime = 1 WHERE Idtheme = $theme"; //on ne le supprime pas vraiment, on le desactive en changeant la valeur du booléen.
      //echo "<p>$query</p>";
      $result = mysqli_query($connect, $query);

      if (!$result) {
          echo "<br>Erreur : " . mysqli_error($connect);
      } else {

          echo "<p> Le thème à bien été supprimé (désactivé) !  </p>";

      }
  }

  mysqli_close($connect);
  ?>
	</body>
</html>