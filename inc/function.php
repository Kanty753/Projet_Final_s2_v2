<?php



function dbconnect() {
    return mysqli_connect("localhost", "root", "", "db_s2_ETU004061");
}

function getAllObjets() {
    $bdd = dbconnect();
    $sql = "SELECT * FROM objet";
    $result = mysqli_query($bdd, $sql);
    $objets = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $objets[] = $row;
    }
    return $objets;
}

function savefile($fichier) {
    $uploadDir = __DIR__ . '/../uploads/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $maxSize = 5 * 1024 * 1024; // 5 Mo
    $allowed = ['image/jpeg', 'image/png', 'image/jpg'];

    if ($fichier['error'] !== 0) {
        return false;
    }

    if ($fichier['size'] > $maxSize) {
        return false;
    }

    $mime = mime_content_type($fichier['tmp_name']);
    if (!in_array($mime, $allowed)) {
        return false;
    }

    $ext = pathinfo($fichier['name'], PATHINFO_EXTENSION);
    $newName = uniqid() . '.' . $ext;
    $target = $uploadDir . $newName;

    if (move_uploaded_file($fichier['tmp_name'], $target)) {
        return $newName;
    }

    return false;
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
    $sql = "SELECT objet.id_objet, objet.nom_objet, categorie_objet.nom_categorie, membre.nom AS nom_membre , i.nom_image
            FROM objet
            JOIN categorie_objet ON objet.id_categorie = categorie_objet.id_categorie
            JOIN membre ON objet.id_membre = membre.id_membre
            JOIN images_objet i on objet.id_objet = i.id_objet ";
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
function getAllObjetsResult() {
    $bdd = dbconnect();
    $sql = "SELECT * FROM objet";
    return mysqli_query($bdd, $sql);
}
function insertImageObjet($id_objet, $nom_image) {
    $bdd = dbconnect();
    $sql = "INSERT INTO images_objet (id_objet, nom_image) VALUES ($id_objet, '$nom_image')";
    return mysqli_query($bdd, $sql);
}
function getImagesAvecObjets() {
    $bdd = dbconnect();
    $sql = "SELECT o.nom_objet, i.nom_image 
            FROM images_objet i
            JOIN objet o ON i.id_objet = o.id_objet";
    return mysqli_query($bdd, $sql);
}
function updateImageObjet($id_objet, $nom_image) {
    $bdd = dbconnect();
    $sql = "UPDATE images_objet SET nom_image = '$nom_image' WHERE id_objet = $id_objet";
    return mysqli_query($bdd, $sql);
}

function getImageByObjet($id_objet) {
    $bdd = dbconnect();
    $sql = "SELECT * FROM images_objet WHERE id_objet = $id_objet LIMIT 1";
    $res = mysqli_query($bdd, $sql);
    if ($res) return mysqli_fetch_assoc($res);
    return null;
}


?>