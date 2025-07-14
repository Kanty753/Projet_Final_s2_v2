<?php
include("../inc/function.php");

$result = getImagesAvecObjets();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Liste des images</title>
</head>
<body>

<h1>Images des objets</h1>

<?php
while ($row = mysqli_fetch_assoc($result)) {
    echo "<div style='margin-bottom:20px;'>";
    echo "<strong>" . htmlspecialchars($row['nom_objet']) . "</strong><br>";
    echo "<img src='../uploads/" . htmlspecialchars($row['nom_image']) . "' width='200'><br>";
    echo "</div>";
}
?>

</body>
</html>
