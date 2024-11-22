<?php
// $action :variable d'aiguillage
$action = $_REQUEST['action'];
switch($action)
{
    case 'voirModeles':
        {
            
            include('vues/v_modeles.php');
            break;
        }
}