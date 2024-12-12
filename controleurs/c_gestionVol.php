<?php
// $action :variable d'aiguillage
$action = $_REQUEST['action'];
switch($action)
{

    case 'gererMouvement':
        {
        $mouvements = $pdo->getMouvements();
        include('vues/v_gestionMouvement.php');
        break;
        }


    case 'ajouterMouvement':
        {
        $numero ='';
        $nbPlaces ='';
        $distance ='';
        $duree = '';
        $heureD = '';
        $heureA = '';
        $lesAeroports = $pdo->getAeroports();
        $lesAvions = $pdo->getAvions();
        include('vues/v_ajoutMouvement.php');
        break;
        }


    case 'confirmAjouterMouvement': 
        {
            $numV = $_POST['numV'];
            $nbPlace = $_POST['nbPlace'];
            $distance = $_POST['distance'];
            $heureD = $_POST['heureD'];
            $duree = $_POST['duree'];
            $heureA = $_POST['heureA'];
            $Id_AEROPORT = $_POST['Id_AEROPORT'];
            $Id_AEROPORT_1 = $_POST['Id_AEROPORT_1'];
            $Id_AVION = $_POST['Id_AVION'];
                
            // Vérifie les horaires
            if (strtotime($heureD) >= strtotime($heureA)) {
                echo "Erreur : L'heure de départ doit être antérieure à l'heure d'arrivée.";
                echo '</br><a href="index.php?uc=vol&action=gererMouvement">Retour</a>';
                break;
            }
        
            // Vérifie que la durée est correcte
            $heureD_minutes = strtotime($heureD) / 60;
            $heureA_minutes = strtotime($heureA) / 60;
            $difference = $heureA_minutes - $heureD_minutes;           
            if ($difference != $duree) {
                echo "Erreur : La durée ne correspond pas.";
                echo '</br><a href="index.php?uc=vol&action=gererMouvement">Retour</a>';
                break;
            }
        
            // Vérifie que les aéroports sont différents
            if ($Id_AEROPORT == $Id_AEROPORT_1) {
                echo "Erreur : Les aéroports sont identiques.";
                echo '</br><a href="index.php?uc=vol&action=gererMouvement">Retour</a>';
                break;
            }
        
            // Vérifie que la distance, la durée et le nombre de places sont positifs
            if ($distance <= 0 || $duree <= 0 || $nbPlace <= 0) {
                echo "Erreur : La distance, la durée et le nombre de places doivent être des valeurs positives.";
                echo '</br><a href="index.php?uc=vol&action=gererMouvement">Retour</a>';
                break;
            }
        
            // Vérifie que la distance soit raisonnable
            if ($distance < 100) {
                echo "Erreur : La distance est trop courte.";
                echo '</br><a href="index.php?uc=vol&action=gererMouvement">Retour</a>';
                break;
            }

            // Vérifie que la distance soit raisonnable
            if ($distance > 20000) {
                echo "Erreur : La distance est trop longue.";
                echo '</br><a href="index.php?uc=vol&action=gererMouvement">Retour</a>';
                break;
            }
        
            // Ajout du mouvement
            $result = $pdo->ajoutMouvement($nbPlace, $numV, $distance, $heureD, $duree, $heureA, $Id_AEROPORT, $Id_AEROPORT_1, $Id_AVION);            
            if ($result) {
                include("vues/v_confirmAjouterMouvement.php");
            } else {
                echo '</br><a href="index.php?uc=vol&action=gererMouvement">Retour</a>';
            }
            break;
        }
            
            
     case 'modifierMouvement': 
        {
        $Id_MOUVEMENT = $_REQUEST['id'];
        $mouvement = $pdo->getMouvement($Id_MOUVEMENT);
        $lesAeroports = $pdo->getAeroports();
        $lesAvions = $pdo->getAvions();
        $mouvements = $pdo->getMouvements();
        include('vues/v_modificationMouvement.php');
        break;
        }


    case 'confirmModifierMouvement': 
        {
            $Id_MOUVEMENT = $_POST['Id_MOUVEMENT'];
            $numV = $_POST['numV'];
            $nbPlace = $_POST['nbPlace'];
            $distance = $_POST['distance'];
            $heureD = $_POST['heureD'];
            $duree = $_POST['duree'];
            $heureA = $_POST['heureA'];
            $Id_AEROPORT = $_POST['Id_AEROPORT'];
            $Id_AEROPORT_1 = $_POST['Id_AEROPORT_1'];
            $Id_AVION = $_POST['Id_AVION'];

            // Vérifie les horaires
            if (strtotime($heureD) >= strtotime($heureA)) {
                echo "Erreur : L'heure de départ doit être antérieure à l'heure d'arrivée.";
                echo '</br><a href="index.php?uc=vol&action=gererMouvement">Retour</a>';
                return false;
            }

            // Vérifie que la durée est correcte
            $heureD_minutes = strtotime($heureD) / 60;
            $heureA_minutes = strtotime($heureA) / 60;
            $difference = $heureA_minutes - $heureD_minutes;           
            if ($difference != $duree) {
                echo "Erreur : La durée ne correspond pas.";
                echo '</br><a href="index.php?uc=vol&action=gererMouvement">Retour</a>';
                return false;
            }

            // Vérifie que les aéroports sont différents
            if ($Id_AEROPORT == $Id_AEROPORT_1) {
                echo "Erreur : Les aéroports sont identiques.";
                echo '</br><a href="index.php?uc=vol&action=gererMouvement">Retour</a>';
                return false;
            }

            // Vérifie que la distance, la durée et le nombre de places sont positifs
            if ($distance <= 0 || $duree <= 0 || $nbPlace <= 0) {
                echo "Erreur : La distance, la durée et le nombre de places doivent être des valeurs positives.";
                echo '</br><a href="index.php?uc=vol&action=gererMouvement">Retour</a>';
                return false;
            }

            // Vérifie que la distance soit raisonnable
            if ($distance < 100) {
                echo "Erreur : La distance est trop courte.";
                echo '</br><a href="index.php?uc=vol&action=gererMouvement">Retour</a>';
                return false;
            }

            if ($distance > 20000) {
                echo "Erreur : La distance est trop longue.";
                echo '</br><a href="index.php?uc=vol&action=gererMouvement">Retour</a>';
                return false;
            }

            // Vérifie que le nombre de places ne dépasse pas le nombre de sièges du modèle
            $nbSiege = PdoMudry::getNbSiegeModele($Id_AVION);
            if ($nbPlace > $nbSiege) {
                echo "Erreur : Le nombre de places ne peut pas dépasser le nombre de sièges du modèle (max : $nbSiege sièges).";
                echo '</br><a href="index.php?uc=vol&action=gererMouvement">Retour</a>';
                return false;
            }

            // Modification du mouvement
            $mouvements = $pdo->getMouvements();
            $result = $pdo->modifMouvement($Id_MOUVEMENT, $nbPlace, $numV, $distance, $heureD, $duree, $heureA, $Id_AEROPORT, $Id_AEROPORT_1, $Id_AVION);
            if ($result) {
                echo "Mouvement modifié avec succès.";
                echo '</br><a href="index.php?uc=vol&action=gererMouvement">Retour</a>';
            } else {
                echo '</br><a href="index.php?uc=vol&action=gererMouvement">Retour</a>';
            }
            break;
        }


    case 'supprimerMouvement': 
        {
        $Id_MOUVEMENT = $_REQUEST['id'];
        $mouvement = $pdo->getMouvement($Id_MOUVEMENT);
        $lesAvions = $pdo->getAvions();
        include('vues/v_supprMouvement.php');
        break;
        }


    case 'confirmSupprMouvement': 
        {
        $Id_MOUVEMENT = $_POST['id'];
        $pdo->supprimerMouvement($Id_MOUVEMENT);
        $mouvements = $pdo->getMouvements();
        include('vues/v_gestionMouvement.php');
        break;
        } 


    case 'gererAeroport':
        {
        $aeroports = $pdo->getAeroports();
        include('vues/v_gestionAeroport.php');
        break;
        }


    case 'ajouterAeroport':
        {
            $aita ='';
            $nom ='';
            $latitude ='';
            $longitude = '';
            include('vues/v_ajoutAeroport.php');
            break;
        }


    case 'confirmAjouterAeroport':
        {
            $aita = $_POST['aita'];
            $nom = $_POST['nom'];
            $latitude = $_POST['latitude'];
            $longitude = $_POST['longitude'];

            if ($latitude > 90 || $latitude < -90) {
                echo "Erreur : La latitude doit être comprise entre -90 et 90.";
                echo '</br><a href="index.php?uc=vol&action=gererAeroport">Retour</a>';
                return false;
            }

            if ($longitude > 180 || $longitude < -180) {
                echo "Erreur : La longitude doit être comprise entre -180 et 180";
                echo '</br><a href="index.php?uc=vol&action=gererAeroport">Retour</a>';
                return false;
            }

            $result = $pdo->ajoutAeroport($aita, $nom, $latitude, $longitude);
            if ($result) {
                include("vues/v_confirmAjoutAeroport.php");
            } else {
                echo '</br><a href="index.php?uc=vol&action=gererAeroport">Retour</a>';
            }
            break;
        }


    case 'modifierAeroport':
        {
            $Id_AEROPORT = $_REQUEST['id'];
            $aeroport = $pdo->getAeroport($Id_AEROPORT);
            $lesAeroports = $pdo->getAeroports();
            include('vues/v_modificationAeroport.php');
            break;
        }


    case 'confirmModifierAeroport':
        {
            $Id_AEROPORT = $_POST['id'];
            $aita = $_POST['aita'];
            $nom = $_POST['nom'];
            $latitude = $_POST['latitude'];
            $longitude = $_POST['longitude'];

            if ($latitude > 90 || $latitude < -90) {
                echo "Erreur : La latitude doit être comprise entre -90 et 90";
                echo '</br><a href="index.php?uc=vol&action=gererAeroport">Retour</a>';
                return false;
            }

            if ($longitude > 180 || $longitude < -180) {
                echo "Erreur : La longitude doit être comprise entre -180 et 180";
                echo '</br><a href="index.php?uc=vol&action=gererAeroport">Retour</a>';
                return false;
            }

            $lesAeroports = $pdo->getAeroports();
            $result = $pdo->modifAeroport($Id_AEROPORT, $aita, $nom, $latitude, $longitude);
            if ($result) {
                echo "Aéroport modifié avec succès.";
                echo '</br><a href="index.php?uc=vol&action=gererAeroport">Retour</a>';
            } else {
                echo '</br><a href="index.php?uc=vol&action=gererAeroport">Retour</a>';
            }
            break;
        }


    case 'supprimerAeroport':
        {
            $Id_AEROPORT = $_REQUEST['id'];
            $aeroport = $pdo->getAeroport($Id_AEROPORT);
            include('vues/v_supprAeroport.php');
            break;
        }

        
    case 'confirmSupprAeroport':
        {
            $Id_AEROPORT = $_POST['id'];
            $pdo->supprMouvementAeroport($Id_AEROPORT);
            $result = $pdo->supprAeroport($Id_AEROPORT);
            $aeroports = $pdo->getAeroports();
            include('vues/v_gestionAeroport.php');
            break;
        }

                                                                                                        
}