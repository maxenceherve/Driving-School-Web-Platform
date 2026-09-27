<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<?php
echo "<h1>Récapitulatif de l'inscription</h1>";

include 'connexion.php';

$seance = $_POST['menuChoixSeance'];
$eleve = $_POST['menuChoixEleve'];

$seance = mysqli_real_escape_string($connect, $seance);
$eleve = mysqli_real_escape_string($connect, $eleve);

if (empty($seance) || empty($eleve)) {
    echo "<p>Veuillez entrer la séance et le nom de l'élève !</p>";
    echo "<a class='annuler' href='inscription_eleve.php' target='contenu'>Retour</a>";
} else {
    // Vérification si l'élève est déjà inscrit à cette séance
    $query = "SELECT * FROM inscriptions WHERE idseance = '$seance' AND id_eleve = '$eleve'";
    $result = mysqli_query($connect, $query);

    if (!$result) {
        echo "<p>Erreur lors de l'exécution de la requête : " . mysqli_error($connect) . "</p>";
        exit;
    }

    if (mysqli_num_rows($result) > 0) {
        // Inscription existe déjà
        echo "<p>Cet(te) élève est déjà inscrit(e) à cette séance.</p>";
        echo "<a class='annuler' href='inscription_eleve.php' target='contenu'>Retour</a>";
    } else {
        // Vérification de l'effectif maximum de la séance
        $query = "SELECT EffMax FROM seances WHERE idseance = $seance"; // On récupère l'effectif max
        $effectifmax = mysqli_query($connect, $query);
        $effectifmax = mysqli_fetch_array($effectifmax, MYSQLI_NUM);

        if (!$effectifmax) {
            echo "<br>Erreur : " . mysqli_error($connect);
        }

        $query = "SELECT COUNT(idseance) FROM inscriptions WHERE idseance = $seance"; // On compte le nombre d'élèves inscrits à la séance
        $effectifactuel = mysqli_query($connect, $query);
        $effectifactuel = mysqli_fetch_array($effectifactuel, MYSQLI_NUM);

        if (!$effectifactuel) {
            echo "<br>Erreur : " . mysqli_error($connect);
        }

        if ($effectifactuel[0] >= $effectifmax[0]) {
            echo "<p>La séance est déjà pleine !</p>";
            echo "<a class='bou' href='inscription_eleve.php' target='contenu'>Retour</a>";
        } else {
            $query = "INSERT INTO inscriptions VALUES ($seance, $eleve, -1)";
            $result = mysqli_query($connect, $query);

            if (!$result) {
                echo "<br>Erreur : " . mysqli_error($connect);
            } else {
                echo "L'élève a bien été inscrit à la séance !";
            }
        }
    }
}

mysqli_close($connect);
?>
</body>
</html>
