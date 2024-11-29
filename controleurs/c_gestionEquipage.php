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
        $mouvement='';
        $personnel='';
        $present='';
        $role='';
        //if (isset($LesEquipages) && !empty($LesEquipages))
        //{
            $LesEquipages = $pdo->getEquipages();
            include("vues/v_Equipage.php");
        //}
        //else {
        //    echo "Merci de vous connecter";
        //}
        break;
    }

    case 'ajouterAEquipage':
    {
        $present='';
        $LesMouvements = $pdo->getMouvements();
        $LesRoles = $pdo->getRoles();
        $LesPersonnels = $pdo->getPersonnels();
        include("vues/v_ajouterAEquipage.php");
        break;
    }
    case 'confirmerAjoutEquipage':
    {
        $confirmerAjout = $pdo->ajoutEquipage($_POST['mouvement'], $_POST['personnel'], $_POST['present'], $_POST['role']);
        $LesEquipages = $pdo->getEquipages();
        include("vues/v_Equipage.php");
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