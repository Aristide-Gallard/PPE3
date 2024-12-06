<div id="modeles">
<a href="index.php?uc=accueil" class="button">Retour</a>
Ceci est l'affichage des modeles
    <a href="index.php?uc=flotte&action=voirModeles">voirModeles</a>
    <a href="index.php?uc=flotte&action=voirAvions">voir Avions</a>
    <a href="index.php?uc=flotte&action=creerModele">creer modele</a>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">libelle</th>
                <th scope="col">nbSiege</th>
                <th scope="col">CDB</th>
                <th scope="col">OPL</th>
                <th scope="col">CCP</th>
                <th scope="col">CC</th>
                <th scope="col">H/C</th>
                <th scope="col">modifier</th>
                <th scope="col">supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($modeles as $modele) {
                ?>
                <tr>
                    <td id="<?php echo $modele['Id_MODELE'] ?>"><?php echo $modele['Id_MODELE'] ?></td>
                    <td><?php echo $modele['libelle'] ?></td>
                    <td><?php echo $modele['nbSiege'] ?></td>
                    <td><?php echo $modele['CDB'] ?></td>
                    <td><?php echo $modele['OPL'] ?></td>
                    <td><?php echo $modele['CCP'] ?></td>
                    <td><?php echo $modele['CC'] ?></td>
                    <td><?php echo $modele['H/S'] ?></td>
                    <td><a
                            href="index.php?uc=flotte&action=modifierModele&id=<?php echo $modele['Id_MODELE'] ?>">modifier</a>
                    </td>
                    <td><a
                            href="index.php?uc=flotte&action=supprimerModele&id=<?php echo $modele['Id_MODELE'] ?>">supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
</div>