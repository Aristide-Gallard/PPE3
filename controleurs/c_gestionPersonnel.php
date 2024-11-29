<?php
$action = $_REQUEST['action'];
switch ($action) {
	case 'voirPersonnel': {
		$LesPersonnels = $pdo->getlesPersonnels();
		include("vues/v_Personnel.php");
		break;
	}
	case 'creationPersonnelC': {

		include("vues/v_creerPersonnelCommercial.php");
		break;
	}
	case 'confirmCreatPersonnelC': {
		$tel = $_POST['tel'];
		$pdo->creerPersonnelC($tel);
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
	case 'modificationPersonnel': {
		$num = $_REQUEST['num'];
		$LesPersonnels = $pdo->getlePersonnel($num);
		include("vues/v_modificationPersonnel.php");
		break;
	}
	case 'confirmModifPersonnel': {
		$tel = $_POST['tel'];
		$num = $_POST['num']; 
		$pdo->modificationPersonnel($tel, $num); 
		$LesPersonnels = $pdo->getlesPersonnels();
		include("vues/v_Personnel.php");
		break;
	}
	
	case 'supressionPersonnel': {
		$num = $_REQUEST['num'];
		echo $num;
		$LesPersonnels =$pdo->getlePersonnel($num);
		include("vues/v_SupprPersonnel.php");

		break;
	}
	case 'confirmSupprPersonnel': {
		$num = $_REQUEST['num'];
		echo "confirmation suppr";
		$pdo->supressionPersonnelC($num);
		$LesPersonnels = $pdo->getlesPersonnels();
		include("vues/v_Personnel.php");
		break;
	}
}

?>