<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css">
		<title>valider_eleve</title>
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

  if (empty($nom) || empty($prenom) || empty($date)) {

      echo "<p> Veuillez rentrer le nom, le prénom ainsi que la date de naissance de l'élève </p>";
      echo "<a class='annuler' href='ajout_eleve.html' target='contenu'>Retour</a>";

  } else {

		$query = "SELECT * FROM `eleves` WHERE nom='$nom' and prenom='$prenom'"; //on regarde si il existe un homonyme
		// echo "<p> $query </p>";
    $verif = mysqli_query($connect, $query);

		if (!$verif) {
				echo "<br>Erreur : " . mysqli_error($connect);
		}

    if (!empty(mysqli_fetch_array($verif))) {

        echo "<h1> Attention </h1>";
        echo "<p> Il existe déjà un élève avec ce nom et ce prénom, êtes vous sur de vouloir l'ajouter ? </p>";
        echo "<form method='POST' action='ajouter_eleve.php' > ";
        echo "<input name='nom' type='hidden' value='$nom'>"; //on passe les informations dans le formulaire sans les afficher
        echo "<input name='prenom' type='hidden' value='$prenom'>";
        echo "<input name='date' type='hidden' value='$date'>";
        echo "<input name='date_naissance' type='hidden' value='$date_naissance'>";
        echo "<input type='submit' value='Valider'/> <a class='annuler' href='ajout_eleve.html' target='contenu'>Annuler</a>";
        echo "</form>";
				mysqli_close($connect);

    } else {

        include 'ajouter_eleve.php'; //on appelle le fichier ajouter_eleve normalement si l'élève ajouter n'a pas d'homonyme (ajout classique)

    }

  }
  ?>
	</body>
</html>