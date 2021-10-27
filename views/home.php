<div class="container my-3">
    <h1>Accueil</h1>

    <div class="row">
        <p> Vous recherchez un billet de concert, de ballet ou de cirque ? <br>
            Vous êtes au bon endroit ! Tous les spectacles qui vous intéressent sont ici sur Ensemble Au Spectacle ! <br>
            Retrouvez toutes les infos utiles sur vos spectacles préférés en seulement quelques clics.</p>
        <!-- présentation -->
    </div>

    <div class="row">
        <h2>Nos nouveautés</h2>
        <!-- recuperer les 6 dernier spectacle en base de données  -->
        <?php
        $req = $db->query('SELECT * FROM spectacle ORDER BY id DESC LIMIT 6 ');
        $spectacles = $req->fetchALL();
        foreach ($spectacles as $spectacle) { ?>
            <div class="col-sm-12 col-md-4 p-3">
                <div class="card">
                    <img src="photos/images/<?= $spectacle['img'] ?> " class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?= $spectacle['title'] ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?= $spectacle['artist'] . " - " . $spectacle['date'] . " - " . $spectacle['theater'] ?></h6>
                        <p class="card-text"><?= substr($spectacle['content'], 0, 200) . '...' ?></p>
                        <a href="index.php?page=spectacle&evenement=<?= $spectacle['id'] ?>" class="btn btn-secondary">En savoir plus</a>
                    </div>
                </div>
            </div>

        <?php }
        ?>
        <div class="col-12 text-end mb-5">
            <a href="index.php?page=spectacles" class="btn btn-outline-dark">Tous les Spectacles</a>

        </div>

    </div>