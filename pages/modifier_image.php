<?php
include("../inc/function.php");

$id_objet = isset($_GET['id_objet']) ? intval($_GET['id_objet']) : 0;
$image = getImageByObjet($id_objet);

if (isset($_FILES['image'])) {
    $nom_image = savefile($_FILES['image']);

    if ($image) {
        updateImageObjet($id_objet, $nom_image);
    } else {
        insertImageObjet($id_objet, $nom_image);
    }

    header("Location: home.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modifier l'image</title>
</head>
<body>

<h1>Modifier l'image</h1>

<?php
if ($image) {
    echo "<p>Image actuelle :</p>";
    echo "<img src='../uploads/" . $image['nom_image'] . "' width='200'><br><br>";
} else {
    echo "<p>Aucune image actuelle.</p>";
}
?>

<form method="post" enctype="multipart/form-data">
    <label>Nouvelle image :</label>
    <input type="file" name="image" required><br><br>
    <button type="submit">Modifier</button>
</form>

</body>
</html>
