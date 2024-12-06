<div id="mudry">
    Ceci est un accueil
    <a href="index.php?uc=flotte&action=voirModeles">voirModeles</a>
    <a href="index.php?uc=Personnel&action=voirPersonnel">voirPersonnel</a>
    
    <form method="POST" action="index.php?uc=Personnel&action=confirmCreatPersonnelC">
        <label for="tel">Numéro de téléphone :</label>
        <input type="text" id="tel" name="tel" required>
<br>
        <!-- Sélection des langues parlées (cases à cocher) -->
        <label for="langues">Langues parlées :</label>
        <div>
            <?php
            // Remplir le formulaire avec des cases à cocher pour chaque langue
            foreach ($langues as $langue) {
                echo '<label>';
                echo '<input type="checkbox" name="langue[]" value="' . $langue['Id_LANGUE'] . '"> ' . $langue['nom'];
                echo '</label><br>';
            }
            ?>
        </div>

        <button type="submit">Créer personnel commercial</button>
    </form>
</div>
