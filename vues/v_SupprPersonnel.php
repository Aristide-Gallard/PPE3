<!DOCTYPE html>
<html>
    <head>
        <title>Supression d'un  Personnel</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="style.css" rel="stylesheet" type="text/css" /> 

    </head>
	<?php

             $id = $LesPersonnels['Id_PERSONNEL'];
            $tel = $LesPersonnels['tel']; 
            echo $num;
           ?>
			
	
   <body>
   <p><h1>Supression Personnel:</h1></p><BR/>
	<form action="index.php?uc=Personnel&action=confirmSupprPersonnel&num=<?php echo $num?>" method="post">
                <br/>
		<input type="submit" value="Valider">
	</form>
	<?php  ?>

	</body>
</html>