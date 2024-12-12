<div class="container mt-5">
    <h2>Ajouter un aéroport</h2>
    <form method="POST" action="index.php?uc=vol&action=confirmAjouterAeroport">
        <div class="form-group">
            <label for="aita">N° AITA :</label>
            <input type="text" class="form-control" id="aita" name="aita" pattern="[A-Z]{3}" title="Le code AITA doit être composé de trois lettres" required>
        </div>
        </div>
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="form-group">
            <label for="latitude">Latitude (en °) :</label>
            <input type="number" step="0.001" class="form-control" id="latitude" name="latitude" required>
        </div>
        <div class="form-group">
            <label for="longitude">Longitude (en °) :</label>
            <input type="number" step="0.001" class="form-control" id="longitude" name="longitude" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php?uc=vol&action=gererAeroport'">Annuler</button>
    </form>
</div>

