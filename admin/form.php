<!DOCTYPE html>

<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SPECTACLE • Admin • Form</title>

</head>

    <body>

        <form action="treatment.php" method="post" enctype="multipart/form-data">
            <label for="title">titre</label>
            <input type="text" name="title" maxlength="100" required>
            <br>

            <label for="artist">artiste</label>
            <input type="text" name="artist" maxlength="50" required>
            <br>

            <label for="theater">salle de spectacle</label>
            <input type="text" name="theater" maxlength="45" required>
            <br>

            <label for="date">date</label>
            <input type="datetime-local" name="date">
            <br>

            <label for="img">photo</label>
            <input type="file" name="img" accept="image/png, image/jpg, image/jpeg, image/jp2, image/webp" required>
            <br>

            <label for="content">contenu</label>
            <textarea name="content" cols="30" rows="10" maxlength="65535"></textarea>
            <br>

            <label for="price">Prix (€)</label>
            <input type="number" name="price" min="0" max="999,99" required>
            <br>

            <label for="link">link</label>
            <input type="url" name="link" required><br>

            <label for="category">catégorie</label>
            <select name="category" required>
                <option value="">--choisir--</option>
                <option value="Ballet">Ballet</option>
                <option value="Cirque">Cirque</option>
                <option value="Concert">Concert</option>
            </select>
            <br>

            <input type="submit" value="Ajouter">



        </form>



    </body>

</html>