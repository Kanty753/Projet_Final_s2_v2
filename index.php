<?php
$host = 'localhost';

$user = 'ETU004061';
$pass = 'ou4hFfUs'; // Remplace par ton mot de passe si besoin

// $user = 'root';
// $pass = ''; // Remplace par ton mot de passe si besoin


$dbname = 'db_s2_ETU004061'; // Nom de la base de données

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    echo "Erreur de connexion à la base de données : " . $conn->connect_error;

} else {
    echo "Connexion à la base de données réussie !";
    session_start();
    $_SESSION['user']= array();
    header('Location: pages/signup.php');
}
?>