<?php
// $action :variable d'aiguillage
$action = $_REQUEST['action'];
switch ($action) {
    case 'voirModeles': {
        $modeles = $pdo->getModeles();
        include('vues/v_modeles.php');
        break;
    }
    case 'modifierModele': {
        $idModele = $_REQUEST['id'];
        $modele = $pdo->getModele($idModele);
        include('vues/v_modifModele.php');
        break;
    }
    case 'confirmModifModele': {
        $pdo->modifModele($_POST['id'], $_POST['libelle'], $_POST['nbSiege'], $_POST['CDB'], $_POST['OPL'], $_POST['CCP'], $_POST['CC'], $_POST['H/S']);
        $modeles = $pdo->getModeles();
        include('vues/v_modeles.php');
        break;
    }
}