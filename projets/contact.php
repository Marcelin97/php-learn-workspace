<?php session_start();
require_once './config/config.php';
require_once './assets/functions.php';

date_default_timezone_set('Europe/Paris');
$heure = (int)date('G');
$creneaux = CRENEAUX[date('N') - 1];
$ouvert = in_creneaux($heure, $creneaux);
$color = $ouvert ? 'green' : 'red';

// Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
if (isset($_FILES['screenshot']) && $_FILES['screenshot']['error'] == 0) {
    // Testons si le fichier n'est pas trop gros
    if ($_FILES['screenshot']['size'] <= 1000000) {
        // Testons si l'extension est autorisée
        $fileInfo = pathinfo($_FILES['screenshot']['name']);
        $extension = $fileInfo['extension'];
        $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
        if (in_array($extension, $allowedExtensions)) {
            // On peut valider le fichier et le stocker définitivement
            move_uploaded_file($_FILES['screenshot']['tmp_name'], 'uploads/' . basename($_FILES['screenshot']['name']));
            echo "L'envoi a bien été effectué !";
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - Formulaire de Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container">

        <?php include_once('header.php'); ?>

        <h1>Contactez nous</h1>

        <div class="col-md-8">
            <h5>Formulaire de contact</h5>
            <form action="submit_contact.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help">
                    <div id="email-help" class="form-text">Nous ne revendrons pas votre email.</div>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Votre message</label>
                    <textarea class="form-control" placeholder="Exprimez vous" id="message" name="message"></textarea>
                </div>
                <!-- Ajout champ d'upload ! -->
                <div class="mb-3">
                    <label for="screenshot" class="form-label">Votre capture d'écran</label>
                    <input type="file" class="form-control" id="screenshot" name="screenshot" />
                </div>
                <!-- Fin ajout du champ -->
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>

        <div class="col-md-4">
            <h5>Horaire d'ouverture : </h5>
            <!-- <?= date('N'); ?> -->
            <?php if ($ouvert): ?>
            <div class="alert alert-success">
                Le magasin est ouvert
            </div>
            <?php else: ?>
            <div class="alert alert-danger">
                Le magasin est fermé
            </div>
            <?php endif ?>
            <ul>
                <?php foreach(JOURS as $k => $jour): ?>
                <li <?php if($k + 1 === (int)date('N')): ?> style="color:<?= $color; ?>" <?php endif?>> 
                    <strong><?= $jour   ?></strong>
                    <?= creneaux_html(CRENEAUX[$k])?>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <?php include_once('footer.php'); ?>
</body>

</html>