<?php
	$action=$_REQUEST['action'];
	switch($action)
	{
		case 'creationPersonnel':
		{
			include("vues/v_creationPersonnel.php");
			break;
		}
		case 'confirmCreatCLient':
		{
			
			$tel = $_POST['Ttel'];
			$pdo->creerPersonnel($tel);
			
			//soit ce code :
			$lesClients = $pdo->getLesPersonnels();
			include("vues/v_personnel.php");	
			
			// ou ce code :
			//header('Location: index.php');	
			break;
		}
	}
?>