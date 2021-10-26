<?php

session_start();

require_once('../config/database.php');

if ($_SERVER['HTTP_REFERER'] == 'http://localhost/php/spectacle/admin/form.php') { // vérifie qu'on vient bien du formulaire

    // nettoyage des données
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);
    $artist = htmlspecialchars($_POST['artist']);
    $date =  htmlspecialchars($_POST['date']);
    $price=  htmlspecialchars($_POST['price']);;
    $img = htmlspecialchars($_POST['img']);
    $theater = htmlspecialchars($_POST['theater']);
    $link =  htmlspecialchars($_POST['link']);;
    $category =  htmlspecialchars($_POST['category']);

    $errorMessage = '<p>Merci de vérifier les points suivants :</p>';
    $validation = true;
    
    // vérification du titre
    if (empty($title) || strlen($title) > 100) {
        $errorMessage .= '<p>- le champ "titre" est obligatoire et doit comporter moins de 100 caractères.</p>';
        $validation = false;
    }

    // vérification du contenu
    if (empty($content) || strlen($content) > 65535) {
        $errorMessage .= '<p>- le champ "description" est obligatoire et doit comporter moins de 65535 caractères.</p>';
        $validation = false;
    }
    
    // vérification du champ date
    if ( strlen($date) > 16 ) {
        $errorMessage .= '<p>- le champ "date" doit comporter  16 caractères.</p>';
        $validation = false;
    }

    // vérification du champ prix
    if (empty($price) || strlen($price) > 6) {
        $errorMessage .= '<p>- le champ "prix" doit comporter moins de 6 caractères.</p>';
        $validation = false;
    }

    // vérification du champ salle
    if (empty($theater) ||  strlen($theater) > 45) {
        $errorMessage .= '<p>- le champ "salle" est obligatoire et doit  comporter moins de 45 caractères.</p>';
        $validation = false;
    }

      // vérification du champ link
      if (empty($link) || strlen($link) > 255) {
        $errorMessage .= '<p>- le champ "lien" doit comporter moins de 255 caractères.</p>';
        $validation = false;
    }

    // vérification du categorie
    if (empty($category) || strlen($category) > 10) {
        $errorMessage .= '<p>- le champ "categorie" est obligatoire et doit comporter moins de 10 caractères.</p>';
        $validation = false;
    }

    // vérification de l'image
    $authorizedFormats = [
        'image/png',
        'image/jpg',
        'image/jpeg',
        'image/jp2',
        'image/webp'
    ];
    if (empty($_FILES['img']['name']) || $_FILES['img']['size'] > 2000000 || !in_array($_FILES['img']['type'], $authorizedFormats)) {
        $errorMessage .= '<p>- l\'image est obligatoire, ne doit pas dépasser 2 Mo et doit être au format PNG, JPG, JPEG, JP2 ou WEBP.</p>';
        $validation = false;
    }
    
    if ($validation === true) {
        $timestamp = time(); // récupère le nombre de secondes écoulées depuis le 1er janvier 1970
        $format = strchr($_FILES['img']['name'], '.'); // récupère tout ce qui se trouve après le point (png, jpg, ...)
        $imgName = $timestamp . $format; // crée le nouveau nom d'image
        move_uploaded_file($_FILES['img']['tmp_name'], '../photos/images/' . $imgName);// upload du fichier
        $req = $db->prepare('INSERT INTO spectacle (title, artist, theater, date, img, content, price, link, category) VALUES (:title, :artist, :theater, :date, :img, :content, :price, :link, :category)'); // prépare la requête
        $req->bindParam(':title', $title, PDO::PARAM_STR); // associe la valeur $title à :title
        $req->bindParam(':artist', $artist, PDO::PARAM_STR); // associe la valeur $artist à :content
        $req->bindParam(':theater', $theater, PDO::PARAM_STR); // associe la valeur $imgName à :img
        $req->bindParam(':date', $date, PDO::PARAM_STR); // associe la valeur $alt à :alt
        $req->bindParam(':img', $imgName, PDO::PARAM_STR); // associe la valeur $author à :author
        $req->bindParam(':content', $content, PDO::PARAM_STR); // associe la valeur $published à :published
        $req->bindParam(':price', $price, PDO::PARAM_STR);
        $req->bindParam(':link', $link, PDO::PARAM_STR);
        $req->bindParam(':category', $category, PDO::PARAM_STR);
        $req->execute(); // exécute la requête
        move_uploaded_file($_FILES['img']['tmp_name'], '../photos/images/' . $imgName); // upload du fichier
        $_SESSION['notification'] = 'le spectacle a bien été ajouté';
        header('Location: index.php'); // redirection

    } else {
        $_SESSION['notification'] = $errorMessage;
        $_SESSION['form'] = [
            'title' => $title,
            'artist' => $artist,
            'theater'=> $theater,
            'date' => $date,
            'img' => $img,
            'content' => $content,
            'price' => $price,
            'link' => $link,
            'category' => $category,
        ];
        header('Location: form.php');// redirection
    }
} elseif (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $req = $db->query('SELECT img FROM spectacle WHERE id=' . $id); // récupère le nom de l'image
    $oldImg = $req->fetch();
    if (file_exists('../photos/images/' . $oldImg['img'])) { // vérifie que le fichier existe
        unlink('../photos/images/' . $oldImg['img']); // supprime l'image du dossier local
    }
    $reqDelete = $db->query('DELETE FROM spectacle WHERE id=' . $id); // supprime les données en bdd
    $_SESSION['notification'] = 'le spectacle a été bien supprimé';
    header('Location: index.php'); // redirection
}



?>