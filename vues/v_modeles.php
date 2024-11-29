<div id="modeles">
<a href="index.php?uc=accueil" class="button">Retour</a>
Ceci est l'affichage des modeles
    <a href="index.php?uc=flotte&action=voirModeles">voirModeles</a>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Prenom</th>
                <th scope="col">Adresse</th>
                <th scope="col">Mail</th>
                <th scope="col">Tel fixe</th>
                <th scope="col">Tel portable</th>
                <th scope="col">modifier</th>
                <th scope="col">supprimer</th>
            </tr>
        </thead>
        <tbody>
    <?php
    foreach ($modeles as $modele) {
        ?>
        <tr>
            
        </tr>
    <?php } ?>
    </tbody>
</div>
