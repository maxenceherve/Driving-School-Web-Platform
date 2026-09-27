<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css">
	</head>
	<body>
		<?php
  include 'connexion.php';

  echo "<h1>Consulter un élève</h1>";
  echo "<form method='POST' action ='consulter_eleve.php' > ";

  $query = "SELECT * FROM eleves"; //on recupère la liste des élèves
  // echo "<p> $query </p>"
  $result = mysqli_query($connect, $query);

  if (!$result) {
      echo "<br>Erreur : " . mysqli_error($connect);
  }

  echo "<p> <label for='menuChoixEleve'>Choisir un élève :</label> <br />";
  $nb_eleves = mysqli_num_rows($result);
  echo "<select name='menuChoixEleve' size='$nb_eleves' required>";

  while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
      echo "<option value='$row[0]'>$row[1] $row[2]</option>";
  }

  echo "</select> </p>";
  echo "<input type='submit' value='Consulter cet élève'>";
  echo "</form>";

  mysqli_close($connect);
  ?>
	</body>
</html>