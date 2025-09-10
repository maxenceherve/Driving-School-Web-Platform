<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css">
	</head>
	<body>
		<?php

  echo "<h1> Récupitulatif de l'ajout :</h1>";

  include 'connexion.php';

  date_default_timezone_set('Europe/Paris');
  $date_jour = date("Y\-m\-d");
  $date = $_POST['date'];
  $effectif = $_POST['effectif'];
  $theme = $_POST['menuChoixTheme'];

  $date = mysqli_real_escape_string($connect, $date); //pour eviter les failles SQL ou autres problèmes d'input
  $effectif = mysqli_real_escape_string($connect, $effectif);
  $theme = mysqli_real_escape_string($connect, $theme);

  if (empty($date) || empty($effectif) || empty($theme)) {

      echo "<p> Veuillez rentrer la date, l'effectif et choisir un thème ! </p>";
      echo "<a class='bou' href='ajout_seance.php' target='contenu'>Retour</a>";

  } else {
			$query = "SELECT * FROM seances WHERE DateSeance = '$date' and Idtheme = '$theme'"; //on verifie qu'il n'existe pas déjà une seance avec sur ce thème le même jour
			// echo "<p> $query </p>";
      $verif = mysqli_query($connect, $query);

      if (!$verif) {
          echo "<br>Erreur : " . mysqli_error($connect);
      } else {

          if ($effectif < 1) {

              echo "<p> Veuillez rentrer un effectif supérieur ou égal à 1 !</p>";
              echo "<a class='bou' href='ajout_seance.php' target='contenu'>Retour</a>";

          } else {
              if ($date < $date_jour) {

                  echo "<p>Vous ne pouvez pas créer une séance dans le passé !</p>";
                  echo "<p> <a class='bou' href='ajout_seance.php' target='contenu'>Retour</a> </p>";

              } else {
                  if (!empty(mysqli_fetch_array($verif))) {

                      echo "<p>Une séance est déjà programmer sur ce thème aujourd'hui...</p>";
                      echo "<p><a class='bou' href='ajout_seance.php' target='contenu'>Retour</a></p>";

                  } else {

                      $query = "INSERT INTO `seances` VALUES (NULL,'$date','$effectif','$theme')";
                      //echo "<p>$query</p>";
                      $result = mysqli_query($connect, $query);

                      if (!$result) {
                          echo "<br>Erreur : " . mysqli_error($connect);
                      } else {

                          echo "<p> La séance à été programmée le $date avec un effectif de $effectif élèves !</p>";

                      }
                  }
              }
          }
      }
  }
  mysqli_close($connect);
  ?>
	</body>
</html>