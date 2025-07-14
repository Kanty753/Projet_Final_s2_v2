<?php


include("../inc/function.php");  

$bdd = dbconnect();

$categories = array();
$res = mysqli_query($bdd, "SELECT * FROM categorie_objet");
while ($row = mysqli_fetch_assoc($res)) {
    $categories[] = $row;
}

$id_categorie = isset($_GET['categorie']) ? intval($_GET['categorie']) : 0;

$objets = filtreparcateg($bdd, $id_categorie);
$i = 0;
$count = count($objets);
$j = 0;
$catCount = count($categories);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des objets</title>
    <link rel="stylesheet" href="../assets/home.css">
</head>
<body>
    <h1>Liste des objets</h1>

    <form method="get" action="">
        <label for="categorie">Filtrer par categorie:</label>
        <select name="categorie" id="categorie">
            <option value="0"<?php if ($id_categorie == 0) echo ' selected'; ?>>Toutes</option>
            <?php
            while ($j < $catCount) {
                $selected = ($id_categorie == $categories[$j]['id_categorie']) ? ' selected' : '';
                echo '<option value="' . $categories[$j]['id_categorie'] . '"' . $selected . '>' . $categories[$j]['nom_categorie'] . '</option>';
                $j++;
            }
            ?>
        </select>
        <button type="submit">Filtrer</button>
    </form>

    <?php while ($i < $count) { ?>
    <div class="objet">
   <?php 
    echo '<h2>' . $objets[$i]['nom_objet'] . '</h2>';
    echo '<p><strong>Categorie :</strong> ' . $objets[$i]['nom_categorie'] . '</p>';
    echo '<p><strong>Proprietaire :</strong> ' . $objets[$i]['nom_membre'] . '</p>';
    echo '<p><a href="modifier_image.php?id_objet=' . $objets[$i]['id_objet'] . '">Modifier l\'image</a></p>';
    ?>
    <p><a href="emprunt.php?id=<?=$objets[$i]['id_objet']?>">Emprunter</a></p>
    <?php
$emprunt = getEmpruntEnCours($objets[$i]['id_objet']);
if ($emprunt) {
echo"    Il y a un emprunt en cours";
} else {
    // Pas d'emprunt en cours
}
?>
</div>

<?php $i++ ; } ?>
  </body>
</html>