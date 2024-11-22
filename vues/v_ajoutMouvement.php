<div id="creationCategorie">
<form method="POST" action="index.php?uc=vol&action=confirmerAjoutMouvement">

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Gestion des Vols</title>
</head>
<body>
    <div class="container mt-5">
        <a href="index.php?uc=vol&action=gererMouvement">Retour</a>
        <h1>Ajout d'un mouvement </h1>
       

        <form>
            <div class="form-row">
                <div class="form-group">
                    <label for="flightNumber">N° du vol</label>
                    <input type="text" class="form-control" id="numV" placeholder="Entrez un nombre" required>
                </div>

                <div class="form-group">
                    <label for="flightNumber">Nombre de places</label>
                    <input type="text" class="form-control" id="nbPlaces" placeholder="Entrez un nombre" required>
                </div>

                <div class="form-group">
                    <label for="flightNumber">Distance (km)</label>
                    <input type="text" class="form-control" id="distance" placeholder="Entrez un nombre" required>
                </div>

                <div class="form-group">
                    <label for="flightNumber">Durée (minute)</label>
                    <input type="text" class="form-control" id="duree" placeholder="Entrez un nombre" required>
                </div>

                <div class="form-group">
                    <label for="departureDate">Heure de départ</label>
                    <input type="time" class="form-control" id="heureD" required>
                </div>

                <div class="form-group">
                    <label for="arrivalDate">Heure d'arrivée</label>
                    <input type="time" class="form-control" id="heureA" required>
                </div>

                <div class="form-group">
                <label for="departureAirport">Aéroport de départ</label>
                <select id="departureAirport" class="form-control" required>
                    <option value="">Choisir un aéroport...</option>
                    <?php foreach (getAeroports() as $aeroport): ?>
                        <option value="<?= $aeroport['id_aeroport']; ?>"><?= $aeroport['nom']; ?></option>
                    <?php endforeach; ?>
                </select>
                </div>

                <div class="form-group">
                    <label for="arrivalAirport">Aéroport d'arrivée</label>
                    <select id="arrivalAirport" class="form-control" required>
                        <option value="">Choisir un aéroport...</option>
                        <?php foreach (getAeroports() as $aeroport): ?>
                            <option value="<?= $aeroport['id_aeroport']; ?>"><?= $aeroport['nom']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="aircraft">Appareil</label>
                    <select id="aircraft" class="form-control" required>
                        <option value="">Choisir un appareil...</option>
                        <?php foreach (getAvions() as $avion): ?>
                            <option value="<?= $avion['id_avion']; ?>"><?= $avion['nom']; ?></option>
                        <?php endforeach; ?>
                    </select>

            </div>
            <button type="submit">Valider</button>
        </form>

    </div>

</form>
</div>