<!-- Formulaire pour ajouter des langues via des cases à cocher -->
<?php
       $LesPersonnels = $pdo->getlePersonnelC($num);
      
        $tel = $LesPersonnels['tel'];  
               
        ?> <br>
        <h1>Modification du Personnel commercial</h1>
<form action="index.php?uc=Personnel&action=ajouterLangue" method="post">
    <label for="telP">Téléphone :</label>
    <input type="text" id="telP" name="tel" value="<?php echo ($tel); ?>" required>

    <input type="hidden" name="num" value="<?php echo ($num); ?>"><br><br>

    <label for="langues">Langues parlées (choisissez les nouvelles langues) :</label>
    <br><?php
    foreach ($toutesLangues as $langue) {
        echo '<label>';
        echo '<input type="checkbox" name="langues[]" value="' . ($langue['Id_LANGUE']) . '"> ' . ($langue['nom']);
        echo '</label><br>';
    }
    ?><br><br>
    <input type="submit" value="Ajouter les langues">
    <input type="reset" value="Annuler" name="annuler">
</form>
