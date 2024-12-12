<div id="modele">
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
            <h1>Suppression du vol suivant :</h1>
        
                <div>
                    <p>N° de vol : <?php echo ($mouvement['numV']); ?></p>
                    <p>Nombre de places : <?php echo ($mouvement['nbPlace']); ?></p>
                    <p>Distance : <?php echo ($mouvement['distance']); ?></p>
                    <p>Heure de départ : <?php echo ($mouvement['heureD']); ?></p>
                    <p>Durée : <?php echo ($mouvement['duree']); ?></p>
                    <p>Heure d'arrivée : <?php echo ($mouvement['heureA']); ?></p>
                    <p>Aéroprot de départ : <?php echo ($mouvement['Id_AEROPORT']); ?></p>
                    <p>Aéroprot d'arrivée : <?php echo ($mouvement['Id_AEROPORT_1']); ?></p>
                    <p>Appareil : <?php echo ($mouvement['code']); ?></p>
                </div>
                
                <form method="post" action="index.php?uc=vol&action=confirmSupprMouvement">
                    <input type="hidden" name="id" value="<?php echo ($mouvement['Id_MOUVEMENT']); ?>">
                    <input type="submit" class="btn btn-primary" value="Valider" name="valider">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php?uc=vol&action=gererMouvement'">Annuler</button>               
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</div>