<?php
include_once('connect.php');

function savefile($fichier)
{
    $uploadDir = __DIR__ . '/../uploads/';
    $maxSize = 100 * 1024 * 1024; // 100 Mo
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'application/pdf', 'video/mp4'];
    
    $newName = null; // <-- initialisation
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($fichier)) {
        $file = $fichier;
        if ($file['error'] !== UPLOAD_ERR_OK) {
            die('Erreur lors de l’upload : ' . $file['error']);
        }
        if ($file['size'] > $maxSize) {
            die('Le fichier est trop volumineux.');
        }
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        if (!in_array($mime, $allowedMimeTypes)) {
            die('Type de fichier non autorisé : ' . $mime);
        }
        $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $newName = $originalName . '_' . uniqid() . '.' . $extension;
        if (move_uploaded_file($file['tmp_name'], $uploadDir . $newName)) {
            // succès, on retourne le nouveau nom
            return $newName;
        } else {
            die("Échec du déplacement du fichier.");
        }
    } else {
        die("Aucun fichier reçu.");
    }
    
   
}

function getMembrebyEmail($email)
{
    $requete = sprintf("SELECT  * FROM membre WHERE email=%d", $email);
    $resultat = mysqli_query(dbconnect(), $requete);
    $membre = array();
    while ($donnees = mysqli_fetch_assoc($resultat)) {
        $membre['id'] = $donnees['id_membre'];
        $membre['email'] = $donnees['email'];
        $membre['mdp'] = $donnees['mdp'];
    }
    return $membre;
}
function isMembre($email)
{
    $sql = "select * from Membre where email='$email'";
    $req = mysqli_query(dbconnect(), $sql);
    $result = mysqli_fetch_assoc($req);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

function getobjet() {
    $bdd=dbconnect();
    $sql = "SELECT objet.id_objet, objet.nom_objet, categorie_objet.nom_categorie, membre.nom AS nom_membre
            FROM objet
            JOIN categorie_objet ON objet.id_categorie = categorie_objet.id_categorie
            JOIN membre ON objet.id_membre = membre.id_membre";
    $result = mysqli_query($bdd, $sql);
    $objets = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $objets[] = $row;
    }
    return $objets;
}

function filtreparcateg($bdd, $id_categorie = 0) {
    $objets = array();
    if ($id_categorie > 0) {
        $sql = "SELECT objet.id_objet, objet.nom_objet, categorie_objet.nom_categorie, membre.nom AS nom_membre
                FROM objet
                JOIN categorie_objet ON objet.id_categorie = categorie_objet.id_categorie
                JOIN membre ON objet.id_membre = membre.id_membre
                WHERE objet.id_categorie = " . intval($id_categorie);
    } else {
        $sql = "SELECT objet.id_objet, objet.nom_objet, categorie_objet.nom_categorie, membre.nom AS nom_membre
                FROM objet
                JOIN categorie_objet ON objet.id_categorie = categorie_objet.id_categorie
                JOIN membre ON objet.id_membre = membre.id_membre";
    }
    $result = mysqli_query($bdd, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $objets[] = $row;
    }
    return $objets;
}

?>