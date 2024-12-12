<div class="container mt-5">
    <h2>Supprimer un aéroport</h2>
    <ul>
        <li><strong>N° AITA : </strong><?php echo ($aeroport['aita']); ?></li>
        <li><strong>Nom : </strong><?php echo ($aeroport['nom']); ?></li>
        <li><strong>Latitude : </strong><?php echo ($aeroport['latitude']); ?></li>
        <li><strong>Longitude : </strong><?php echo ($aeroport['longitude']); ?></li>
    </ul>
    <form method="POST" action="index.php?uc=vol&action=confirmSupprAeroport">
        <input type="hidden" name="id" value="<?php echo ($aeroport['Id_AEROPORT']); ?>">
        <button type="submit" class="btn btn-danger">Supprimer</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php?uc=vol&action=gererAeroport'">Annuler</button>
    </form>
</div>
