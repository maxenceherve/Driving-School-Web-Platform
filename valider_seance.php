<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css">
	</head>
	<body>
		<?php
  include 'connexion.php';

  $idseance = $_POST['menuChoixSeance'];

  $nom = mysqli_real_escape_string($connect, $idseance);

  if (empty($idseance)) {

      echo "<p> Veuillez choisir une séance ou il y a des élèves inscrits </p>";
      echo "<a class='annuler' href='validation_seance.php' target='contenu'>Retour</a>";

  } else {

      echo "<form method='POST' action='noter_eleves.php' > ";

			$query = "SELECT * FROM eleves INNER JOIN inscriptions ON eleves.id_eleve = inscriptions.id_eleve WHERE inscriptions.idseance = $idseance";
			// on recupere les élèves inscrits à la séance
			// echo "<p> $query </p>";
      $result = mysqli_query($connect, $query);

      if (!$result) {
          echo "<br>Erreur : " . mysqli_error($connect);
      } else {

          echo "
		<table border='1'>
			<tr>
				<th> Élève </th>
					<th> Note actuelle </th>
						<th> Nombres de fautes </th>
			</tr> ";

          while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {

              if ("-1" == $row[7]) {

                  $row[7] = "Non évalué(e)";
                  $faute = null;

              } else {

                  $faute = 40 - $row[7];

              }

              echo "<tr>";
              echo "<td> $row[1] $row[2]</td>";
              echo "<td> $row[7] </td>";
              echo "<td><input id='fautes' type='number' min=0 max=40 value='$faute' name='fautes_" . "$row[0]" . "'/></td>";
              echo "</tr>";

          }

          echo "</table>";
          echo "<input name='idseance' type='hidden' value='$idseance'>";
          echo "<p><INPUT type='submit' value=\"Noter l'élève\"><p>";
          echo "</FORM>";
					
      }
  }

  mysqli_close($connect);
  ?>
	</body>
</html>