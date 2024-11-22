<?php
	$action=$_REQUEST['action'];
	switch($action)
	{
		case 'voirPersonnel':
			{
			$LesPersonnels = $pdo->getlesPersonnels();
			include("vues/v_Personnel.php");
			break;
		}
		case 'creationPersonnel':
		{
			
			include("vues/v_creerPersonnel.php");
			break;
		}
		case 'confirmCreatPersonnel':

			{
			$tel = $_POST['tel'];
			$pdo->creerPersonnel($tel);
			$LesPersonnels = $pdo->getlesPersonnels();
			include("vues/v_Personnel.php");
			break;

			}
		case 'supressionPersonnel':
		{
			$num=$_REQUEST['num'];
			echo $num;
			
			
			break;
		}
		case 'confirmSupprClient':
		{
			$num=$_REQUEST['num'];
			echo "confirmation suppr";
			$pdo->supressionPersonnel($num);
			include("vues/v_SupprPersonnel.php");
			break;
		}
	}
	
?>