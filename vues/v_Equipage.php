<!doctype html>
<html>
<a href="index.php?uc=accueil">Retour</a>
<head>
    <title>Liste equipages</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="" />
</head>
<body>
    <h1>Liste des equipages</h1>
        <a href="index.php?uc=equipage&action=ajouterAEquipage">
        <div style="text-align: right;padding-right: 10px">
            <img src="images/boutonAjouter.jpg" title="Ajouter" width=3% height=3%>
        </style>
    </div>
        </a>

    <!-- Tableau des equipages -->
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Id_MOUVEMENT</th>
                    <th scope="col">Id_PERSONNEL</th>
                    <th scope="col">present</th>
                    <th scope="col">Id_ROLE</th>
                    <th scope="col">Modifier</th>
                    <th scope="col">Supprimer</th>
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
                            <a href="index.php?uc=equipage&action=modifierAEquipage&idM=<?php echo $unEquipage['Id_MOUVEMENT'] ?>&idP=<?php echo $unEquipage['Id_PERSONNEL'] ?>">
                                <img src="images/modif.jpg" title="Modifier" width=10% height=10%>
                            </a>
                        </td>
                        <td>
                            <a href="index.php?uc=equipage&action=supprimerAEquipage&idM=<?php echo $unEquipage['Id_MOUVEMENT'] ?>&idP=<?php echo $unEquipage['Id_PERSONNEL'] ?>&idPr=<?php echo $unEquipage['present']?>&idR=<?php echo $unEquipage['Id_ROLE'] ?>">
                                <img src="images/supp.png" title="Supprimer">
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
</body>
</html>
