<div id="gestionAeroport">
<a href="index.php?uc=accueil" class="button">Retour</a>
Ceci est la gestion des aéroports
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Tableau de la gestion des aéroports</title>
</head>
<body>

<div class="container mt-5">
    <h2>Liste des aéroports</h2>
    <table class="table table-striped">

        <thead>
            <tr>
                <th>n° aita</th>
                <th>nom</th>
                <th>latitude</th>
                <th>longitude</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($aeroports)): ?>
                <?php foreach ($aeroports as $aeroport): ?>
                    <tr>
                        <td><?= htmlspecialchars($aeroport['aita']) ?></td>
                        <td><?= htmlspecialchars($aeroport['nom']) ?></td>
                        <td><?= htmlspecialchars($aeroport['latitude']) ?></td>
                        <td><?= htmlspecialchars($aeroport['longitude']) ?></td>
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

