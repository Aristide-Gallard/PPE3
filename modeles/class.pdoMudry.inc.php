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
	 * Retourne l'avion sous forme d'un tableau associatif
	 *
	 * @return// l'aeroport choisie selon id
	 */
public function getAeroport($idAeroport) {
    $req = "SELECT * FROM aeroport WHERE aeroport.Id_AEROPORT = :aeroport";
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
	 * @return// l'avion choisie selon id
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
	include("vues/v_confirmAjouterMouvement.php");
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



	function connecter($identifiant,$mdp)
	{
		$req = PdoMudry::$monPdo -> prepare("SELECT * FROM profil WHERE identifiant = :videntifiant");
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
		$req = "SELECT * FROM equipage";
		$res = PdoMudry::$monPdo ->query($req);
		return $res->fetchAll();
	}

	public static function getPersonnels()
	{
		$req = "SELECT * FROM personnel";
		$res = PdoMudry::$monPdo ->query($req);
		return $res->fetchAll();
	}

	public static function getRoles()
	{
		$req = "SELECT * FROM role";
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
		$req = "SELECT * FROM equipage WHERE Id_MOUVEMENT = '$idM' AND Id_PERSONNEL = '$idP'";
		$res = PdoMudry::$monPdo ->query($req);
		return $res->fetch();
	}
	public static function getNumero($mouvement, $personnel, $present, $role)
	{
		$req = "SELECT * from equipage where Id_MOUVEMENT = '$mouvement' AND Id_PERSONNEL = '$personnel' AND present = '$present' AND Id_ROLE = '$role'";
		$res = PdoMudry::$monPdo ->prepare($req);
		$res->execute();
	}
	public static function modifEquipage($mouvement, $personnel, $present, $role)
	{
		$req = "UPDATE equipage SET present=:vpresent,Id_ROLE=:vrole WHERE $mouvement = Id_MOUVEMENT AND $personnel = Id_PERSONNEL";
		$res = PdoMudry::$monPdo ->prepare($req);
		$res->bindValue(":vpresent", $present);
		$res->bindValue(":vrole", $role);
		$res->execute();
	}
	public static function SuppEquipage($mouvement, $personnel, $present, $role)
	{
		$req = "DELETE FROM equipage WHERE $mouvement = Id_MOUVEMENT AND $personnel = Id_PERSONNEL AND $present = present AND $role = Id_ROLE";
		$res = PdoMudry::$monPdo ->prepare($req);
		$res->execute();
	}
    public static function getLangues(){
    $req = "SELECT * FROM langue";
    $res = PdoMudry::$monPdo->query($req);
    return $res->fetchAll();
}

    public static function getLanguesPersonnel($id){
        $req = "SELECT parle.Id_LANGUE, langue.nom FROM parle INNER JOIN langue ON parle.Id_LANGUE = langue.Id_LANGUE WHERE Id_PERSONNEL=:id ";
        $res = PdoMudry::$monPdo->prepare($req);
        $res->bindValue(":id", $id, PDO::PARAM_INT);
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
        $req = "SELECT * FROM personnel";
        $res = PdoMudry::$monPdo->query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }
    public static function getlesPersonnelsT()
    {
        $req = "SELECT * FROM technique INNER JOIN personnel ON technique.Id_PERSONNEL = personnel.Id_PERSONNEL";
        $res = PdoMudry::$monPdo->query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }
    public static function getlesPersonnelsC()
    {
        $req = "SELECT * FROM commercial INNER JOIN personnel ON commercial.Id_PERSONNEL = personnel.Id_PERSONNEL";
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

    public static function getlePersonnelT($num)
    {
        $req = "SELECT technique.id_PERSONNEL AS num, tel, heureV FROM personnel INNER JOIN technique ON personnel.Id_PERSONNEL = technique.Id_PERSONNEL  WHERE technique.id_PERSONNEL = :num";
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

     public function addLangueToPersonnelC($idPersonnel, $id_LANGUE)
{
    $req ='INSERT INTO `parle` (`Id_PERSONNEL`, `id_LANGUE`) VALUES (:id_PERSONNEL, :id_LANGUE)';
    $req = PdoMudry::$monPdo->prepare($req);
    $req->bindValue(':id_PERSONNEL', $idPersonnel, PDO::PARAM_INT);
    $req->bindValue(':id_LANGUE', $id_LANGUE, PDO::PARAM_INT);
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
    $req->bindValue(':idPersonnel', $idPersonnel, PDO::PARAM_INT);
    $req->execute();

    
    foreach ($langues as $langue) {
       $req = "INSERT INTO parle(Id_PERSONNEL, Id_LANGUE) VALUES (:idP,:idL)";
        $req = PdoMudry::$monPdo->prepare($req);
        $req->bindValue(':idP', $idPersonnel, PDO::PARAM_INT);
        $req->bindValue(':idL', $langue, PDO::PARAM_INT);
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
        $req->bindValue(':Id_PERSONNEL', $idPersonnel, PDO::PARAM_INT); // Bind Id_PERSONNEL
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
         $query = "DELETE FROM parle WHERE Id_PERSONNEL = :id_personnel";
         $req = PdoMudry::$monPdo->prepare($query);
         $req->bindValue(':id_personnel', $id_personnel, PDO::PARAM_INT);
         $req->execute();
     
         // Ensuite, supprimer le personnel dans la table commercial
         $query2 = "DELETE FROM commercial WHERE Id_PERSONNEL = :id_personnel";
         $req2 = PdoMudry::$monPdo->prepare($query2);
         $req2->bindValue(':id_personnel', $id_personnel, PDO::PARAM_INT);
         $req2->execute();
     }
     

    public function supressionPersonnelT($num)
    {
        // Supprimer d'abord de la table technique
        $res = PdoMudry::$monPdo->prepare('DELETE FROM technique WHERE id_PERSONNEL = :num');
        $res->bindValue('num', $num, PDO::PARAM_INT);
        $res->execute();
    
        // Puis supprimer de la table personnel
        $res = PdoMudry::$monPdo->prepare('DELETE FROM personnel WHERE id_PERSONNEL = :num');
        $res->bindValue('num', $num, PDO::PARAM_INT);
        $res->execute();
    }
    
    
  
     /**
     * Modifier un Personnel 
     *
     * Modifier un personnel à partir des arguments validés passés en paramètre
     */
    public function modificationPersonnelT($tel, $num,$heureV)
    {

        $res = PdoMudry::$monPdo->prepare('UPDATE personnel SET tel = :tel WHERE id_PERSONNEL = :num');
        $res->bindValue(':tel', $tel, PDO::PARAM_STR);
        $res->bindValue(':num', $num, PDO::PARAM_INT);
        $res->execute();

        $res = PdoMudry::$monPdo->prepare('UPDATE technique SET heureV = :heureV WHERE id_PERSONNEL = :num');
        $res->bindValue(':num', $num, PDO::PARAM_INT);
        $res->bindValue(':heureV', $heureV, PDO::PARAM_INT);
        $res->execute();

    }

    public function modificationPersonnelC($tel, $num)
    {

        $res = PdoMudry::$monPdo->prepare('UPDATE personnel SET tel = :tel WHERE id_PERSONNEL = :num');
        $res->bindValue(':tel', $tel, PDO::PARAM_STR);
        $res->bindValue(':num', $num, PDO::PARAM_INT);
        $res->execute();

    }
}

