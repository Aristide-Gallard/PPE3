<div id="modele">
    Modification ou creation d'avion
    <a href="index.php?uc=flotte&action=voirModeles">voirModeles</a>
    <a href="index.php?uc=flotte&action=voirAvions">voir Avions</a>
    <a href="index.php?uc=flotte&action=creerModele">creer modele</a>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form action="index.php?uc=flotte&action=confirmSupprAvion" method="post">
                    <label for="id">Id de l'avion</label>
                    <input id="id" name="id" type="number" value="<?php echo $avion['Id_AVION'] ?>" readonly="true" required><br>
                    <label for="code">code</label>
                    <input id="code" name="code" type="text" value="<?php echo $avion['code'] ?>" readonly="true" required><br>
                    <label for="numSerie">numSerie</label>
                    <input id="numSerie" name="numSerie" type="number" value="<?php echo $avion['numSerie'] ?>" readonly="true" required><br>
                    <label for="modele">modele</label>
                    <select id="modele" name="modele" required readonly="true">
                        <option selected value="<?php echo $avion['Id_MODELE'] ?>"><?php echo $avion['libelle']?></option>
                    </select>
                    <br>
                    <input type="submit" value="Valider" name="valider">
                    <input type="reset" value="Annuler" name="annuler">
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</div>