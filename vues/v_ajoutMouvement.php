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
       
        <form method="POST" action="index.php?uc=vol&action=confirmAjouterMouvement">
            <div class="form-row">
                <div class="form-group">
                    <label>N° du vol</label>
                    <input type="text" class="form-control" id="numV" name="numV" placeholder="Entrez un nombre" required>
                </div>

                <div class="form-group">
                    <label>Nombre de places</label>
                    <input type="number" class="form-control" id="nbPlace" name="nbPlace" placeholder="Entrez un nombre" required>
                </div>

                <div class="form-group">
                    <label>Distance (km)</label>
                    <input type="number" class="form-control" id="distance" name="distance" placeholder="Entrez un nombre" required>
                </div>

                <div class="form-group">
                    <label for="departureDate">Heure de départ</label>
                    <input type="time" class="form-control" id="heureD" name="heureD" required>
                </div>

                <div class="form-group">
                    <label>Durée (minute)</label>
                    <input type="number" class="form-control" id="duree" name="duree" placeholder="Entrez un nombre" required>
                </div>

                <div class="form-group">
                    <label for="arrivalDate">Heure d'arrivée</label>
                    <input type="time" class="form-control" id="heureA" name="heureA" required>
                </div>

                <div class="form-group">
                <label>Aéroport de départ</label>
                <select id="Id_AEROPORT" name="Id_AEROPORT" class="form-control" required>
                    <option value="">Choisir un aéroport...</option>
                    <?php foreach ($lesAeroports as $aeroport): ?>
                        <option value="<?php echo $aeroport['Id_AEROPORT']; ?>"><?php echo $aeroport['nom']; ?></option>
                    <?php endforeach; ?>
                </select>
                </div>

                <div class="form-group">
                    <label>Aéroport d'arrivée</label>
                    <select id="Id_AEROPORT_1" name="Id_AEROPORT_1" class="form-control" required>
                        <option value="">Choisir un aéroport...</option>
                        <?php foreach ($lesAeroports as $aeroport): ?>
                            <option value="<?php echo $aeroport['Id_AEROPORT']; ?>"><?php echo $aeroport['nom']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Appareil</label>
                    <select id="Id_AVION" name="Id_AVION" class="form-control" required>
                        <option value="">Choisir un appareil...</option>
                        <?php foreach ($lesAvions as $avion): ?>
                            <option value="<?php echo $avion['Id_AVION']; ?>"><?php echo $avion['code']; ?></option>
                        <?php endforeach; ?>
                    </select>

            </div>
            <button type="submit" class="btn btn-primary">Valider</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php?uc=vol&action=gererMouvement'">Annuler</button>
        </form>
    </div>

</form>
