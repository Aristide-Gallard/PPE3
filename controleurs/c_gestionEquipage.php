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
        $idM = $_REQUEST['idM'];
        $idP = $_REQUEST['idP'];
        $personnel = $pdo->getPersEqu($idM, $idP);
        $LesRoles = $pdo->getRoles();
        include("vues/v_modifierAEquipage.php");
        break;
    }
    case 'confirmerModifEquipage':
    {
        $confirmerModif = $pdo->modifEquipage($_POST['mouvement'], $_POST['personnel'], $_POST['present'], $_POST['role']);
        $LesEquipages = $pdo->getEquipages();
        include("vues/v_Equipage.php");
        break;
    }
    case 'supprimerAEquipage':
    {
        $idM = $_REQUEST['idM'];
        $idP = $_REQUEST['idP'];
        $idPr = $_REQUEST['idPr'];
        $idR = $_REQUEST['idR'];
        include("vues/v_supprimerAEquipage.php");
        break;
    }
    case 'confirmerSuppEquipage':
    {
        $confirmerSupp = $pdo->SuppEquipage($_POST['mouvement'], $_POST['personnel'], $_POST['present'], $_POST['role']);
        $LesEquipages = $pdo->getEquipages();
        include("vues/v_Equipage.php");
        break;
    }
}
?>