<?php
$action = $_REQUEST['action'];
switch ($action) {
	case 'voirPersonnel': {
		$LesPersonnelsC = $pdo->getlesPersonnelsC();
		$LesPersonnelsT = $pdo->getlesPersonnelsT();
		include("vues/v_Personnel.php");
		break;
	}
	
	case 'creationPersonnelC': {
		$langues = $pdo->getLangues();
		include("vues/v_creerPersonnelCommercial.php");
		break;
	}
	case 'confirmCreatPersonnelC': {
		$tel = $_POST['tel'];
		if(!empty($_POST['langue'])) {
			$id_LANGUE = $_POST['langue'];
		}
		$idPersonnel = $pdo->creerPersonnelC($tel,$id_LANGUE);
		$LesPersonnels = $pdo->getlesPersonnelsC();
		include("vues/v_Personnel.php");
		break;
	}
	

	
	case 'creationPersonnelT': {

		include("vues/v_creerPersonnelTechnique.php");
		break;
	}
	case 'confirmCreatPersonnelT': {
		$tel = $_POST['tel'];
		$heureV = $_POST['heureV'];
		$pdo->creerPersonnelT($tel, $heureV);
		$LesPersonnels = $pdo->getlesPersonnelsT();
		include("vues/v_Personnel.php");
		break;

	}
	case 'modificationPersonnelC': {
	    $num = $_REQUEST['num'];
    $LesPersonnels = $pdo->getlePersonnelC($num); // Informations sur le personnel
    $languesParlees = $pdo->getLanguesParPersonnel($num); // Langues associées à ce personnel
    $toutesLangues = $pdo->getToutesLesLangues(); // Toutes les langues disponibles

    include("vues/v_modificationPersonnelCom.php");
    break;
}
	case 'confirmModifPersonnelC': {
		
			$num = $_POST['num']; // ID du personnel
			$tel = $_POST['tel']; // Numéro de téléphone
			$langues = isset($_POST['langue']) ? $_POST['langue'] : []; // Langues sélectionnées
			// Rediriger vers la liste des personnels
			$LesPersonnels = $pdo->getlesPersonnelsC();
			include("vues/v_Personnel.php");
			break;
		}

	case 'modificationPersonnelT': {
		$num = $_REQUEST['num'];
		$LesPersonnels = $pdo->getlePersonnel($num);
		include("vues/v_modificationPersonnelTec.php");
		break;
	}
	case 'confirmModifPersonnelT': {
		$tel = $_POST['tel'];
		$num = $_POST['num']; 
		$heureV = $_REQUEST['heureV'];
		$pdo->modificationPersonnelT($tel, $num, $heureV); 
		$LesPersonnelsC = $pdo->getlesPersonnelsC();
		$LesPersonnelsT = $pdo->getlesPersonnelsT();
		include("vues/v_Personnel.php");
		break;
	}
	
	case 'supressionPersonnelC': {
		$num = $_REQUEST['num'];
		$typeP = "C";
		echo $num;
		$LesPersonnels =$pdo->getlePersonnel($num);
		include("vues/v_SupprPersonnel.php");
		break;
	}
	case 'confirmSupprPersonnelC': {
		$num = $_REQUEST['num'];
		echo "confirmation suppr";
		$pdo->supressionPersonnelC($num);
		$LesPersonnelsC = $pdo->getlesPersonnelsC();
		$LesPersonnelsT = $pdo->getlesPersonnelsT();
		include("vues/v_Personnel.php");
		break;
	}

	case 'supressionPersonnelT': {
		$num = $_REQUEST['num'];
		echo $num;
		$typeP = "T";
		$LesPersonnels =$pdo->getlePersonnel($num);
		include("vues/v_SupprPersonnel.php");

		break;
	}
	case 'confirmSupprPersonnelT': {
		$num = $_REQUEST['num'];
		echo "confirmation suppr";
		$pdo->supressionPersonnelT($num);
		$LesPersonnelsC = $pdo->getlesPersonnelsC();
		$LesPersonnelsT = $pdo->getlesPersonnelsT();
		include("vues/v_Personnel.php");
		break;
	}

	// Fichier : controleurs/c_gestionPersonnel.php

case 'ajouterLangue': {
    $num = $_POST['num'];  // ID du personnel
    $langues = $_POST['langues'];  // Tableau des langues sélectionnées

    // Vérification si des langues ont été sélectionnées
    if (!empty($langues)) {
        // Appel de la méthode pour ajouter les langues
        foreach ($langues as $langue) {
            $pdo->ajouterLangueAuPersonnel($num, $langue);  // Ajouter la langue à ce personnel
        }
    }

    // Rediriger vers la vue pour afficher la liste mise à jour des personnels
    $LesPersonnels = $pdo->getlesPersonnelsC();
    include("vues/v_Personnel.php");
    break;
}

}

?>