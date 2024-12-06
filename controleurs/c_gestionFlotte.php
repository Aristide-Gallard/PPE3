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
    case 'supprimerModele': {
        $idModele = $_REQUEST['id'];
        $modele = $pdo->getModele($idModele);
        include('vues/v_supprModele.php');
        break;
    }
    case 'confirmSupprModele': {
        $idModele = $_POST['id'];
        $pdo->supprModele($idModele);
        $modeles = $pdo->getModeles();
        include('vues/v_modeles.php');
        break;
    }
    case 'creerModele': {
        include('vues/v_creerModele.php');
        break;
    }
    case 'confirmCreerModele': {
        $pdo->creerModele($_POST['libelle'], $_POST['nbSiege'], $_POST['CDB'], $_POST['OPL'], $_POST['CCP'], $_POST['CC'], $_POST['H/S']);
        $modeles = $pdo->getModeles();
        include('vues/v_modeles.php');
        break;
    }

    case 'voirAvions': {
        $avions = $pdo->getAvions();
        include('vues/v_avions.php');
        break;
    }
    case 'modifierAvion': {
        $idAvion = $_REQUEST['id'];
        $avion = $pdo->getAvion($idAvion);
        $modeles = $pdo->getModeles();
        include('vues/v_modifAvion.php');
        break;
    }
    case 'confirmModifAvion': {
        $pdo->modifAvion($_POST['id'], $_POST['code'], $_POST['numSerie'], $_POST['modele']);
        $avions = $pdo->getAvions();
        include('vues/v_avions.php');
        break;
    }
    case 'supprimerAvion': {
        $idAvion = $_REQUEST['id'];
        $avion = $pdo->getAvion($idAvion);
        include('vues/v_supprAvion.php');
        break;
    }
    case 'confirmSupprAvion': {
        $idModele = $_POST['id'];
        $pdo->supprAvion($idModele);
        $avions = $pdo->getAvions();
        include('vues/v_avions.php');
        break;
    }
    case 'creerAvion': {
        $modeles = $pdo->getModeles();
        include('vues/v_creerAvion.php');
        break;
    }
    case 'confirmCreerAvion': {
        echo'creation réussie';
        $pdo->creerAvion($_POST['code'], $_POST['numSerie'], $_POST['modele']);
        $avions = $pdo->getAvions();
        include('vues/v_avions.php');
        break;
    }
}