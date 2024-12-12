<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation d'ajout d'aéroport</title>
</head>
<body>
    <h1>L'aéroport a bien été ajouté :</h1>
    <p>N° AITA : <?php echo ($_POST['aita']); ?></p>
    <p>Nom : <?php echo ($_POST['nom']); ?></p>
    <p>Latitude (en °) : <?php echo ($_POST['latitude']); ?></p>
    <p>Longitude (en °) : <?php echo ($_POST['longitude']); ?></p>
    <a href="index.php?uc=vol&action=gererAeroport">Retour</a>
</body>
</html>
