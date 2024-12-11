<!-- Formulaire pour ajouter des langues via des cases à cocher -->
<form action="index.php?uc=Personnel&action=ajouterLangue" method="post">
    <label for="telP">Téléphone :</label>
    <input type="text" id="telP" name="tel" value="<?php echo ($tel); ?>" required>

    <input type="hidden" name="num" value="<?php echo ($num); ?>">

    <label for="langues">Langues parlées (choisissez les nouvelles langues) :</label><br>
    <?php
    foreach ($toutesLangues as $langue) {
        echo '<label>';
        echo '<input type="checkbox" name="langues[]" value="' . ($langue['Id_LANGUE']) . '"> ' . htmlspecialchars($langue['nom']);
        echo '</label><br>';
    }
    ?>
    <input type="submit" value="Ajouter les langues">
</form>
