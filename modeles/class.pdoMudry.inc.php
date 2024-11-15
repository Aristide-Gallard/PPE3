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

    public function getLesPersonnels()
    {    
        $query = "SELECT * FROM personnel"; 
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
/**

 * Crée un personnel
 *
 * Crée une personnel à partir des arguments validés passés en paramètre, l'identifiant est
 * construit à partir du maximum existant ; crée les lignes de commandes dans la table contenir à partir du
 * tableau d'id_Personnel passé en paramètre
 * @param $id_PERSONNEL 
 * @param $tel
*/
	public function creerPersonnel($tel)
	{
		$res = PdoMudry::$monPdo->prepare('INSERT INTO Personnel (tel) VALUES(  
			 :tel )');
		
		$res->bindValue('tel', $tel, PDO::PARAM_STR);   
		$res->execute();
	}
	public function modificationPersonnel($tel)
	{
		$res = PdoMudry::$monPdo->prepare('UPDATE Personnel (tel) VALUES(  
			 :tel)');
		$res->bindValue('id_PERSONNEL',$id_Personnel, PDO::PARAM_STR);
		$res->bindValue('tel', $tel, PDO::PARAM_STR);   
		$res->execute();
	}
	
	public function supressionPersonnel($id_Personnel)
{
	$res = PdoMudry::$monPdo->prepare('DELETE from Personnel WHERE id_PERSONNEL=:id_Personnel');
	$res->bindValue(':id_PERSONNEL', $id_Personnel, PDO::PARAM_INT);
	$res->execute();
}

}
