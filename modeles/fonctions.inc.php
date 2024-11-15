<php

function getErreursSaisieConnexion($identifiant, $mdp){
	$lesErreurs = array();
	if($identifiant=="")
	{
		$lesErreurs[]="Il faut saisir le champ identifiant";
	}
	if($mdp=="")
	{
	$lesErreurs[]="Il faut saisir le champ mdp";
	}

	return $lesErreurs;
}

?>