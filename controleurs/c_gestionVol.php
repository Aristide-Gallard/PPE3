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

            include('vues/v_ajouterMouvement.php');
            break;
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