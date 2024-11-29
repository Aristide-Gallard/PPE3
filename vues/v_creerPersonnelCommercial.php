
<div id="mudry">
    Ceci est un accueil
    <a href="index.php?uc=flotte&action=voirModeles">voirModeles</a>
    <a href="index.php?uc=Personnel&action=voirPersonnel">voirPersonnel</a>

</div>
<form action="index.php?uc=Personnel&action=confirmCreatPersonnelC" method="post">
    <label for="telP">Téléphone :</label>
    <input type="text" id="telP" name="tel" required>
    <br><br>
    <input type="checkbox" name="colors[]" value="langue1" id="color_red" />
    <label for="color_red">Français</label>
    <input type="checkbox" name="colors[]" value="langue2" id="color_green" />
    <label for="color_red">Anglais</label>
    <input type="checkbox" name="colors[]" value="langue3" id="color_blue" />
    <label for="color_red">Espagnol</label>
    <br><br>
    <input type="submit" value="Créer le personnel">
</form>