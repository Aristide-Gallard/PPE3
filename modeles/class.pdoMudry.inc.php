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
	 * supprime un modele
	 *
	 */
	public static function supprModele($id)
	{
		$req = "DELETE FROM modele WHERE Id_MODELE = :ID_MODELE";
		$res = PdoMudry::$monPdo->prepare($req);
		$res->bindValue("ID_MODELE", $id);
		$res->execute();
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

}