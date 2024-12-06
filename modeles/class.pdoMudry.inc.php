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
 *
 * @return// le tableau associatif des mouvements 
*/
public static function getMouvements(){
	$req = "SELECT mouvement.Id_MOUVEMENT, mouvement.nbPlace, mouvement.numV, mouvement.distance, mouvement.heureD, mouvement.duree, mouvement.heureA, mouvement.Id_AEROPORT, mouvement.Id_AEROPORT_1, mouvement.Id_AVION FROM mouvement 
	INNER JOIN aeroport ON mouvement.Id_AEROPORT = aeroport.Id_AEROPORT
	INNER JOIN avion ON mouvement.Id_AVION = avion.Id_AVION";
	
	$res = PdoMudry::$monPdo->query($req);
	return $res->fetchAll();
}


/**
 * Retourne tous les aéroports sous forme d'un tableau associatif
 *
 * @return// le tableau associatif des aéroports 
*/
public static function getAeroports(){
	$req = "SELECT aeroport.Id_AEROPORT, aeroport.aita, aeroport.nom, aeroport.latitude, aeroport.longitude FROM aeroport";

	$res = PdoMudry::$monPdo->query($req);
	return $res->fetchAll();
}




	/**
	 * Retourne tous les modeles sous forme d'un tableau associatif
	 *
	 * @return// le tableau associatif des avions 
	 */
	public static function getModeles()
	{
		$req = "SELECT Id_MODELE, libelle, nbSiege, (SELECT nombre FROM associe WHERE associe.Id_MODELE = rp.Id_MODELE AND associe.Id_ROLE=1) AS CDB,
(SELECT nombre FROM associe WHERE associe.Id_MODELE = rp.Id_MODELE AND associe.Id_ROLE=2) AS OPL,
(SELECT nombre FROM associe WHERE associe.Id_MODELE = rp.Id_MODELE AND associe.Id_ROLE=3) AS CCP,
(SELECT nombre FROM associe WHERE associe.Id_MODELE = rp.Id_MODELE AND associe.Id_ROLE=4) AS CC,
(SELECT nombre FROM associe WHERE associe.Id_MODELE = rp.Id_MODELE AND associe.Id_ROLE=5) AS 'H/S'
FROM modele rp";
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
		$req = "SELECT Id_MODELE, libelle, nbSiege, (SELECT nombre FROM associe WHERE associe.Id_MODELE = rp.Id_MODELE AND associe.Id_ROLE=1) AS CDB,
(SELECT nombre FROM associe WHERE associe.Id_MODELE = rp.Id_MODELE AND associe.Id_ROLE=2) AS OPL,
(SELECT nombre FROM associe WHERE associe.Id_MODELE = rp.Id_MODELE AND associe.Id_ROLE=3) AS CCP,
(SELECT nombre FROM associe WHERE associe.Id_MODELE = rp.Id_MODELE AND associe.Id_ROLE=4) AS CC,
(SELECT nombre FROM associe WHERE associe.Id_MODELE = rp.Id_MODELE AND associe.Id_ROLE=5) AS 'H/S'
FROM modele rp WHERE rp.id_MODELE = :id_modele";
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
		$req = "UPDATE modele SET libelle = :libelle, nbSiege = :nbSiege WHERE Id_MODELE = :ID_MODELE";
		$res = PdoMudry::$monPdo->prepare($req);
		$res->bindValue("ID_MODELE", $id);
		$res->bindValue("libelle", $libelle);
		$res->bindValue("nbSiege", $nbSiege);
		$res->execute();
		$req = "UPDATE associe SET nombre = :nombre WHERE Id_ROLE= :Id_ROLE AND Id_MODELE = :Id_MODELE";
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
		$req = "SELECT Id_MODELE FROM modele WHERE libelle = :libelle AND nbSiege = :nbSiege ORDER BY Id_MODELE DESC LIMIT 1";
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
		$req = "DELETE FROM modele WHERE Id_MODELE = :ID_MODELE";
		$res = PdoMudry::$monPdo->prepare($req);
		$res->bindValue("ID_MODELE", $id);
		try {
			$res->execute();
		} catch (Exception $e) {
			echo "merci de d'abord supprimer les avions correspondants à ce modele";
		}
	}


	/**
	 * Retourne tous les avions sous forme d'un tableau associatif
	 *
	 * @return// le tableau associatif des avions 
	 */
	public static function getAvions()
	{
		$req = "SELECT avion.Id_AVION, avion.code, avion.numSerie, modele.Id_MODELE, modele.libelle FROM avion 
INNER JOIN modele ON avion.Id_MODELE = modele.Id_MODELE";
		$res = PdoMudry::$monPdo->query($req);
		return $res->fetchAll();
	}

	/**
	 * Retourne l'avion sous forme d'un tableau associatif
	 *
	 * @return// le tableau associatif de l'avion 
	 */
	public static function getAvion($id)
	{
		$req = "SELECT avion.Id_AVION, avion.code, avion.numSerie, modele.Id_MODELE, modele.libelle FROM avion 
INNER JOIN modele ON avion.Id_MODELE = modele.Id_MODELE WHERE avion.Id_AVION = :avion";
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
		$req = "UPDATE avion SET code = :code, numSerie = :numSerie, Id_MODELE = :ID_MODELE WHERE Id_AVION = :Id_AVION";
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
		$req = "DELETE FROM avion WHERE Id_AVION = :Id_AVION";
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

 public static function ajoutMouvement($numV,$nbPlace,$distance,$heureD,$duree,$heureA,$Id_AEROPORT,$Id_AEROPORT_1,$Id_AVION ){

	$req = "INSERT INTO mouvement (numV, nbPlace, distance, heureD, duree, heureA, Id_AEROPORT, Id_AEROPORT_1, Id_AVION) 
	VALUES (:numV, :nbPlace, :distance, :heureD, :duree, :heureA, :Id_AEROPORT, :Id_AEROPORT_1, :Id_AVION)";

	$req = PdoMudry::$monPdo->prepare($req);
	$req->bindParam(':numV', $numV);
	$req->bindParam(':nbPlace', $nbPlace);
	$req->bindParam(':distance', $distance);
	$req->bindParam(':heureD', $heureD);
	$req->bindParam(':duree', $duree);
	$req->bindParam(':heureA', $heureA);
	$req->bindParam(':Id_AEROPORT', $Id_AEROPORT);
	$req->bindParam(':Id_AEROPORT_1', $Id_AEROPORT_1);
	$req->bindParam(':Id_AVION', $Id_AVION);
	$res = $req->execute();

	if ($res) {
	echo "Insertion réussie";
	} else {
	echo "Erreur lors de l'insertion";
	}
}

/**
 * Modification un mouvement à la bdd
 */

 public static function modifMouvement($nbPlace,$distance,$heureD,$duree,$heureA,$Id_AEROPORT,$Id_AEROPORT_1,$Id_AVION ){

	$req = "UPDATE mouvement (nbPlace, distance, heureD, duree, heureA, Id_AEROPORT, Id_AEROPORT_1, Id_AVION) 
	set (:nbPlace, :distance, :heureD, :duree, :heureA, :Id_AEROPORT, :Id_AEROPORT_1, :Id_AVION)";

	$req = PdoMudry::$monPdo->prepare($req);
	$req->bindParam(':nbPlace', $nbPlace);
	$req->bindParam(':distance', $distance);
	$req->bindParam(':heureD', $heureD);
	$req->bindParam(':duree', $duree);
	$req->bindParam(':heureA', $heureA);
	$req->bindParam(':Id_AEROPORT', $Id_AEROPORT);
	$req->bindParam(':Id_AEROPORT_1', $Id_AEROPORT_1);
	$req->bindParam(':Id_AVION', $Id_AVION);
	$res = $req->execute();

	if ($res) {
	echo "Insertion réussie. ";
	} else {
	echo "Erreur lors de l'insertion";
	}
}





}