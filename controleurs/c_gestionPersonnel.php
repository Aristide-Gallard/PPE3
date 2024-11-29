<?php
$action = $_REQUEST['action'];
switch ($action) {
	case 'voirPersonnel': {
		$LesPersonnels = $pdo->getlesPersonnels();
		include("vues/v_Personnel.php");
		break;
	}
	case 'creationPersonnel': {

		include("vues/v_creerPersonnelCommercial.php");
		break;
	}
	case 'confirmCreatPersonnel': {
		$tel = $_POST['tel'];
		$pdo->creerPersonnel($tel);
		$LesPersonnels = $pdo->getlesPersonnels();
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
		$pdo->supressionPersonnel($num);
		$LesPersonnels = $pdo->getlesPersonnels();
		include("vues/v_Personnel.php");
		break;
	}
}

?>