<?php
	$action=$_REQUEST['action'];
	switch($action)
	{
		case 'creationPersonnel':
		{
			include("vues/v_creationPersonnel.php");
			break;
		}
		case 'confirmCreatPersonnel':
			{
				try {
					$tel = $_POST['Ttel']; // Récupérer les données du formulaire
					
					if (empty($tel)) {
						throw new Exception('Le numéro de téléphone est obligatoire.');
					}
			
					$pdo->creerPersonnel($tel); // Appeler la méthode pour insérer dans la base de données
			
					// Récupérer tous les personnels après ajout
					$LesPersonnels = $pdo->getLesPersonnels();
					include("vues/v_Personnel.php"); // Afficher la liste des personnels après création
				} catch (Exception $e) {
					// En cas d'erreur, afficher un message d'erreur
					echo "Erreur : " . $e->getMessage();
				}
				break;
			}
			
			
			//soit ce code :
			$LesPersonnels = $pdo->getLesPersonnels();
			include("vues/v_Personnel.php");	
			
			// ou ce code :
			//header('Location: index.php');	
			break;
		}
	
?>