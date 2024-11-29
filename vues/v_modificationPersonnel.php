<!DOCTYPE html>
<html>
    <head>
        <title>Modification d'un Personnel</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link href="style.css" rel="stylesheet" type="text/css" /> 
    </head>
    <body>
        <?php
       $LesPersonnels = $pdo->getlePersonnel($num);
        $num = $LesPersonnels['num']; 
        $tel = $LesPersonnels['tel'];         
        ?>
        <h1>Modification du Personnel</h1>
        <form action="index.php?uc=Personnel&action=confirmModifPersonnel" method="post">
            <label for="telP">Téléphone :</label>
            <input type="text" id="telP" name="tel" value="<?php echo $tel; ?>" required>
            <input type="hidden" name="num" value="<?php echo $num; ?>">
            <input type="submit" value="Modifier le personnel">
        </form>
    </body>
</html>
