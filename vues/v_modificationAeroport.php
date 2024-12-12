<div class="container mt-5">
    <h2>Modifier un aéroport</h2>
    <form method="POST" action="index.php?uc=vol&action=confirmModifierAeroport">
        <input type="hidden" name="id" value="<?php echo ($aeroport['Id_AEROPORT']); ?>">
        <div class="form-group">
            <label for="aita">N° AITA :</label>
            <input type="text" class="form-control" id="aita" name="aita" pattern="[A-Z]{3}" title="Le code AITA doit être composé de trois lettres" value="<?php echo ($aeroport['aita']); ?>" required>
        </div>
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo ($aeroport['nom']); ?>" required>
        </div>
        <div class="form-group">
            <label for="latitude">Latitude (en °) :</label>
            <input type="number" step="0.001" class="form-control" id="latitude" name="latitude" value="<?php echo ($aeroport['latitude']); ?>" required>
        </div>
        <div class="form-group">
            <label for="longitude">Longitude (en °) :</label>
            <input type="number" step="0.001" class="form-control" id="longitude" name="longitude" value="<?php echo ($aeroport['longitude']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php?uc=vol&action=gererAeroport'">Annuler</button>
    </form>
</div>
>