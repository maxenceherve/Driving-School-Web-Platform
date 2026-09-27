<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css">
	</head>
	<body>
		<?php

  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $date_naissance = $_POST['date_naissance'];
  date_default_timezone_set('Europe/Paris');
  $date = date("Y-m-d");

  include 'connexion.php';

	$nom = mysqli_real_escape_string($connect, $nom);
	$prenom = mysqli_real_escape_string($connect, $prenom);
	$date_naissance = mysqli_real_escape_string($connect, $date_naissance);
	$date = mysqli_real_escape_string($connect, $date);

  echo "<h1> Récupitulatif de l'ajout :</h1>";

  if (empty($nom) || empty($prenom) || empty($date_naissance)) {

      echo "<p> Veuillez rentrer le nom, le prénom et la date de naissance de l'élève !</p>";
      echo "<a class='bou' href='ajout_eleve.html' target='contenu'>Retour</a>";

  } else {
      if ($date_naissance > $date) {

          echo "<p> Votre élève est né dans le futur ?!</p>";
          echo "<a class='bou' href='ajout_eleve.html' target='contenu'>Retour</a>";

      } else {

          $query = "INSERT INTO `eleves` VALUES (NULL,'$nom','$prenom','$date_naissance','$date')";
          //echo "<p>$query</p>";
          $result = mysqli_query($connect, $query);

          if (!$result) {
              echo "<br>Erreur : " . mysqli_error($connect);
          } else {

              echo "<p> L'élève $nom $prenom, né(e) le $date_naissance à bien été enregistré le $date !</p>";

          }
      }
  }

  mysqli_close($connect);
  ?>
	</body>
</html>