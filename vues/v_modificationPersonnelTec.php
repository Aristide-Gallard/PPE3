<!DOCTYPE html>
<html>
    <head>
        <title>Modification d'un Personnel</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link href="style.css" rel="stylesheet" type="text/css" /> 
    </head>
    <body>
    <div id="mudry">
    Ceci est un accueil
    <a href="index.php?uc=flotte&action=voirModeles">voirModeles</a>
    <a href="index.php?uc=Personnel&action=voirPersonnel">voirPersonnel</a>

</div>

        <?php
       $LesPersonnels = $pdo->getlePersonnelT($num);
        $num = $LesPersonnels['num']; 
        $tel = $LesPersonnels['tel'];  
        $heureV = $LesPersonnels['heureV']; 
               
        ?>
        <h1>Modification du Personnel</h1>
        <form action="index.php?uc=Personnel&action=confirmModifPersonnelT" method="post">
            <label for="telP">Téléphone :</label>
            <input type="text" id="telP" name="tel" value="<?php echo $tel; ?>" required>
            <input type="hidden" name="num" value="<?php echo $num; ?>">
            <input type="text" id="heureV" name="heureV" value="<?php echo $heureV; ?>" required>
            <input type="submit" value="Modifier le personnel">
        </form>
    </body>
</html>
