<?php
// $action :variable d'aiguillage
$action = $_REQUEST['action'];
switch($action)
{
    case 'seConnecter':
    {
        $identifiant='';
        $mdp='';
        include("vues/v_connexion.php");
        break;
    }

    case 'confirmerConnexion':
    {
        $msgErreurs = getErreursSaisieConnexion($_POST['identifiant'], $_POST['mdp']);
        if ($msgErreurs==null) {
            if ($pdo->connecter($_POST['identifiant'], $_POST['mdp'])){
                echo "Bienvenue ",$_POST['identifiant']," avec le mot de passe : ",$_POST['mdp'];
            }else{
                echo "Erreur de login";
            }
        }else{
			echo "Erreur de login";
		}
        break;
    }
}
?>