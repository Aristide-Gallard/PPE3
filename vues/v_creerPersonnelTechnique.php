
<div id="mudry">
    Ceci est un accueil
    <a href="index.php?uc=flotte&action=voirModeles">voirModeles</a>
    <a href="index.php?uc=Personnel&action=voirPersonnel">voirPersonnel</a>

</div>
<form action="index.php?uc=Personnel&action=confirmCreatPersonnelT" method="post">
    <label for="telP">Téléphone :</label>
    <input type="text" id="telP" name="tel" required>
    <br><br>
    <label for="heureV">Heure de vol :</label>
    <input type="text" id="heureV" name="heureV" required>
    <br><br>
    <input type="submit" value="Créer le personnel">
</form>