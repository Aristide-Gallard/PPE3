<!doctype html>
<html>

<head>
    <title>Liste Personnel</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="design.css" />
</head>
<body>
    <form action="index.php?uc=creerPersonnel&action=creerPersonnel" method="post">
        <p><H1>Liste des personnels</H1><br>

        <table border=3 cellspacing=1 >
            <thead>
                <tr>
                    <th>Téléphone :</th>
                </tr> 
            </thead>
        <?php
       
        if (isset($lesPersonnels) && !empty($lesPersonnels)) {
            foreach ($lesPersonnels as $unPersonnel) {
                $tel = $unPersonnel['tel']; 
                ?>
                <tr>
                    <td width=150><?php echo($tel); ?></td>
                    <td width=30><a href="index.php?uc=modifierPersonnel&action=modificationPersonnel&num=<?php echo htmlspecialchars($unPersonnel['id_PERSONNEL']); ?>"><img src="images/modifier.gif" title="Modifier"></a></td>
                    <td width=30><a href="index.php?uc=supprimerPersonnel&action=suppressionPersonnel&num=<?php echo htmlspecialchars($unPersonnel['id_PERSONNEL']); ?>"><img src="images/supp.png" title="Supprimer"></a></td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td>Aucun personnel disponible.</td></tr>";
        }
        ?>
        </table>
        </br>
        <form action="index.php?uc=creerPersonnel&action=creerPersonnel" method="get">
    <input type="submit" value="Créer un nouveau personnel">
</form>

    </form>
</body>
</html>