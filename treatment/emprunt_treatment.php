<?php 
include("../inc/function.php");
if (isset($_POST['id_objet']) && isset($_POST['from'])) {
session_start();
    $id_objet = $_POST['id_objet'];
    $from = $_POST['from'];
    $bdd = dbconnect();
    $id_membre = $_SESSION['user']['id_membre'];
    $sql = "INSERT INTO emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES ($id_objet, $id_membre, NOW(), DATE_ADD(NOW(), INTERVAL $from DAY))";

    if (mysqli_query($bdd, $sql)) {
        header("Location: ../pages/home.php");
        exit();
    } else {
        echo "Erreur lors de l'enregistrement de l'emprunt.";
    }}
else {
    header("Location: ../pages/home.php");
    exit();
}

echo $_SESSION['user']['id_membre'];
?>
