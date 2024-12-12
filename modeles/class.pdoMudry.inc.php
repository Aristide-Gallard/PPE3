<?php

/** 
 * Classe d'accès aux données. 
 
 * Utilise les services de la classe PDO
 * pour l'application JardiPlants
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoGsb qui contiendra l'unique instance de la classe
 *
*/

class PdoMudry
{
	private static $serveur = "mysql:host=localhost";
	private static $bdd = "dbname=mudry";
	private static $user = 'root';
	private static $mdp = 'toor';
	private static $monPdo;
	private static $monPdoMudry = null;

	/**
	 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
	 * pour toutes les méthodes de la classe
	 */
	private function __construct()
	{
		if ($_SERVER['SERVER_NAME'] == 'localhost') {
			PdoMudry::$monPdo = new PDO(PdoMudry::$serveur . ';' . PdoMudry::$bdd, PdoMudry::$user, PdoMudry::$mdp);
		} else {
			PdoMudry::$monPdo = new PDO('mysql:host=db672809001.db.1and1.com;dbname=db672809001', 'dbo672809001', '$siQU3N9Lp2SiJKRX^');
		}

		PdoMudry::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct()
	{
		PdoMudry::$monPdo = null;
	}

	/**
	 * Fonction statique qui crée l'unique instance de la classe
	 *
	 * Appel : $instancePdoJardiPlants = PdoJardiPlants::getPdoJardiPlants();
	 * @return// l'unique objet de la classe PdoJardiPlants
	 */
	public static function getPdoMudry()
	{
		if (PdoMudry::$monPdoMudry == null) {
			PdoMudry::$monPdoMudry = new PdoMudry();
		}
		return PdoMudry::$monPdoMudry;
	}

	
/**
 * Retourne tous les mouvements sous forme d'un tableau associatif
 *  Avec les noms des aéroports différenciés et le code de l'avion
 * @return// le tableau associatif des mouvements 
*/
public static function getMouvements()
{
    $req = "SELECT mouvement.Id_MOUVEMENT, mouvement.nbPlace, mouvement.numV, mouvement.distance, mouvement.heureD, mouvement.duree, mouvement.heureA, 
                   mouvement.Id_AEROPORT, mouvement.Id_AEROPORT_1, mouvement.Id_AVION, avion.code, 
                   aeroport_depart.nom as aeroportD, aeroport_arrivee.nom as aeroportA
            from mouvement 
            INNER JOIN aeroport as aeroport_depart ON mouvement.Id_AEROPORT = aeroport_depart.Id_AEROPORT
            INNER JOIN aeroport as aeroport_arrivee ON mouvement.Id_AEROPORT_1 = aeroport_arrivee.Id_AEROPORT
            INNER JOIN avion ON mouvement.Id_AVION = avion.Id_AVION";
    
    $res = PdoMudry::$monPdo->query($req);
    return $res->fetchAll();
}


/**
 * Retourne le mouvement sous forme d'un tableau associatif
 *
 * @return// le mouvement choisie selon id
 */
public static function getMouvement($id)
{
	$req = "SELECT mouvement.Id_MOUVEMENT, mouvement.nbPlace, mouvement.numV, mouvement.distance, mouvement.heureD, mouvement.duree, mouvement.heureA, mouvement.Id_AEROPORT, mouvement.Id_AEROPORT_1, mouvement.Id_AVION, avion.code from mouvement 
	INNER JOIN aeroport ON mouvement.Id_AEROPORT = aeroport.Id_AEROPORT
	INNER JOIN avion ON mouvement.Id_AVION = avion.Id_AVION
	where mouvement.Id_MOUVEMENT = :mouvement";
	$res = PdoMudry::$monPdo->prepare($req);
	$res->bindValue("mouvement", $id);
	$res->execute();
	return $res->fetch();
}

/**
 * Retourne tous les aéroports sous forme d'un tableau associatif
 *
 * @return// le tableau associatif des aéroports 
*/
public static function getAeroports(){
	$req = "SELECT aeroport.Id_AEROPORT, aeroport.aita, aeroport.nom, aeroport.latitude, aeroport.longitude from aeroport";

	$res = PdoMudry::$monPdo->query($req);
	return $res->fetchAll();
}

	/**
	 * Retourne l'avion sous forme d'un tableau associatif
	 *
	 * @return// l'aeroport choisie selon id
	 */
public function getAeroport($id) {
    $req = "SELECT * from aeroport where aeroport.Id_AEROPORT = :aeroport";
	$res = PdoMudry::$monPdo->prepare($req);
    $res->bindValue('aeroport', $id);
    $res->execute();
    return $res->fetch();
}

	/**
	 * Retourne tous les modeles sous forme d'un tableau associatif
	 *
	 * @return// le tableau associatif des avions 
	 */
	public static function getModeles()
	{
		$req = "SELECT Id_MODELE, libelle, nbSiege, (SELECT nombre from associe where associe.Id_MODELE = rp.Id_MODELE and associe.Id_ROLE=1) as CDB,
(SELECT nombre from associe where associe.Id_MODELE = rp.Id_MODELE and associe.Id_ROLE=2) as OPL,
(SELECT nombre from associe where associe.Id_MODELE = rp.Id_MODELE and associe.Id_ROLE=3) as CCP,
(SELECT nombre from associe where associe.Id_MODELE = rp.Id_MODELE and associe.Id_ROLE=4) as CC,
(SELECT nombre from associe where associe.Id_MODELE = rp.Id_MODELE and associe.Id_ROLE=5) as 'H/S'
from modele rp";
		$res = PdoMudry::$monPdo->query($req);
		return $res->fetchAll();
	}

	/**
	 * Retourne tous le modele sous forme d'un tableau associatif
	 *
	 * @return// le tableau associatif des avions 
	 */
	public static function getModele($id)
	{
		$req = "SELECT Id_MODELE, libelle, nbSiege, (SELECT nombre from associe where associe.Id_MODELE = rp.Id_MODELE and associe.Id_ROLE=1) as CDB,
(SELECT nombre from associe where associe.Id_MODELE = rp.Id_MODELE and associe.Id_ROLE=2) as OPL,
(SELECT nombre from associe where associe.Id_MODELE = rp.Id_MODELE and associe.Id_ROLE=3) as CCP,
(SELECT nombre from associe where associe.Id_MODELE = rp.Id_MODELE and associe.Id_ROLE=4) as CC,
(SELECT nombre from associe where associe.Id_MODELE = rp.Id_MODELE and associe.Id_ROLE=5) as 'H/S'
from modele rp where rp.id_MODELE = :id_modele";
		$res = PdoMudry::$monPdo->prepare($req);
		$res->bindValue("id_modele", $id);
		$res->execute();
		return $res->fetch();
	}


	/**
	 * modifie les valeurs associées à un modele
	 *
	 */
	public static function modifModele($id, $libelle, $nbSiege, $CDB, $OPL, $CCP, $CC, $HS)
	{
		$req = "UPDATE modele SET libelle = :libelle, nbSiege = :nbSiege where Id_MODELE = :ID_MODELE";
		$res = PdoMudry::$monPdo->prepare($req);
		$res->bindValue("ID_MODELE", $id);
		$res->bindValue("libelle", $libelle);
		$res->bindValue("nbSiege", $nbSiege);
		$res->execute();
		$req = "UPDATE associe SET nombre = :nombre where Id_ROLE= :Id_ROLE and Id_MODELE = :Id_MODELE";
		$res = PdoMudry::$monPdo->prepare($req);
		$res->bindValue("nombre", $CDB);
		$res->bindValue("Id_ROLE", 1);
		$res->bindValue("Id_MODELE", $id);
		$res->execute();
		$res = PdoMudry::$monPdo->prepare($req);
		$res->bindValue("nombre", $OPL);
		$res->bindValue("Id_ROLE", 2);
		$res->bindValue("Id_MODELE", $id);
		$res->execute();
		$res = PdoMudry::$monPdo->prepare($req);
		$res->bindValue("nombre", $CCP);
		$res->bindValue("Id_ROLE", 3);
		$res->bindValue("Id_MODELE", $id);
		$res->execute();
		$res = PdoMudry::$monPdo->prepare($req);
		$res->bindValue("nombre", $CC);
		$res->bindValue("Id_ROLE", 4);
		$res->bindValue("Id_MODELE", $id);
		$res->execute();
		$res = PdoMudry::$monPdo->prepare($req);
		$res->bindValue("nombre", $HS);
		$res->bindValue("Id_ROLE", 5);
		$res->bindValue("Id_MODELE", $id);
		$res->execute();

	}

	/**
	 * ajoute un modele
	 *
	 */
	public static function creerModele($libelle, $nbSiege, $CDB, $OPL, $CCP, $CC, $HS)
	{
		$req = "INSERT INTO modele(libelle, nbSiege) VALUES(:libelle, :nbSiege)";
		$res = PdoMudry::$monPdo->prepare($req);
		$res->bindValue("libelle", $libelle);
		$res->bindValue("nbSiege", $nbSiege);
		$res->execute();
		$req = "SELECT Id_MODELE from modele where libelle = :libelle and nbSiege = :nbSiege orDER BY Id_MODELE DESC LIMIT 1";
		$res = PdoMudry::$monPdo->prepare($req);
		$res->bindValue("libelle", $libelle);
		$res->bindValue("nbSiege", $nbSiege);
		$res->execute();
		$rep = $res->fetch();
		$id = $rep['Id_MODELE'];
		$req = "INSERT INTO associe(Id_MODELE, Id_ROLE, nombre) VALUES(:Id_MODELE,:Id_ROLE, :nombre)";
		$res = PdoMudry::$monPdo->prepare($req);
		$res->bindValue("nombre", $CDB);
		$res->bindValue("Id_ROLE", 1);
		$res->bindValue("Id_MODELE", $id);
		$res->execute();
		$res = PdoMudry::$monPdo->prepare($req);
		$res->bindValue("nombre", $OPL);
		$res->bindValue("Id_ROLE", 2);
		$res->bindValue("Id_MODELE", $id);
		$res->execute();
		$res = PdoMudry::$monPdo->prepare($req);
		$res->bindValue("nombre", $CCP);
		$res->bindValue("Id_ROLE", 3);
		$res->bindValue("Id_MODELE", $id);
		$res->execute();
		$res = PdoMudry::$monPdo->prepare($req);
		$res->bindValue("nombre", $CC);
		$res->bindValue("Id_ROLE", 4);
		$res->bindValue("Id_MODELE", $id);
		$res->execute();
		$res = PdoMudry::$monPdo->prepare($req);
		$res->bindValue("nombre", $HS);
		$res->bindValue("Id_ROLE", 5);
		$res->bindValue("Id_MODELE", $id);
		$res->execute();

	}

	/**
	 * supprime un modele
	 *
	 */
	public static function supprModele($id)
	{
		$req = "DELETE from modele where Id_MODELE = :ID_MODELE";
		$res = PdoMudry::$monPdo->prepare($req);
		$res->bindValue("ID_MODELE", $id);
		try {
			$res->execute();
		} catch (Exception $e) {
			echo "merci de d'abord supprimer les avions correspondants à ce modele";
		}
	}

	/**
	 * modifie les valeurs associées à un mouvement
	 *
	 */
	public static function modifierMouvement($id, $nbPlace, $numV, $distance, $heureD, $duree, $heureA, $Id_AEROPORT, $Id_AEROPORT_1, $Id_AVION)
	{
		$req = "UPDATE mouvement SET nbPlace = :nbPlace, numV = :numV, distance = :distance, heureD=:heureD, duree=:duree, heureA=:heureA, Id_AEROPORT=:Id_AEROPORT, Id_AEROPORT_1=:Id_AEROPORT_1, Id_AVION=:Id_AVION where Id_MOUVEMENT = :Id_MOUVEMENT";
		$res = PdoMudry::$monPdo->prepare($req);
		$res->bindValue("Id_MOUVEMENT", $id);
		$res->bindValue("nbPlace", $nbPlace);
		$res->bindValue("numV", $numV);
		$res->bindValue("distance", $distance);
		$res->bindValue("heureD", $heureD);
		$res->bindValue("duree", $duree);
		$res->bindValue("heureA", $heureA);
		$res->bindValue("Id_AEROPORT", $Id_AEROPORT);
		$res->bindValue("Id_AEROPORT_1", $Id_AEROPORT_1);
		$res->bindValue("Id_AVION", $Id_AVION);
		$success = $res->execute();
		return $success;
	}

	/**
	 * Retourne tous les avions sous forme d'un tableau associatif
	 *
	 * @return// le tableau associatif des avions 
	 */
	public static function getAvions()
	{
		$req = "SELECT avion.Id_AVION, avion.code, avion.numSerie, modele.Id_MODELE, modele.libelle from avion 
INNER JOIN modele ON avion.Id_MODELE = modele.Id_MODELE";
		$res = PdoMudry::$monPdo->query($req);
		return $res->fetchAll();
	}

	/**
	 * Retourne l'avion sous forme d'un tableau associatif
	 *
	 * @return// l'avion choisie selon id
	 */
	public static function getAvion($id)
	{
		$req = "SELECT avion.Id_AVION, avion.code, avion.numSerie, modele.Id_MODELE, modele.libelle from avion 
INNER JOIN modele ON avion.Id_MODELE = modele.Id_MODELE where avion.Id_AVION = :avion";
		$res = PdoMudry::$monPdo->prepare($req);
		$res->bindValue("avion", $id);
		$res->execute();
		return $res->fetch();
	}

	/**
	 * modifie les valeurs associées à un avion
	 *
	 */
	public static function modifAvion($id, $code, $numSerie, $modele)
	{
		$req = "UPDATE avion SET code = :code, numSerie = :numSerie, Id_MODELE = :ID_MODELE where Id_AVION = :Id_AVION";
		$res = PdoMudry::$monPdo->prepare($req);
		$res->bindValue("code", $code);
		$res->bindValue("numSerie", $numSerie);
		$res->bindValue("ID_MODELE", $modele);
		$res->bindValue("Id_AVION", $id);
		$res->execute();
	}

	/**
	 * creer une ligne dans la table avion
	 *
	 */
	public static function creerAvion($code, $numSerie, $modele)
	{
		$req = "INSERT INTO avion(code, numSerie, Id_MODELE) VALUES(:code, :numSerie, :ID_MODELE)";
		$res = PdoMudry::$monPdo->prepare($req);
		$res->bindValue("code", $code);
		$res->bindValue("numSerie", $numSerie);
		$res->bindValue("ID_MODELE", $modele);
		$res->execute();
	}

	/**
	 * supprime un modele
	 *
	 */
	public static function supprAvion($id)
	{
		$req = "DELETE from avion where Id_AVION = :Id_AVION";
		$res = PdoMudry::$monPdo->prepare($req);
		$res->bindValue("Id_AVION", $id);
		try {
			$res->execute();
			echo"succès";
		} catch (Exception $e) {
			echo "erreur lors de la suppression, merci de supprimer tous les mouvements le concernant";
		}
	}


	/**
	 * Ajoute un mouvement à la bdd
	 */

	public static function ajoutMouvement($nbPlace, $numV, $distance, $heureD, $duree, $heureA, $Id_AEROPORT, $Id_AEROPORT_1, $Id_AVION)
	{

		// Vérifie si le numéro de vol est disponible
		$conflit = PdoMudry::verifDispoNumV($numV);
		if ($conflit > 0) {
			echo "Erreur : Le numéro de vol est déjà utilisé.";
			return false;
		}
		
		// Vérifie si l'avion est disponible
		$conflit = PdoMudry::verifDispoAvion($heureD, $heureA, $Id_AVION);
		if ($conflit > 0) {
			echo "Erreur : L'avion n'est pas disponible dans cette plage horaire.";
			return false;
		}

		// Vérifie que le nombre de places ne dépasse pas le nombre de sièges du modèle
		$nbSiege = PdoMudry::getNbSiegeModele($Id_AVION);
		if ($nbPlace > $nbSiege) {
			echo "Erreur : Le nombre de places dépasse le nombre de sièges du modèle (max : $nbSiege sièges).";
			return false;
		}
	

		$req = "INSERT INTO mouvement (nbPlace, numV, distance, heureD, duree, heureA, Id_AEROPORT, Id_AEROPORT_1, Id_AVION) 
				VALUES (:nbPlace, :numV, :distance, :heureD, :duree, :heureA, :Id_AEROPORT, :Id_AEROPORT_1, :Id_AVION)";

		$req = PdoMudry::$monPdo->prepare($req);
		$req->bindParam(':nbPlace', $nbPlace);
		$req->bindParam(':numV', $numV);
		$req->bindParam(':distance', $distance);
		$req->bindParam(':heureD', $heureD);
		$req->bindParam(':duree', $duree);
		$req->bindParam(':heureA', $heureA);
		$req->bindParam(':Id_AEROPORT', $Id_AEROPORT);
		$req->bindParam(':Id_AEROPORT_1', $Id_AEROPORT_1);
		$req->bindParam(':Id_AVION', $Id_AVION);

		if ($req->execute()) {
			return true;
		} else {
			echo "Erreur lors de l'exécution de la requête. ";
			print_r($req->errorInfo());
			return false;
			
		}
	}


/**
 * Modification un mouvement à la bdd
 */

 public static function modifMouvement($Id_MOUVEMENT, $nbPlace, $numV, $distance, $heureD, $duree, $heureA, $Id_AEROPORT, $Id_AEROPORT_1, $Id_AVION)
 {
	// Vérifie la dispo du numéro de vol (exclut le mouvement actuel)
	$conflit = PdoMudry::verifDispoNumVModif($numV, $Id_MOUVEMENT);
	if ($conflit > 0) {
		echo "Erreur : Le numéro de vol est déjà utilisé.";
		return false;
	}

	// Vérifie la dispo de l'avion (exclut le mouvement actuel)
	$conflit = PdoMudry::verifDispoAvionModif($heureD, $heureA, $Id_AVION, $Id_MOUVEMENT);
	if ($conflit > 0) {
		echo "L'avion n'est pas disponible à cette plage horaire.";
		return false;
	}

	$req = "UPDATE mouvement 
			set nbPlace = :nbPlace, numV = :numV, distance = :distance, heureD = :heureD, duree = :duree, heureA = :heureA, Id_AEROPORT = :Id_AEROPORT, Id_AEROPORT_1 = :Id_AEROPORT_1, Id_AVION = :Id_AVION
			where Id_MOUVEMENT = :Id_MOUVEMENT";
 
	$req = PdoMudry::$monPdo->prepare($req);
	$req->bindParam(':nbPlace', $nbPlace);
	$req->bindParam(':numV', $numV);
	$req->bindParam(':distance', $distance);
	$req->bindParam(':heureD', $heureD);
	$req->bindParam(':duree', $duree);
	$req->bindParam(':heureA', $heureA);
	$req->bindParam(':Id_AEROPORT', $Id_AEROPORT);
	$req->bindParam(':Id_AEROPORT_1', $Id_AEROPORT_1);
	$req->bindParam(':Id_AVION', $Id_AVION);
	$req->bindParam(':Id_MOUVEMENT', $Id_MOUVEMENT);

	if ($req->execute()) {
		return true;
	} else {
		echo "Erreur lors de l'exécution de la requête : ";
		print_r($req->errorInfo());
		return false;
	}

 }
 

	/**
	 * supprime un mouvement
	 *
	 */
	public static function supprimerMouvement($id)
	{
		$req = "DELETE from mouvement where Id_MOUVEMENT = :Id_MOUVEMENT";
		$res = PdoMudry::$monPdo->prepare($req);
		$res->bindValue("Id_MOUVEMENT", $id);
		try {
			$res->execute();
		} catch (Exception $e) {
			echo "Erreur lors de la suppression. Veuillez d'abord supprimer l'équipage lié à ce vol.";
		}
	}


	function connecter($identifiant,$mdp)
	{
		$req = PdoMudry::$monPdo -> prepare("SELECT * from profil where identifiant = :videntifiant");
		$req->bindValue("videntifiant", $identifiant);
		$req->execute();
		foreach($req as $ligne)
		{
			return ($ligne['mdp']==$mdp);
		}
	
		return false;
	}

	/**
	 * affiche l'equipage
	 */

	public static function getEquipages()
	{
		$req = "SELECT * from equipage";
		$res = PdoMudry::$monPdo ->query($req);
		return $res->fetchAll();
	}

	public static function getPersonnels()
	{
		$req = "SELECT * from personnel";
		$res = PdoMudry::$monPdo ->query($req);
		return $res->fetchAll();
	}

	public static function getRoles()
	{
		$req = "SELECT * from role";
		$res = PdoMudry::$monPdo ->query($req);
		return $res->fetchAll();
	}

	public static function ajoutEquipage($mouvement, $personnel, $present, $role)
	{
		$req = "INSERT INTO equipage(Id_MOUVEMENT, Id_PERSONNEL, present, Id_ROLE) VALUES (:vmouvement,:vpersonnel,:vpresent,:vrole)";
		$res = PdoMudry::$monPdo ->prepare($req);
		$res->bindValue(":vmouvement", $mouvement);
		$res->bindValue(":vpersonnel", $personnel);
		$res->bindValue(":vpresent", $present);
		$res->bindValue(":vrole", $role);
		$res->execute();
	}
	public static function getPersEqu($idM, $idP)
	{
		$req = "SELECT * from equipage where Id_MOUVEMENT = '$idM' and Id_PERSONNEL = '$idP'";
		$res = PdoMudry::$monPdo ->query($req);
		return $res->fetch();
	}
	public static function getNumero($mouvement, $personnel, $present, $role)
	{
		$req = "SELECT * from equipage where Id_MOUVEMENT = '$mouvement' and Id_PERSONNEL = '$personnel' and present = '$present' and Id_ROLE = '$role'";
		$res = PdoMudry::$monPdo ->prepare($req);
		$res->execute();
	}
	public static function modifEquipage($mouvement, $personnel, $present, $role)
	{
		$req = "UPDATE equipage SET present=:vpresent,Id_ROLE=:vrole where $mouvement = Id_MOUVEMENT and $personnel = Id_PERSONNEL";
		$res = PdoMudry::$monPdo ->prepare($req);
		$res->bindValue(":vpresent", $present);
		$res->bindValue(":vrole", $role);
		$res->execute();
	}
	public static function SuppEquipage($mouvement, $personnel, $present, $role)
	{
		$req = "DELETE from equipage where $mouvement = Id_MOUVEMENT and $personnel = Id_PERSONNEL and $present = present and $role = Id_ROLE";
		$res = PdoMudry::$monPdo ->prepare($req);
		$res->execute();
	}
    public static function getLangues(){
    $req = "SELECT * from langue";
    $res = PdoMudry::$monPdo->query($req);
    return $res->fetchAll();
}

    public static function getLanguesPersonnel($id){
        $req = "SELECT parle.Id_LANGUE, langue.nom from parle INNER JOIN langue ON parle.Id_LANGUE = langue.Id_LANGUE where Id_PERSONNEL=:id ";
        $res = PdoMudry::$monPdo->prepare($req);
        $res->bindValue(":id", $id);
        $res->execute();
        return $res->fetchAll();
    }
    /**
     * Retourne tous les modeles sous forme d'un tableau associatif
     *
     * @return// le tableau associatif des avions 
     */
    public static function getlesPersonnels()
    {
        $req = "SELECT * from personnel";
        $res = PdoMudry::$monPdo->query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }
    public static function getlesPersonnelsT()
    {
        $req = "SELECT * from technique INNER JOIN personnel ON technique.Id_PERSONNEL = personnel.Id_PERSONNEL";
        $res = PdoMudry::$monPdo->query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }
    public static function getlesPersonnelsC()
    {
        $req = "SELECT * from commercial INNER JOIN personnel ON commercial.Id_PERSONNEL = personnel.Id_PERSONNEL";
        $res = PdoMudry::$monPdo->query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }
    public static function getlePersonnel($num)
    {
        $req = "SELECT id_PERSONNEL as num, tel from personnel where id_PERSONNEL = :num";
        $res = PdoMudry::$monPdo->prepare($req);
        $res->bindValue(":num", $num);
        $res->execute();
        $ligne = $res->fetch();
        return $ligne;
    }

    public static function getlePersonnelT($num)
    {
        $req = "SELECT technique.id_PERSONNEL as num, tel, heureV from personnel INNER JOIN technique ON personnel.Id_PERSONNEL = technique.Id_PERSONNEL  where technique.id_PERSONNEL = :num";
        $res = PdoMudry::$monPdo->prepare($req);
        $res->bindValue(":num", $num);
        $res->execute();
        $ligne = $res->fetch();
        return $ligne;
    }

    /**
     * Créer un Personnel 
     *
     * Créer un personnel à partir des arguments validés passés en paramètre
     */

     public function addLangueToPersonnelC($idPersonnel, $id_LANGUE)
{
    $req ='INSERT INTO `parle` (`Id_PERSONNEL`, `id_LANGUE`) VALUES (:id_PERSONNEL, :id_LANGUE)';
    $req = PdoMudry::$monPdo->prepare($req);
    $req->bindValue(':id_PERSONNEL', $idPersonnel);
    $req->bindValue(':id_LANGUE', $id_LANGUE);
    $req->execute();
}



public function creerPersonnelC($tel, $langues)
{
    
    $req = 'INSERT INTO personnel (tel) VALUES (:tel)';
    $req = PdoMudry::$monPdo->prepare($req);
    $req->bindValue(':tel', $tel, PDO::PARAM_STR);
    $req->execute();

    
    $idPersonnel = PdoMudry::$monPdo->lastInsertId();

    
    $req = 'INSERT INTO COMMERCIAL (Id_PERSONNEL) VALUES (:idPersonnel)';
    $req = PdoMudry::$monPdo->prepare($req);
    $req->bindValue(':idPersonnel', $idPersonnel);
    $req->execute();

    
    foreach ($langues as $langue) {
       $req = "INSERT INTO parle(Id_PERSONNEL, Id_LANGUE) VALUES (:idP,:idL)";
        $req = PdoMudry::$monPdo->prepare($req);
        $req->bindValue(':idP', $idPersonnel);
        $req->bindValue(':idL', $langue);
        $req->execute();
   }

    return $idPersonnel;
}


    public function creerPersonnelT($tel, $heureV)
    {
        
        $req = 'INSERT INTO personnel (tel) VALUES (:tel)';
        $req = PdoMudry::$monPdo->prepare($req);
        $req->bindValue(':tel', $tel, PDO::PARAM_STR);
        $req->execute();
    
        
        $idPersonnel = PdoMudry::$monPdo->lastInsertId();
    
       
        $req = 'INSERT INTO TECHNIQUE (Id_PERSONNEL, heureV) VALUES (:Id_PERSONNEL, :heureV)';
        $req = PdoMudry::$monPdo->prepare($req);
        $req->bindValue(':Id_PERSONNEL', $idPersonnel); // Bind Id_PERSONNEL
        $req->bindValue(':heureV', $heureV, PDO::PARAM_STR);
        $req->execute();
    
        return $idPersonnel;
    }

  /**
     * Suprimer un Personnel 
     *
     * Supprimer un personnel à partir des arguments validés passés en paramètre
     */
   
     public function supressionPersonnelC($id_personnel)
     {
         // Commencer par supprimer les références dans la table parle
         $query = "DELETE from parle where Id_PERSONNEL = :id_personnel";
         $req = PdoMudry::$monPdo->prepare($query);
         $req->bindValue(':id_personnel', $id_personnel);
         $req->execute();
     
         // Ensuite, supprimer le personnel dans la table commercial
         $query2 = "DELETE from commercial where Id_PERSONNEL = :id_personnel";
         $req2 = PdoMudry::$monPdo->prepare($query2);
         $req2->bindValue(':id_personnel', $id_personnel);
         $req2->execute();
     }
     

    public function supressionPersonnelT($num)
    {
        // Supprimer d'abord de la table technique
        $res = PdoMudry::$monPdo->prepare('DELETE from technique where id_PERSONNEL = :num');
        $res->bindValue('num', $num);
        $res->execute();
    
        // Puis supprimer de la table personnel
        $res = PdoMudry::$monPdo->prepare('DELETE from personnel where id_PERSONNEL = :num');
        $res->bindValue('num', $num);
        $res->execute();
    }
    
    
  
     /**
     * Modifier un Personnel 
     *
     * Modifier un personnel à partir des arguments validés passés en paramètre
     */
    public function modificationPersonnelT($tel, $num,$heureV)
    {

        $res = PdoMudry::$monPdo->prepare('UPDATE personnel SET tel = :tel where id_PERSONNEL = :num');
        $res->bindValue(':tel', $tel, PDO::PARAM_STR);
        $res->bindValue(':num', $num);
        $res->execute();

        $res = PdoMudry::$monPdo->prepare('UPDATE technique SET heureV = :heureV where id_PERSONNEL = :num');
        $res->bindValue(':num', $num);
        $res->bindValue(':heureV', $heureV);
        $res->execute();

    }

    public function modificationPersonnelC($tel, $num)
    {

        $res = PdoMudry::$monPdo->prepare('UPDATE personnel SET tel = :tel where id_PERSONNEL = :num');
        $res->bindValue(':tel', $tel, PDO::PARAM_STR);
        $res->bindValue(':num', $num);
        $res->execute();

    }

    /**
     * Vérifie si l'avion est bien disponible pour un mouvement
     *
     * @return//le nombre de fois où l'avion ets déjà engagé (1 ou 0 fois)
     */
	public static function verifDispoAvion($heureA, $heureD, $Id_AVION)
{
	$req = "SELECT COUNT(*) as count from mouvement where Id_AVION = :Id_AVION and ((:heureD between heureD and heureA) 
	or (:heureA between heureD and heureA) 
	or (heureD between :heureD and :heureA) 
	or (heureA between :heureD and :heureA))";    
	$res = PdoMudry::$monPdo->prepare($req);
    $res->bindParam(':Id_AVION', $Id_AVION);
    $res->bindParam(':heureD', $heureD);
	$res->bindParam(':heureA', $heureA);
    $res->execute();
    $count = $res->fetch()['count'];

    return $count;
}

    /**
     * Vérifie si le n° de vol est bien disponible pour un mouvement
     *
     * @return//le nombre de fois où numV ets déjà entré (1 ou 0 fois)
     */
	public static function verifDispoNumV($numV)
	{
	$req = "SELECT count(*) as count from mouvement where numV = :numV";
	$res = PdoMudry::$monPdo->prepare($req);
	$res->bindParam(':numV', $numV);
	$res->execute();
	$count = $res->fetch()['count'];

	return $count; 
	}

	/**
	 * Vérifie si le nombre de siège ne dépasse ceux du modèle de l'avion choisi
	 *
	 * @return//le nombre de siège du modèle de l'avion du mouvement
	 */
	public static function getNbSiegeModele($Id_AVION)
	{
	$req = "SELECT Id_MODELE from avion where Id_AVION = :Id_AVION";
	$res = PdoMudry::$monPdo->prepare($req);
	$res->bindParam(':Id_AVION', $Id_AVION);
	$res->execute();
	$Id_MODELE = $res->fetch()['Id_MODELE'];

	$req = "SELECT nbSiege from modele where Id_MODELE = :Id_MODELE";
	$res = PdoMudry::$monPdo->prepare($req);
	$res->bindParam(':Id_MODELE', $Id_MODELE);
	$res->execute();
	$nbSiege = $res->fetch()['nbSiege'];

	return $nbSiege;
	}

	/**
	 * Vérifie si le num de vol est dispo (or le mouvement actuel)
	 *
	 * @return//le nombre de fois où numV ets déjà entré (1 ou 0 fois)
	 */
	public static function verifDispoNumVModif($numV, $Id_MOUVEMENT)
	{
	$req = "SELECT count(*) as count from mouvement where numV = :numV and Id_MOUVEMENT != :Id_MOUVEMENT";
	$res = PdoMudry::$monPdo->prepare($req);
	$res->bindParam(':numV', $numV);
	$res->bindParam(':Id_MOUVEMENT', $Id_MOUVEMENT);
	$res->execute();
	$count = $res->fetch()['count'];

	return $count; 
	}

	/**
	 * Vérifie si l'avion est disponible à cette plage horaire (or lemouvement actuel)
	 *
	 * @return//le nombre de fois où l'avion ets déjà engagé (1 ou 0 fois)
	 */
	public static function verifDispoAvionModif($heureD, $heureA, $Id_AVION, $Id_MOUVEMENT)
	{
	$req = "SELECT COUNT(*) AS count 
			FROM mouvement 
			WHERE Id_AVION = :Id_AVION 
			and ((:heureD between heureD and heureA) 
			or (:heureA between heureD and heureA) 
			or (heureD between :heureD and :heureA) 
			or (heureA between :heureD and :heureA))
			and Id_MOUVEMENT != :Id_MOUVEMENT";
	$res = PdoMudry::$monPdo->prepare($req);
	$res->bindParam(':Id_AVION', $Id_AVION);
	$res->bindParam(':heureD', $heureD, PDO::PARAM_STR);
	$res->bindParam(':heureA', $heureA, PDO::PARAM_STR);
	$res->bindParam(':Id_MOUVEMENT', $Id_MOUVEMENT);
	$res->execute();
	$count = $res->fetch(PDO::FETCH_ASSOC)['count'];

	return $count;
	}

/**
 * Ajoute un aéroport à la bdd
 */
	public static function ajoutAeroport($aita, $nom, $latitude, $longitude)
	{
		// Vérifie si le numéro aita est disponible
		$conflit = PdoMudry::verifDispoAita($aita);
		if ($conflit > 0) {
			echo "Erreur : Le numéro AITA est déjà utilisé.";
			return false;
		}

		// Vérifie si le nom est disponible
		$conflit = PdoMudry::verifDispoNom($nom);
		if ($conflit > 0) {
			echo "Erreur : Le nom d'aéroport est déjà utilisé.";
			return false;
		}

		$req = "INSERT INTO aeroport (aita, nom, latitude, longitude) VALUES (:aita, :nom, :latitude, :longitude)";
		$res = PdoMudry::$monPdo->prepare($req);
		$res->bindParam(':aita', $aita);
		$res->bindParam(':nom', $nom);
		$res->bindParam(':latitude', $latitude);
		$res->bindParam(':longitude', $longitude);
		return $res->execute();
	}

/**
 * Modifie un aéroport à la bdd
 */
	public static function modifAeroport($Id_AEROPORT, $aita, $nom, $latitude, $longitude)
	{
		$req = "UPDATE aeroport set aita = :aita, nom = :nom, latitude = :latitude, longitude = :longitude where Id_AEROPORT = :Id_AEROPORT";
		$res = PdoMudry::$monPdo->prepare($req);
		$res->bindParam(':aita', $aita);
		$res->bindParam(':nom', $nom);
		$res->bindParam(':latitude', $latitude);
		$res->bindParam(':longitude', $longitude);
		$res->bindParam(':Id_AEROPORT', $Id_AEROPORT);
		return $res->execute();
	}

/**
 * Supprime un aéroport à la bdd
 */
	public static function supprAeroport($Id_AEROPORT)
	{
		$req = "DELETE from aeroport where Id_AEROPORT = :Id_AEROPORT";
		$res = PdoMudry::$monPdo->prepare($req);
		$res->bindParam(':Id_AEROPORT', $Id_AEROPORT);
		return $res->execute();
	}

	    /**
     * Vérifie si le code AITA est bien disponible pour un aéroport
     *
     * @return//le nombre de fois où aita ets déjà entré (1 ou 0 fois)
     */
	public static function verifDispoAita($aita)
	{
	$req = "SELECT count(*) as count from aeroport where aita = :aita";
	$res = PdoMudry::$monPdo->prepare($req);
	$res->bindParam(':aita', $aita);
	$res->execute();
	$count = $res->fetch()['count'];

	return $count; 
	}

		    /**
     * Vérifie si le nom d'aéroport est bien disponible pour un aéroport
     *
     * @return//le nombre de fois où le nom ets déjà entré (1 ou 0 fois)
     */
	public static function verifDispoNom($nom)
	{
	$req = "SELECT count(*) as count from aeroport where nom = :nom";
	$res = PdoMudry::$monPdo->prepare($req);
	$res->bindParam(':nom', $nom);
	$res->execute();
	$count = $res->fetch()['count'];

	return $count; 
	}

	public static function supprMouvementAeroport($Id_AEROPORT)
{
    $res = "DELETE from mouvement where Id_AEROPORT = :Id_AEROPORT or Id_AEROPORT_1 = :Id_AEROPORT";
    $res = self::$monPdo->prepare($res);
    $res->bindParam(':Id_AEROPORT', $Id_AEROPORT);
    
    return $res->execute();
}

}

