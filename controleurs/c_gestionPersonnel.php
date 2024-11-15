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
			$tel = $_REQUEST['tel'];
			$pdo->creerPersonnel($tel);
			}

	}
	
?>