<div class="container my-3">

<h1>Spectacles</h1>

<div class="row">
    <div class="col-12">
        <?php
            $req = $db->query('SELECT * FROM spectacle ORDER BY id DESC');
            $spectacles = $req->fetchALL();

        ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Photo</th>
                    <th>Date</th>
                    <th>Artiste</th>
                    <th>Lien</th>
                </tr>
            </thead>
            <tbody>
                <?php
                     $i = 1;
                    foreach ($spectacles as $spectacle) {?>
                       <tr>
                           <td><?= $i ?></td>
                           <td><?= $spectacle['title'] ?></td>
                           <td><?= substr($spectacle['content'], 0, 200) ?></td>
                           <td><img src="photos/images/<?= $spectacle['img'] ?>"></td>
                           <td><?= $spectacle['date'] ?></td>
                           <td><?= $spectacle['artist'] ?></td>
                           <td><a href="index.php?page=spectacle&evenement=<?= $spectacle['id'] ?>"><i class="bi bi-eye-fill"></i></a></td>


                       </tr>

                    <?php
                      $i++;
                    
                }
                ?>
            </tbody>







        </table>

    </div>

</div>
</div>