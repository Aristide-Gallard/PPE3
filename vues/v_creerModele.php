<div id="modele">
    creation de modele
    <a href="index.php?uc=flotte&action=voirModeles">voirModeles</a>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form action="index.php?uc=flotte&action=confirmCreerModele" method="post">
                    <legend>Creation de modele</legend>
                    <label for="libelle">libelle</label>
                    <input id="libelle" name="libelle" type="text" required><br>
                    <label for="nbSiege">nbSiege</label>
                    <input id="nbSiege" name="nbSiege" type="number" required><br>
                    <label for="CDB">CDB</label>
                    <input id="CDB" name="CDB" type="number" required><br>
                    <label for="OPL">OPL</label>
                    <input id="OPL" name="OPL" type="number" required><br>
                    <label for="CCP">CCP</label>
                    <input id="CCP" name="CCP" type="number" required><br>
                    <label for="CC">CC</label>
                    <input id="CC" name="CC" type="number" required><br>
                    <label for="H/S">H/S</label>
                    <input id="H/S" name="H/S" type="number" required><br>
                    <input type="submit" value="Valider" name="valider">
                    <input type="reset" value="Annuler" name="annuler">
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</div>