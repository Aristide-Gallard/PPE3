<!DOCTYPE html>
<html>
    <head>
        <title>Supression d'un  Personnel</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="style.css" rel="stylesheet" type="text/css" /> 

    </head>
	<?php
       
        $num = $LesPersonnels['num']; 
        $tel = $LesPersonnels['tel']; 
           ?>
			
	
   <body>
   <p><h1>Supression Personnel:</h1></p><BR/>
	<form action="index.php?uc=Personnel&action=confirmSupprPersonnel<?php echo $typeP?>&num=" method="post">
                <br/>
		<input type="submit" value="Valider">
	</form>
	<?php  ?>

	</body>
</html>