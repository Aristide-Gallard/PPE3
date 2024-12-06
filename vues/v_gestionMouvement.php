<div id="gestionMouvement">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Tableau de la gestion des vols</title>
</head>
<body>

<h1>Gestion des vols</h1>

<div class="container mt-5">
    <h2>Liste des vols <a href=index.php?uc=vol&action=ajouterMouvement><img src="images/boutonAjouter.jpg" height = 35 px></a></h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>n° vol</th>
                <th>nombre de places</th>
                <th>distance</th>
                <th>durée</th>
                <th>heure de départ</th>
                <th>heure d'arrivée</th>
                <th>aéroport de départ</th>
                <th>aéroport d'arrivée</th>
                <th>avion</th>


            </tr>
        </thead>
        <tbody>
            <?php if (!empty($mouvements)): ?>
                <?php foreach ($mouvements as $mouvement): ?>
                    <tr>
                        <td><?= htmlspecialchars($mouvement['numV']) ?></td>
                        <td><?= htmlspecialchars($mouvement['nbPlace']) ?></td>
                        <td><?= htmlspecialchars($mouvement['distance']) ?></td>
                        <td><?= htmlspecialchars($mouvement['heureD']) ?></td>
                        <td><?= htmlspecialchars($mouvement['duree']) ?></td>
                        <td><?= htmlspecialchars($mouvement['heureA']) ?></td>
                        <td><?= htmlspecialchars($mouvement['Id_AEROPORT']) ?></td>
                        <td><?= htmlspecialchars($mouvement['Id_AEROPORT_1']) ?></td>
                        <td><?= htmlspecialchars($mouvement['Id_AVION']) ?></td>
                        <td><a href=index.php?uc=vol&action=modifierMouvement><img src="images/modif.jpg" height = 35 px></a></td>
                        <td><a href=index.php?uc=vol&action=supprimerMouvement><img src="images/supp.png" height = 35 px></a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">Aucun vol en cours.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

