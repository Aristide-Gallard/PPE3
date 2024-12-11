<!doctype html>
<html>
<head>
    <title>Liste Personnel</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="" />
</head>
<body>


    <h1>Liste des personnels commerciaux    <a href="index.php?uc=Personnel&action=creationPersonnelC"><img src="Images/boutonAjouter.jpg" height = 35 px></a></a></h1>

<?php if (isset($LesPersonnelsC) && !empty($LesPersonnelsC)): ?>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Téléphone</th>
                <th scope="col">Langue</th>
                <th scope="col">Modifier</th>
                <th scope="col">Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($LesPersonnelsC as $unPersonnel): 
                    $langues = $pdo->getLanguesPersonnel($unPersonnel['Id_PERSONNEL']);
                ?>
                <tr>
                    <td><?php echo ($unPersonnel['Id_PERSONNEL']); ?></td>
                    <td><?php echo ($unPersonnel['tel']); ?></td>
                    <td><?php foreach ($langues as $langue){echo $langue['nom']." ";} ?></td>
                    <td>
                        <a href="index.php?uc=Personnel&action=modificationPersonnelC&num=<?php echo $unPersonnel['Id_PERSONNEL']; ?>">
                            <img src="images/modifier.gif" title="Modifier">
                        </a>
                    </td>
                    <td>
                        <a href="index.php?uc=Personnel&action=supressionPersonnelC&num=<?php echo $unPersonnel['Id_PERSONNEL']; ?>">
                            <img src="images/supp.png" title="Supprimer">
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Aucun personnel disponible.</p>
<?php endif; ?>

    <br><br>
    <h1>Liste des personnels Techniques <a href="index.php?uc=Personnel&action=creationPersonnelT"><img src="Images/boutonAjouter.jpg" height = 35 px></a></a></a></h1>
    <?php if (isset($LesPersonnelsT) && !empty($LesPersonnelsT)): ?>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Téléphone</th>
                    <th scope="col">Heure de vol</th>
                    <th scope="col">Modifier</th>
                    <th scope="col">Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($LesPersonnelsT as $unPersonnel):
                    $tel = ($unPersonnel['tel']);
                    $id = ($unPersonnel['Id_PERSONNEL']);
                    $heureV = ($unPersonnel['heureV']);

                    ?>
                    <tr>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $tel; ?></td>
                        <td><?php echo $heureV; ?></td>
                        <td>
                            <a href="index.php?uc=Personnel&action=modificationPersonnelT&num=<?php echo $id; ?>">
                                <img src="images/modifier.gif" title="Modifier">
                            </a>
                        </td>
                        <td>
                            <a href="index.php?uc=Personnel&action=supressionPersonnelT&num=<?php echo $id; ?>">
                                <img src="images/supp.png" title="Supprimer">
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun personnel disponible.</p>
    <?php endif; ?>
    
    <!-- Formulaire pour créer un nouveau personnel -->
</body>
</html>