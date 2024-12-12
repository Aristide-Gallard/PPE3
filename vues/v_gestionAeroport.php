<div id="gestionAeroport">
<a href="index.php?uc=accueil" class="button">Retour</a>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Tableau de la gestion des aéroports</title>
</head>
<body>

<div class="container mt-5">
<h2>Liste des aéroports <a href=index.php?uc=vol&action=ajouterAeroport><img src="images/boutonAjouter.jpg" height = 35 px></a></h2>
<table class="table table-striped">

        <thead>
            <tr>
                <th>n° aita</th>
                <th>nom</th>
                <th>latitude (en °)</th>
                <th>longitude (en °)</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($aeroports)): ?>
                <?php foreach ($aeroports as $aeroport): ?>
                    <tr>
                        <td><?= ($aeroport['aita']) ?></td>
                        <td><?= ($aeroport['nom']) ?></td>
                        <td><?= ($aeroport['latitude']) ?></td>
                        <td><?= ($aeroport['longitude']) ?></td>
                        <td><a href="index.php?uc=vol&action=modifierAeroport&id=<?php echo $aeroport['Id_AEROPORT']; ?>"><img src="images/modif.jpg" height = 35 px></a></td>
                        <td><a href="index.php?uc=vol&action=supprimerAeroport&id=<?php echo $aeroport['Id_AEROPORT']; ?>"><img src="images/supp.png" height = 35 px></a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">Aucun aéroport enregistré.</td>
                </tr>
            <?php endif; ?>
        </tbody>

    </table>
</div>
</body>
</html>

