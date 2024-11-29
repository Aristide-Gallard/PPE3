<!doctype html>
<html>

<head>
    <title>Liste equipages</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="" />
</head>
<body>
    <h1>Liste des equipages</h1>

    <!-- Tableau des equipages -->
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Id_MOUVEMENT</th>
                    <th scope="col">Id_PERSONNEL</th>
                    <th scope="col">present</th>
                    <th scope="col">Id_ROLE</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($LesEquipages as $unEquipage){
                ?>
                    <tr>
                        <td><?php echo $unEquipage['Id_MOUVEMENT'] ?></td>
                        <td><?php echo $unEquipage['Id_PERSONNEL']; ?></td>
                        <td><?php echo $unEquipage['present']; ?></td>
                        <td><?php echo $unEquipage['Id_ROLE']; ?></td>
                        <td>
                            <a href="index.php?uc=Equipage&action=ajouterAEquipage&num=<?php echo $mouvement; ?>">
                            <img src="images/boutonAjouter.jpg" title="Ajouter">
                            </a>
                        </td>
                        <td>
                            <a href="index.php?uc=Equipage&action=modifierEquipage&num=<?php echo $mouvement; ?>">
                                <img src="images/modifier.gif" title="Modifier">
                            </a>
                        </td>
                        <td>
                            <a href="index.php?uc=Equipage&action=supressionAEquipage&num=<?php echo $mouvement; ?>">
                                <img src="images/supp.png" title="Supprimer">
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
</body>
</html>
