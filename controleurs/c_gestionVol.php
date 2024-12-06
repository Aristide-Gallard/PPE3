<?php
// $action :variable d'aiguillage
$action = $_REQUEST['action'];
switch($action)
{

    case 'gererMouvement':
        {
        $mouvements = $pdo->getMouvements();
        include('vues/v_gestionMouvement.php');
        break;
        }


    case 'ajouterMouvement':
        {
        $numero ='';
        $nbPlaces ='';
        $distance ='';
        $duree = '';
        $heureD = '';
        $heureA = '';
        $lesAeroports = $pdo->getAeroports();
        $lesAeroports = $pdo->getAeroports();
        $lesAvions = $pdo->getAvions();
        include('vues/v_ajoutMouvement.php');
        break;
        }


    case 'confirmAjouterMouvement':
        {
        $mouvements = $pdo->getMouvements();

        $result = $pdo->ajoutMouvement($_POST['numV'], $_POST['nbPlace'], $_POST['distance'], $_POST['heureD'], $_POST['duree'], $_POST['heureA'], $_POST['Id_AEROPORT'], $_POST['Id_AEROPORT_1'], $_POST['Id_AVION']);

        if ($result==null) {
            include("vues/v_confirmAjouterMouvement.php");
        } else {
            echo "Erreur lors de l'ajout du mouvement.";
        }
        break;
        }


     case 'modifierMouvement': 
        {
        $idMouvement = $_REQUEST['idM'];
        $mouvement = $pdo->getMouvement($idMouvement);
        include('vues/v_modifMouvement.php');
        break;
        }


    case 'confirmModifMouvement': 
        {
        $result = $pdo->modifierMouvement($_POST['numV'], $_POST['nbPlace'], $_POST['distance'], $_POST['heureD'], $_POST['duree'], $_POST['heureA'], $_POST['Id_AEROPORT'], $_POST['Id_AEROPORT_1'], $_POST['Id_AVION']);
        if ($result==null) {
            echo "Mouvement modifié avec succès.";
        } else {
            echo "Erreur lors de la modification du mouvement.";
        }

        $mouvements = $pdo->getMouvements();
        include("vues/v_gestionMouvement.php");
        break;
        }


    case 'supprimerMouvement': 
        {
        $idMouvement = $_REQUEST['idM'];
        $mouvement = $pdo->getMouvement($idMouvement);
        include('vues/v_supprMouvement.php');
        break;
        }


    case 'confirmSupprMouvement': 
        {
        $idMouvement = $_POST['idM'];
        $pdo->supprimerMouvement($idMouvement);
        $mouvements = $pdo->getMouvements();
        include('vues/v_gestionMouvement.php');
        break;
        } 


    case 'gererAeroport':
        {
        $aeroports = $pdo->getAeroports();
        include('vues/v_gestionAeroport.php');
        break;
        }


    case 'ajouterAeroport':
        {

            include('vues/v_ajoutAeroport.php');
            break;
        }


    case 'modifierAeroport':
        {

            include('vues/v_modificationAeroport.php');
            break;
        }


    case 'supprimerAeroport':
        {

            include('vues/v_suppressionAeroport.php');
            break;
        }
                                                                                                                          
}