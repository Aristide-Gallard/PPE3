<!-- Formulaire pour ajouter des langues via des cases à cocher -->
<h1>Modifier les langues du Personnel Commercial</h1>

<form action="index.php?uc=Personnel&action=ajouterLangue" method="post">
    <label for="telP">Téléphone :</label>
    <input type="text" id="telP" name="tel" value="<?php echo $tel; ?>" required>

    <!-- ID du personnel caché dans un champ -->
    <input type="hidden" name="num" value="<?php echo $num; ?>">

    <label for="langues">Langues parlées (choisissez les nouvelles langues) :</label><br>
    <?php
    // Affichage des langues disponibles dans la base de données
    foreach ($toutesLangues as $langue) {
        echo '<label>';
        echo '<input type="checkbox" name="langues[]" value="' . $langue['Id_LANGUE'] . '"> ' . $langue['nom'];
        echo '</label><br>';
    }
    ?>
    
    <input type="submit" value="Ajouter les langues">
</form>
