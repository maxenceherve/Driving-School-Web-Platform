<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css">
	</head>
	<body>
		<?php

  include 'connexion.php';

  $ideleve = $_POST["menuChoixEleve"];

	$ideleve = mysqli_real_escape_string($connect, $ideleve);

	echo "<h1>Récapitulatif de l'élève</h1>";

  if (empty($ideleve)) {

      echo "<p> Veuillez selectionner un élève<p>";
	  echo "<a class='annuler' href='consultation_eleve.php' target='contenu'>Retour</a>";

  } else {

			$query = "SELECT note FROM eleves INNER JOIN inscriptions ON inscriptions.id_eleve = eleves.id_eleve WHERE eleves.id_eleve = $ideleve AND inscriptions.note >= 0";
			//on recupere les notes de l'élèves
			// echo "<p> $query </p>";
      $result = mysqli_query($connect, $query);

      if (!$result) {
          echo "<br>Erreur : " . mysqli_error($connect);
      }

			$total = 0;
			$nombre_note = 0;

			while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {

					$total = $total + $row[0];
					$nombre_note = $nombre_note + 1;

			}

			if ($nombre_note > 0) {
				$moyenne = $total / $nombre_note;
			} else {
				$moyenne = "Non évaluée";
			}

			$query = "SELECT * FROM eleves WHERE id_eleve = $ideleve";
			//on recupere les notes de l'élèves
			// echo "<p> $query </p>";
      		$result = mysqli_query($connect, $query);

      if (!$result) {
          echo "<br>Erreur : " . mysqli_error($connect);
      }

			while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {

				echo "
				<table border='1'>
				<tr>
					<th> Id </th>
					<th> Nom </th>
					<th> Prénom </th>
					<th> Date de naissance </th>
					<th> Date d'inscription </th>
					<th> Présence </th>
					<th> Moyenne </th>
				</tr> ";

	          echo "
						<tr>
						<td>$row[0]</td>
						<td>$row[1]</td>
						<td>$row[2]</td>
						<td>$row[3]</td>
						<td>$row[4]</td>
						<td>L'élève à assisté à $nombre_note séances</td>
						<td>$moyenne</td>
						</tr>
						</table>";

			}

			echo "<h1>Récapitulatif des séances de l'élève</h1>";

			$query = "SELECT * FROM inscriptions INNER JOIN seances ON seances.idseance = inscriptions.idseance WHERE seances.DateSeance <= CURDATE() AND id_eleve = '$ideleve'";
			//on recupere toutes les inscriptions et les séances passées de l'élève
			// echo "<p> $query </p>";
      $result = mysqli_query($connect, $query);

      if (!$result) {
          echo "<br>Erreur : " . mysqli_error($connect);
      } else {

          echo "
			<table border='1'>
				<tr>
					<th> Date </th>
					<th> Thème </th>
					<th> Note </th>
				</tr> ";

          while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {

						if ("-1" == $row[2]) {

								$row[2] = "Non évalué(e)";

						}

              echo "<tr>";
              echo "<td> $row[4]";

							$query = "SELECT * FROM themes WHERE Idtheme = '$row[6]'"; //on recupere les themes pour l'affichage
							// echo "<p> $query </p>";
              $theme = mysqli_query($connect, $query);

              if (!$theme) { //recuperation des informations du thème pour affichage
                  echo "<br>Erreur : " . mysqli_error($connect);
              }

              $info_theme = mysqli_fetch_array($theme, MYSQLI_NUM);
              echo "<td> $info_theme[1]";
							echo "<td> $row[2]";
              echo "</tr>";

          }
          echo "</table>";
      }
}

  mysqli_close($connect);
  ?>
	</body>
</html>