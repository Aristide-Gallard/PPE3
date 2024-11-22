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
    private static $user='root' ;    		
    private static $mdp='toor' ;
	private static $monPdo;
	private static $monPdoMudry = null;

    /**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	private function __construct()
	{
		if ($_SERVER['SERVER_NAME'] == 'localhost')
		{PdoMudry::$monPdo = new PDO(PdoMudry::$serveur.';'.PdoMudry::$bdd, PdoMudry::$user, PdoMudry::$mdp);}
		else
		{PdoMudry::$monPdo=new PDO ('mysql:host=db672809001.db.1and1.com;dbname=db672809001', 'dbo672809001','$siQU3N9Lp2SiJKRX^');}

		PdoMudry::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		PdoMudry::$monPdo = null;
	}

    /**
 * Fonction statique qui crée l'unique instance de la classe
 *
 * Appel : $instancePdoJardiPlants = PdoJardiPlants::getPdoJardiPlants();
 * @return// l'unique objet de la classe PdoJardiPlants
 */
	public  static function getPdoMudry()
	{
		if(PdoMudry::$monPdoMudry == null)
		{
			PdoMudry::$monPdoMudry= new PdoMudry();
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
    public static function getModeles(){
        $req = "SELECT * FROM modele";
        $res = PdoMudry::$monPdo->query($req);
        $lesLignes = $res->fetchAll();
		return $lesLignes;
    }

/**
 * Retourne tous les avions sous forme d'un tableau associatif
 *
 * @return// le tableau associatif des avions 
*/
    public static function getAvions(){
        $req = "SELECT avion.Id_AVION, avion.code, avion.numSerie, modele.Id_MODELE, modele.libelle FROM avion 
INNER JOIN modele ON avion.Id_MODELE = modele.Id_MODELE";
        $res = PdoMudry::$monPdo->query($req);
        return $res->fetchAll();
    }


}