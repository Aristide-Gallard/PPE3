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
    private static $bdd = "mudry";
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
    		PdoMudry::$monPdo = new PDO(PdoMudry::$serveur.';'.PdoMudry::$bdd, PdoMudry::$user, PdoMudry::$mdp); 
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
 * Retourne tous les modeles sous forme d'un tableau associatif
 *
 * @return// le tableau associatif des avions 
*/
    public static function getModeles(){
        $req = "SELECT modele.Id_MODELE, modele.libelle, modele.nbSiege, personnel.Id_PERSONNEL, personnel.tel,associe.nombre FROM associe INNER JOIN modele ON associe.Id_MODELE = modele.Id_MODELE INNER JOIN personnel ON associe.Id_PERSONNEL = personnel.Id_PERSONNEL";
        $res = PdoMudry::$monPdo->query($req);
        return $res->fetchAll();
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