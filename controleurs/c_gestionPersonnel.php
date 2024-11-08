<?php
	$action=$_REQUEST['action'];
	switch($action)
	{
		case 'CreerPersonnel':
		{
			include("vues/v_Personnel.php");
			break;
		}
		case 'confirmCreatPersonnel':
		{
			$id_Personnel = $unPersonnel['id_PERSONNEL'];
            $tel = $unPersonnel['tel'];
            $pdo->creerPersonnel($id_Personnel,$tel);
			
			//soit ce code :
			$lesClients = $pdo->getLesPersonnels();
			include("vues/v_???.php");	
			
			// ou ce code :
			//header('Location: index.php');	
			break;
		}
	}
?>