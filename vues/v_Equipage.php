<?php
    try {
        $bdd= new PDO ('mysql:host=localhost;dbname=mudry', 'root','toor');
    } catch (\Throwable $th) {
        echo ''. $th->getMessage() .'';
    }        

        $requete="SELECT mouvement.Id_MOUVEMENT, personnel.Id_PERSONNEL, equipage.present, role.Id_ROLE FROM equipage INNER JOIN mouvement ON equipage.Id_MOUVEMENT = mouvement.Id_MOUVEMENT INNER JOIN personnel ON equipage.Id_PERSONNEL = personnel.Id_PERSONNEL INNER JOIN role ON equipage.Id_ROLE = role.Id_ROLE;";
        $res = $bdd->query($requete);
    ?>
    <div class="container">
        <div class="row">
            <div class="col-2"><h1>Equipage</h1></div>
            <div class="col-8"></div>
            <div class="col-2"><a class="lien" href="v_ajouterAEquipage.php">ajouter</a></div>
        </div>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">Mouvement</th>
                <th scope="col">Personnel</th>
                <th scope="col">Present</th>
                <th scope="col">Role</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while($ligne = $res->fetch())
        {
        ?>
        <tr>
            <th id="l<?php echo($ligne['Id_MOUVEMENT']) ?>">
            <th><?php echo($ligne['Id_PERSONNEL']) ?></th>
            <th><?php echo($ligne['present']) ?></th>
            <th><?php echo($ligne['Id_ROLE']) ?></th>
            <th><a href="v_modifierAEquipage.php?num=<?php echo($ligne['Id_MOUVEMENT'])?>">Modifier</a></th>
            <th><a href="sup.php?num=<?php echo($ligne['Id_MOUVEMENT'])?>">Supprimer</a></th>
        </tr>
        <?php
        }
        ?>
        </tbody>
    </table>