<div id="equipage">
<form method="POST" action="index.php?uc=equipage&action=confirmerSuppEquipage">
   <fieldset>
     <legend>Supprimer equipage ?</legend>
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
            <input name="present" id="present" type="number" value="<?php echo $idPr ?>" readonly="true">
            </div>
            <br>

            <div class="form-group">
            <label for="role">Id_ROLE</label>
            <input name="role" id="role" type="number" value="<?php echo $idR ?>" readonly="true">
            </div>
            <br>
        <input type="submit" value="Valider" name="valider">
      </p>
</form>
</div>