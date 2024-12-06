<div id="modeles">
    Ceci est l'affichage des avions
    <a href="index.php?uc=flotte&action=creerAvion"><img src="Images/boutonAjouter.jpg" height = 35 px></a>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">code</th>
                <th scope="col">numero de serie</th>
                <th scope="col">modele</th>
                <th scope="col">modifier</th>
                <th scope="col">supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($avions as $avion) {
                ?>
                <tr>
                    <td><?php echo $avion['Id_AVION'] ?></td>
                    <td><?php echo $avion['code'] ?></td>
                    <td><?php echo $avion['numSerie'] ?></td>
                    <td><?php echo "<a href='index.php?uc=flotte&action=voirModeles#".$avion['Id_MODELE']."'>".$avion['libelle']."</a>" ?></td>
                    <td><a
                            href="index.php?uc=flotte&action=modifierAvion&id=<?php echo $avion['Id_AVION'] ?>">modifier</a>
                    </td>
                    <td><a
                            href="index.php?uc=flotte&action=supprimerAvion&id=<?php echo $avion['Id_AVION'] ?>">supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
</div>