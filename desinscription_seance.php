<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <?php

    include 'connexion.php';

    echo "<h1>Désinscription d'une séance</h1>";

    // Vérification de l'existence de $_POST["menuChoixEleve"]
    if (!isset($_POST["menuChoixEleve"])) {
        echo "<form method='POST' action='desinscription_seance.php'>";
        $query = "SELECT * FROM eleves"; // On récupère la liste des élèves
        $result = mysqli_query($connect, $query);

        if (!$result) {
            echo "<br>Erreur : " . mysqli_error($connect);
        } else {
            echo "<p><label for='menuChoixEleve'>Choisir un élève :</label><br />";
            $nb_eleves = mysqli_num_rows($result);
            echo "<select name='menuChoixEleve' size='$nb_eleves' required>";

            while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                echo "<option value='$row[0]'>$row[1] $row[2]</option>";
            }

            echo "</select></p>";
            echo "<input type='submit' value='Suivant'>";
            echo "</form>";
        }
    } else {
        $choix_eleve = $_POST["menuChoixEleve"];

        echo "<form method='POST' action='desinscrire_seance.php'>";

        $query = "SELECT seances.idseance, seances.DateSeance, themes.nom 
                  FROM inscriptions 
                  INNER JOIN seances ON seances.idseance = inscriptions.idseance 
                  INNER JOIN themes ON seances.idtheme = themes.idtheme 
                  WHERE seances.DateSeance > CURDATE() 
                  AND id_eleve = $choix_eleve";
        $result = mysqli_query($connect, $query);

        if (!$result) {
            echo "<br>Erreur : " . mysqli_error($connect);
        } else {
            echo "<p><label for='menuChoixSeance'>Choisir une séance :</label><br />";
            $nb_seances = mysqli_num_rows($result);
            echo "<select name='menuChoixSeance' size='$nb_seances' required>";

            while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                echo "<option value='$row[0]'>$row[2] | $row[1]</option>";
            }

            echo "</select></p>";
            echo "<input name='eleve' type='hidden' value='$choix_eleve'>";
            echo "<input type='submit' value='Désinscrire'>";
            echo "<a class ='bou' href='desinscription_seance.php' target='contenu'>Retour</a>";
            echo "</form>";
        }
    }

    mysqli_close($connect);
    ?>
</body>
</html>
