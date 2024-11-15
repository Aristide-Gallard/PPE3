<?php
// $action :variable d'aiguillage
$action = $_REQUEST['action'];
switch($action)
{
    case 'voirModeles':
        {
            $modeles = $pdo->getModeles();
            include('vues/v_modeles.php');
            break;
        }
}