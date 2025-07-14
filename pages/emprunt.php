<?php
session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    include("../inc/function.php");
} else {
    header("Location: home.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/emprunt.css">
</head>

<body>
    <div class="container">
        <form action="../treatment/emprunt_treatment.php" method="post">
            <h2>A rendre le :</h2><input type="number" name="from" id="">
            <input type="hidden" name="id_objet" value="<?= $id ?>">
            <button type="submit">emprunter</button>
        </form>
        <a href="home.php">retour</a>
    </div>
</body>

</html>