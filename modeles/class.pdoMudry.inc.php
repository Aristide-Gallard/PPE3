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
    public function getLesPersonnels()
	{
		$req = "select * from personnel";
		$res = PdoTransNat::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	public function getLeClient($num)
	{
		$req = "select * from personnel WHERE id_PERSONNEL =".$id_PERSONNEL;
		$res = PdoTransNat::$monPdo->query($req);
		$lesLignes = $res->fetch();
		return $lesLignes;
	}

/**

 * Crée une commande 
 *
 * Crée une commande à partir des arguments validés passés en paramètre, l'identifiant est
 * construit à partir du maximum existant ; crée les lignes de commandes dans la table contenir à partir du
 * tableau d'idProduit passé en paramètre
 * @param $id_PERSONNEL 
 * @param $tel
*/
	public function creerPersonnel($id_Personnel,$tel)
	{
		$res = PdoTransNat::$monPdo->prepare('INSERT INTO Personnel (id_PERSONNEL,tel) VALUES(  
			:id_PERSONNEL, :tel )');
		$res->bindValue('id_PERSONNEL',$id_Personnel, PDO::PARAM_STR);
		$res->bindValue('tel', $tel, PDO::PARAM_STR);   
		$res->execute();
	}
	public function modificationPersonnel($id_Personnel,$tel)
	{
		$res = PdoTransNat::$monPdo->prepare('DELETE Personnel (id_PERSONNEL,tel) VALUES(  
			:id_PERSONNEL, :tel)');
		$res->bindValue('id_PERSONNEL',$id_Personnel, PDO::PARAM_STR);
		$res->bindValue('tel', $tel, PDO::PARAM_STR);   
		$res->execute();
	}
	}
	public function supressionPersonnel($id_Personnel)
{
	$res = PdoTransNat::$monPdo->prepare('DELETE from Personnel WHERE id_PERSONNEL=:id_Personnel');
	$res->bindValue(':id_PERSONNEL', $id_Personnel, PDO::PARAM_INT);
	$res->execute();
}


