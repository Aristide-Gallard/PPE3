<div id="equipage">
<form method="POST" action="index.php?uc=equipage&action=confirmerAjoutEquipage">
   <fieldset>
     <legend>Ajout equipage</legend>
            <br>

			<div class="form-group">
            <label for="mouvement">Id_MOUVEMENT</label>
            <select name="mouvement" id="mouvement" class="form-control" required>
			    <option selected disabled>Choisir un mouvement</option>
                <?php foreach ($LesMouvements as $unMouvement): ?>
                    <option value="<?php echo $unMouvement['Id_MOUVEMENT']; ?>"><?php echo $unMouvement['Id_MOUVEMENT']; ?></option>
                <?php endforeach; ?>
            </select>
            </div>
            <br>

            <div class="form-group">
            <label for="personnel">Id_PERSONNEL</label>
            <select name="personnel" id="personnel" class="form-control" required>
			    <option selected disabled>Choisir un personnel</option>
                <?php foreach ($LesPersonnels as $unPersonnel): ?>
                    <option value="<?php echo $unPersonnel['Id_PERSONNEL']; ?>"><?php echo $unPersonnel['Id_PERSONNEL']." - ".$unPersonnel['tel']; ?></option>
                <?php endforeach; ?>
            </select>
            </div>
            <br>
            
            <div class="form-group">
            <label for="present">Present</label>
            <select name="present" id="present" class="form-control" required>
			    <option selected disabled>Définir la presence</option>
                <option value="0">0</option>
                <option value="1">1</option>
            </select>
            </div>
            <br>
            
            <div class="form-group">
            <label for="role">Id_ROLE</label>
            <select name="role" id="role" class="form-control" required>
			    <option selected disabled>Choisir un role</option>
                <?php foreach ($LesRoles as $unRole): ?>
                    <option value="<?php echo $unRole['Id_ROLE']; ?>"><?php echo $unRole['Id_ROLE']." - ".$unRole['nom']; ?></option>
                <?php endforeach; ?>
            </select>
            </div>
            <br>
        <input type="submit" value="Valider" name="valider">
        <input type="reset" value="Annuler" name="annuler">
      </p>
</form>
</div>