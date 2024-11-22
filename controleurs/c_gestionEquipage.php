<?php
// $action :variable d'aiguillage
$action = $_REQUEST['action'];
//if (unset($_SESSION['id'])){
//    echo 'Vous devez etre connecte pour continuer';
//}
switch($action)
{
    case 'voirEquipage':
    {
        include("vues/v_Equipage.php");
        break;
    }

    case 'ajouterAEquipage':
    {
        break;
    }
    case 'modifierAEquipage':
    {
        break;
    }
    case 'supprimerAEquipage':
    {
        break;
    }
    case 'modifierPresence':
    {
        break;
    }
}
?>