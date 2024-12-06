<div id="equipage">
<form method="POST" action="index.php?uc=equipage&action=confirmerModifEquipage">
   <fieldset>
     <legend>Modifier equipage</legend>
            <br>

			<div class="form-group">
            <label for="mouvement">Id_MOUVEMENT</label>
            <input name="mouvement" id="mouvement" type="number" value="<?php echo $idM ?>" readonly="true">
            </div>
            <br>

            <div class="form-group">
            <label for="personnel">Id_PERSONNEL</label>
            <input name="personnel" id="personnel" type="number" value="<?php echo $idP ?>" readonly="true">
            </div>
            <br>

            <div class="form-group">
            <label for="present">Present</label>
            <input name="present" id="present" type="number" max="1" min="0" value="">
            </div>
            <br>

            <div class="form-group">
            <label for="role">Id_ROLE</label>
            <select name="role" id="role" class="form-control" required>
                <option value="<?php echo $personnel['Id_ROLE'] ?>" selected><?php echo $personnel['Id_ROLE'] ?></option>
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