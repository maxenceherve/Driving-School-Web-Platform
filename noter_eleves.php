<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css">
		<title>noter_eleve</title>
	</head>
	<body>
		<?php
  echo "<h1>Noter un élève</h1>";

  include 'connexion.php';

  $idseance = $_POST['idseance'];

	$query = "SELECT * FROM eleves INNER JOIN inscriptions ON eleves.id_eleve = inscriptions.id_eleve WHERE inscriptions.idseance = $idseance";
	//on recupere les livres des élèves inscrit à la séance pour attribuer à chaque élève sa note
	//echo "<p> $query </p>";
	$result = mysqli_query($connect, $query);

  if (!$result) {
      echo "<br>Erreur : " . mysqli_error($connect);
  } else {

      while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {

          $fautes = $_POST['fautes_' . "$row[0]"];
          if (strlen($fautes) == 0) {

              // si la chaine de caractere est vide (de taille 0), on ne touche pas à la note (l'utilisateur n'a rien rentrer)

          } elseif ($fautes < 0 || $fautes > 40) {

              echo "<p> Veuillez rentrer une note comprise entre 0 et 40 </p>";
              echo "<a class='bou' href='validation_seance.php' target='contenu'>Retour</a>";

          } else {

              $note = 40 - $fautes;
              $query = "UPDATE inscriptions SET note = $note WHERE id_eleve = $row[0] AND idseance = $idseance";
			  //actualisation de la note
              //echo "<p>$query</p>";
              $result2 = mysqli_query($connect, $query);

              if (!$result2) {
                  echo "<br>Erreur : " . mysqli_error($connect);
              } else {

                  echo "La note de $note à bien été attribuer à l'élève $row[1] $row[2]";

              }
          }
      }
  }
  mysqli_close($connect);
  ?>
	</body>
</html>