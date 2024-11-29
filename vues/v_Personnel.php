<!doctype html>
<html>
<head>
    <title>Liste Personnel</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="" />
</head>
<body>
    <h1>Liste des personnels</h1>
    <!-- Tableau des personnels -->
    <?php if (isset($LesPersonnels) && !empty($LesPersonnels)): ?>
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
                <?php
                foreach ($LesPersonnels as $unPersonnel):
                    $tel = ($unPersonnel['tel']);
                    $id = ($unPersonnel['Id_PERSONNEL']);
                    ?>
                    <tr>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $tel; ?></td>
                        <td><?php echo $tel; ?></td>
                        <td>
                            <a href="index.php?uc=Personnel&action=modificationPersonnel&num=<?php echo $id; ?>">
                                <img src="images/modifier.gif" title="Modifier">
                            </a>
                        </td>
                        <td>
                            <a href="index.php?uc=Personnel&action=supressionPersonnel&num=<?php echo $id; ?>">
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
    <a href="index.php?uc=Personnel&action=creationPersonnelC">créer personnel</a>
    <br><br>
    <?php if (isset($LesPersonnels) && !empty($LesPersonnels)): ?>
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
                foreach ($LesPersonnels as $unPersonnel):
                    $tel = ($unPersonnel['tel']);
                    $id = ($unPersonnel['Id_PERSONNEL']);

                    ?>
                    <tr>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $tel; ?></td>
                        <td><?php echo $tel; ?></td>
                        <td>
                            <a href="index.php?uc=Personnel&action=modificationPersonnel&num=<?php echo $id; ?>">
                                <img src="images/modifier.gif" title="Modifier">
                            </a>
                        </td>
                        <td>
                            <a href="index.php?uc=Personnel&action=supressionPersonnel&num=<?php echo $id; ?>">
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
    <a href="index.php?uc=Personnel&action=creationPersonnelT">créer personnel</a>
    <!-- Formulaire pour créer un nouveau personnel -->
</body>
</html>