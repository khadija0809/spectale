<?php
    $id = (int)$_GET['evenement'];
    $req = $db->query('SELECT  * FROM spectacle WHERE id=' . $id);
    $spectacle = $req->fetch();
?>

<div class="container my-3">
    <div class="row">
        <div class="col-12">

            <h1><?= $spectacle['title'] ?></h1>
            <p> Avec <?= $spectacle['artist'] ?>, le <?= $spectacle['date'] ?>, à la salle : <?= $spectacle['theater'] ?></p>
        </div>
        <div class="col-sm-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3 my-3">
        <img src="photos/images/<?= $spectacle['img']?>" class="w-100">
        </div>
        <div class="col-12">
            <p><?= $spectacle['content'] ?></p>


        </div>




    </div>
</div>