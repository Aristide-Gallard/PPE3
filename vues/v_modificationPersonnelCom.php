<!-- Formulaire pour ajouter des langues via des cases à cocher -->
<h1>Modifier les langues du Personnel Commercial</h1>

<form action="index.php?uc=Personnel&action=ajouterLangue" method="post">
    <?php 
    // Récupérer les informations du personnel commercial
    $LesPersonnels = $pdo->getlePersonnelC($num);
    $num = $LesPersonnels['id_PERSONNEL']; // Assurez-vous que 'id_PERSONNEL' est bien la clé primaire
    $tel = $LesPersonnels['tel']; 
    ?>
    
    <!-- Champ pour modifier le téléphone -->
    <label for="telP">Téléphone :</label>
    <input type="text" id="telP" name="tel" value="<?php echo htmlspecialchars($tel); ?>" required>

    <!-- ID du personnel caché dans un champ -->
    <input type="hidden" name="num" value="<?php echo htmlspecialchars($num); ?>">

    <!-- Langues parlées : Affichage des langues disponibles -->
    <label for="langues">Langues parlées (choisissez les nouvelles langues) :</label><br>

    <?php
    // Affichage des langues disponibles dans la base de données
    // $toutesLangues contient toutes les langues disponibles dans la base de données
    foreach ($toutesLangues as $langue) {
        // Vérification si la langue est déjà sélectionnée pour ce personnel
        $checked = in_array($langue['Id_LANGUE'], $languesParlees) ? 'checked' : '';
        echo '<label>';
        echo '<input type="checkbox" name="langues[]" value="' . $langue['Id_LANGUE'] . '" ' . $checked . '> ' . $langue['nom'];
        echo '</label><br>';
    }
    ?>
    
    <input type="submit" value="Ajouter les langues">
</form>
