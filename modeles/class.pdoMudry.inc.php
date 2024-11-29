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
    /**
 * Retourne tous les modeles sous forme d'un tableau associatif
 *
 * @return// le tableau associatif des avions 
*/
public static function getlesPersonnels(){
    $req = "SELECT * FROM personnel";
    $res = PdoMudry::$monPdo->query($req);
    $lesLignes = $res->fetchAll();
    return $lesLignes;
}
public static function getlePersonnel($num)
{
    $req = "SELECT id_PERSONNEL AS num, tel FROM personnel WHERE id_PERSONNEL = :num";
    $res = PdoMudry::$monPdo->prepare($req);
    $res->bindValue(":num", $num, PDO::PARAM_INT);
    $res->execute();
    $ligne = $res->fetch(PDO::FETCH_ASSOC);
    return $ligne;
}

/**
 * Créer un Personnel 
 *
 * Créer un personnel à partir des arguments validés passés en paramètre
*/
public function creerPersonnelC($tel)
{
        $req = 'INSERT INTO personnel (tel) VALUES (:tel)';
        $req = PdoMudry::$monPdo->prepare($req);
        $req->bindValue(':tel', $tel, PDO::PARAM_STR);
        $req->execute();
         $idPersonnel = PdoMudry::$monPdo->lastInsertId();
        $req = 'INSERT INTO COMMERCIAL (Id_PERSONNEL) VALUES (:idPersonnel)';
        $req = PdoMudry::$monPdo->prepare($req);
        $req->bindValue(':idPersonnel', $idPersonnel, PDO::PARAM_INT);
        $req->execute();
        

         return $idPersonnel;    
        

}

public function creerPersonnelT($tel)
{
    // Commencez la transaction
    PdoMudry::$monPdo->beginTransaction();
    
        // Insertion dans la table personnel
        $req = 'INSERT INTO personnel (tel) VALUES (:tel)';
        $stmt = PdoMudry::$monPdo->prepare($req);
        $stmt->bindValue(':tel', $tel, PDO::PARAM_STR);
        $stmt->execute();
        
        // Récupération du dernier ID inséré
        $idPersonnel = PdoMudry::$monPdo->lastInsertId();
        
        // Insertion dans la table TECHNIQUE
        $req = 'INSERT INTO TECHNIQUE (Id_PERSONNEL) VALUES (:idPersonnel)';
        $stmt = PdoMudry::$monPdo->prepare($req);
        $stmt->bindValue(':idPersonnel', $idPersonnel, PDO::PARAM_INT);
        $stmt->execute();
        
      
}
 
        


/**
 * Modifier un Personnel 
 *
 * Modifier un personnel à partir des arguments validés passés en paramètre
*/
public function supressionPersonnel($num)
{
	$res = PdoMudry::$monPdo->prepare('DELETE from personnel WHERE id_PERSONNEL = :num');
	$res->bindValue('num', $num, PDO::PARAM_INT);
	$res->execute();
}
public function supressionPersonnelC($num)
{
    $res = PdoMudry::$monPdo->prepare('DELETE from commercial WHERE id_PERSONNEL = :num');
	$res->bindValue('num', $num, PDO::PARAM_INT);
	$res->execute();
	$res = PdoMudry::$monPdo->prepare('DELETE from personnel WHERE id_PERSONNEL = :num');
	$res->bindValue('num', $num, PDO::PARAM_INT);
	$res->execute();
}
/**
 * Suprimer un Personnel 
 *
 * Supprimer un personnel à partir des arguments validés passés en paramètre
*/
public function modificationPersonnel($tel, $num)
{
   
        $res = PdoMudry::$monPdo->prepare('UPDATE personnel SET tel = :tel WHERE id_PERSONNEL = :num');
        $res->bindValue(':tel', $tel, PDO::PARAM_STR);
        $res->bindValue(':num', $num, PDO::PARAM_INT);
        $res->execute();

        if ($res->rowCount() === 0) {
            return "Aucune modification effectuée. Vérifiez l'ID.";
        }

        return "Mise à jour réussie.";
   
}
}

