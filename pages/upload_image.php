<?php
include("../inc/function.php");
$success = "";
$error = "";

if (isset($_POST['id_objet']) && isset($_FILES['image'])) {
    $id_objet = $_POST['id_objet'];
    $nom_image = savefile($_FILES['image']);

    if ($nom_image) {
    if (insertImageObjet($id_objet, $nom_image)) {
        header("Location: liste_images.php");
        exit();
    } else {
        $error = "Erreur lors de l'enregistrement en base.";
    }
}

}

$objets = getAllObjetsResult();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Uploader une image</title>
    <link rel="stylesheet" href="../assets/upload.css">
</head>
<body>

<h1>Uploader une image</h1>

<?php if ($success != "") echo "<p style='color:green;'>$success</p>"; ?>
<?php if ($error != "") echo "<p style='color:red;'>$error</p>"; ?>

<form method="post" enctype="multipart/form-data">
    <label>Objet :</label>
    <select name="id_objet">
        <?php
        while ($obj = mysqli_fetch_assoc($objets)) {
            echo "<option value='" . $obj['id_objet'] . "'>" . $obj['nom_objet'] . "</option>";
        }
        ?>
    </select><br><br>

    <label>Image :</label>
    <input type="file" name="image"><br><br>

    <input type="submit" value="Envoyer">
</form>

</body>
</html>
