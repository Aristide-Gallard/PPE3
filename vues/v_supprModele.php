<div class="supprModele">
    Suppression
    <a href="index.php?uc=flotte&action=voirModeles">voirModeles</a>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form action="index.php?uc=flotte&action=confirmSupprModele" method="post">
                    <label for="id">Id du modele</label>
                    <input id="id" name="id" type="number" value="<?php echo $modele['Id_MODELE'] ?>"
                        readonly="true"><br>
                    <label for="libelle">libelle</label>
                    <input id="libelle" name="libelle" type="text" value="<?php echo $modele['libelle'] ?> "
                        readonly="true"><br>
                    <label for="nbSiege">nbSiege</label>
                    <input id="nbSiege" name="nbSiege" type="number" value="<?php echo $modele['nbSiege'] ?>"
                        readonly="true"><br>
                    <label for="CDB">CDB</label>
                    <input id="CDB" name="CDB" type="number" value="<?php echo $modele['CDB'] ?>" readonly="true"><br>
                    <label for="OPL">OPL</label>
                    <input id="OPL" name="OPL" type="number" value="<?php echo $modele['OPL'] ?>" readonly="true"><br>
                    <label for="CCP">CCP</label>
                    <input id="CCP" name="CCP" type="number" value="<?php echo $modele['CCP'] ?>" readonly="true"><br>
                    <label for="CC">CC</label>
                    <input id="CC" name="CC" type="number" value="<?php echo $modele['CC'] ?>" readonly="true"><br>
                    <label for="H/S">H/S</label>
                    <input id="H/S" name="H/S" type="number" value="<?php echo $modele['H/S'] ?>" readonly="true"><br>
                    <input type="submit" value="Supprimer" name="valider">
                    <input type="reset" value="Annuler" name="annuler">
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</div>