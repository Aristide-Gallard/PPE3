<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Modification des Vols</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Modification du mouvement</h1>
        <h3>Changer uniquement les champs à modifier</h3>
       
        <form method="POST" action="index.php?uc=vol&action=confirmModifierMouvement">
            <div class="form-row">
                <input type="hidden" name="Id_MOUVEMENT" value="<?php echo ($mouvement['Id_MOUVEMENT']); ?>">
                <div class="form-group">
                    <label>N° du vol : </label>
                    <input type="text" class="form-control" id="numV" name="numV" value="<?php echo ($mouvement['numV']); ?>" placeholder="Entrez un nombre" required>
                </div>

                <div class="form-group">
                    <label>Nombre de places : </label>
                    <input type="number" class="form-control" id="nbPlace" name="nbPlace" value="<?php echo ($mouvement['nbPlace']); ?>" placeholder="Entrez un nombre" required>
                </div>

                <div class="form-group">
                    <label>Distance (km) : </label>
                    <input type="number" class="form-control" id="distance" name="distance" value="<?php echo ($mouvement['distance']); ?>" placeholder="Entrez un nombre" required>
                </div>

                <div class="form-group">
                    <label>Durée (minute) : </label>
                    <input type="number" class="form-control" id="duree" name="duree" value="<?php echo ($mouvement['duree']); ?>" placeholder="Entrez un nombre" required>
                </div>

                <div class="form-group">
                    <label for="departureDate">Heure de départ </label>
                    <input type="time" class="form-control" id="heureD" name="heureD" value="<?php echo ($mouvement['heureD']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="arrivalDate">Heure d'arrivée </label>
                    <input type="time" class="form-control" id="heureA" name="heureA" value="<?php echo ($mouvement['heureA']); ?>" required>
                </div>

                <div class="form-group">
                    <label>Aéroport de départ : </label>
                    <select id="Id_AEROPORT" name="Id_AEROPORT" class="form-control" required>
                        <?php foreach ($lesAeroports as $aeroport): ?>
                            <option value="<?php echo $aeroport['Id_AEROPORT']; ?>" <?php echo ($aeroport['Id_AEROPORT'] == $mouvement['Id_AEROPORT']) ? 'selected' : ''; ?>>
                                <?php echo $aeroport['nom']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Aéroport d'arrivée : </label>
                    <select id="Id_AEROPORT_1" name="Id_AEROPORT_1" class="form-control" required>
                        <?php foreach ($lesAeroports as $aeroport): ?>
                            <option value="<?php echo $aeroport['Id_AEROPORT']; ?>" <?php echo ($aeroport['Id_AEROPORT'] == $mouvement['Id_AEROPORT_1']) ? 'selected' : ''; ?>>
                                <?php echo $aeroport['nom']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Appareil : </label>
                    <select id="Id_AVION" name="Id_AVION" class="form-control" required>
                        <?php foreach ($lesAvions as $avion): ?>
                            <option value="<?php echo $avion['Id_AVION']; ?>" <?php echo ($avion['Id_AVION'] == $mouvement['Id_AVION']) ? 'selected' : ''; ?>>
                                <?php echo $avion['code']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                </br>
                <button type="submit" class="btn btn-primary">Valider</button>
                <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php?uc=vol&action=gererMouvement'">Annuler</button>
            </div>
        </form>

    </div>

</form>
