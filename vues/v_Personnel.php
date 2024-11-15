<?php

{
	$id_Personnel = $unPersonnel['id_Personnel'];
	$tel = $unPersonnel['tel'];

	
	?>
	
	<?php
	   echo	$id_Personnel."($nom )";
	?>	
	<a href="index.php?uc=Personnel=<?php echo $id ?>&action=gererrole" onclick="return confirm('Voulez-vous vraiment retirer cet article frais?');">

	
	
	</p>
	<?php
}
?>
<br>
<a href=index.php?uc=gererPanier&action=passerCommande></a>
