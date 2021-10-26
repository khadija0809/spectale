<?php


session_start();
if (isset($_SESSION['notification'])) {
    echo $_SESSION['notification'];
}
session_destroy();
require_once('../config/database.php');
$req = $db->query('SELECT id, title, artist, theater, date, img, content, price, link, category FROM spectacle ORDER BY id DESC');
$posts = $req->fetchAll();


?>





<!DOCTYPE html>

<html lang="fr">

<head>


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>SPECTACLE • Espace administrateur </title>


   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">

</head>


<body>

    <h1>Espace administrateur</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>TITRE</th>
                <th>ARTISTE</th>
                <th>DATE</th>
                <th>SALLE</th>
                <th>ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($spectacles as $spectacle) { ?>
                <tr>
                    <td><?= $spectacle['id'] ?></td>
                    <td><?= $spectacle['title'] ?></td>
                    <td><?= $spectacle['artist'] ?></td>
                    <td><?= $spectacle['date'] ?></td>
                    <td><?= $spectacle['theater'] ?></td>
                    <td>
                         <a href="#"><i class="bi bi-pencil-square"></i></a> 
                         <a href="treatment.php?delete=<?= $spectacle['id'] ?>"><i class="bi bi-trash-fill"></i></a> -->
                    </td>
                </tr>
            <?php }


            ?>
        </tbody>
    </table>
    <a href="form.php">Ajouter un spectacle</a>

</body>

</html>