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
            $result = $pdo->ajoutMouvement($_POST['nbPlaces'], $_POST['numV'], $_POST['distance'], $_POST['heureD'], $_POST['duree'], $_POST['heureA'], $_POST['Id_AEROPORT'], $_POST['Id_AEROPORT_1'], $_POST['Id_AVION']);
    
            if ($result) {
                echo "Mouvement ajouté avec succès.";
            } else {
                echo "Erreur lors de l'ajout du mouvement.";
            }
           include("vues/v_gestionMouvement.php");
        }

    case 'modifierMouvement':
        {

            include('vues/v_modificationMouvement.php');
            break;
        }


    case 'supprimerMouvement':
        {

            include('vues/v_suppressionMouvement.php');
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