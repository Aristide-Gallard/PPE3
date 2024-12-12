<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation d'ajout de mouvement</title>
</head>
<body>
    <h1>Le mouvement a bien été ajouté :</h1>
    <p>N° du vol : <?php echo ($_POST['numV']); ?></p>
    <p>Nombre de places : <?php echo ($_POST['nbPlace']); ?></p>
    <p>Distance : <?php echo ($_POST['distance']); ?> km</p>
    <p>Durée : <?php echo ($_POST['duree']); ?> heures</p>
    <p>Heure de départ : <?php echo ($_POST['heureD']); ?></p>
    <p>Heure d'arrivée : <?php echo ($_POST['heureA']); ?></p>
    <p>Aéroport de départ : <?php echo ($_POST['Id_AEROPORT']); ?></p>
    <p>Aéroport d'arrivée : <?php echo ($_POST['Id_AEROPORT_1']); ?></p>
    <p>Avion : <?php echo ($_POST['Id_AVION']); ?></p>
    <a type="button" class="btn btn-secondary" onclick="window.location.href='index.php?uc=vol&action=gererMouvement'">Retour</a>
</body>
</html>