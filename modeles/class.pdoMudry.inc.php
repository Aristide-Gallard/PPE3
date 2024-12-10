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
    public static function getAvions()
    {
        $req = "SELECT avion.Id_AVION, avion.code, avion.numSerie, modele.Id_MODELE, modele.libelle FROM avion 
INNER JOIN modele ON avion.Id_MODELE = modele.Id_MODELE";
        $res = PdoMudry::$monPdo->query($req);
        return $res->fetchAll();
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

    public static function getlePersonnelC($num)
    {
        $req = "SELECT personnel.Id_PERSONNEL, parle.Id_LANGUE,personnel.tel,langue.nom FROM personnel
INNER JOIN parle ON personnel.Id_PERSONNEL = parle.Id_PERSONNEL
INNER JOIN langue on parle.Id_LANGUE = langue.Id_LANGUE
  WHERE personnel.id_PERSONNEL = :num";
        $res = PdoMudry::$monPdo->prepare($req);
        $res->bindValue(":num", $num, PDO::PARAM_INT);
        $res->execute();
        $ligne = $res->fetch(PDO::FETCH_ASSOC);
        return $ligne;
    }
// Fichier : modeles/PdoMudry.php

public function getToutesLesLangues()
{
    $query = 'SELECT * FROM langue';  // Récupérer toutes les langues
    $res = PdoMudry::$monPdo->query($query);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}

    public function getLanguesParPersonnel($idPersonnel) {
        $req = PdoMudry::$monPdo->prepare('
            SELECT l.Id_LANGUE, l.nom 
            FROM parle p
            INNER JOIN langue l ON p.Id_LANGUE = l.Id_LANGUE
            WHERE p.Id_PERSONNEL = :idPersonnel
        ');
        $req->bindValue(':idPersonnel', $idPersonnel, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
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

        $res = PdoMudry::$monPdo->prepare('UPDATE technique SET langue = :langue WHERE id_PERSONNEL = :num');
        $res->bindValue(':num', $num, PDO::PARAM_INT);
        $res->bindValue(':heureV', $heureV, PDO::PARAM_INT);
        $res->execute();

    }

    public function modificationPersonnelC($tel, $num,$langues)
    {

        $res = PdoMudry::$monPdo->prepare('UPDATE personnel SET tel = :tel WHERE id_PERSONNEL = :num');
        $res->bindValue(':tel', $tel, PDO::PARAM_STR);
        $res->bindValue(':num', $num, PDO::PARAM_INT);
        $res->execute();

        $res = PdoMudry::$monPdo->prepare('UPDATE commercial SET langue = :langue WHERE id_PERSONNEL = :num');
        $res->bindValue(':num', $num, PDO::PARAM_INT);
        $res->bindValue(':heureV', $langues, PDO::PARAM_INT);
        $res->execute();


    }
    public function updateLanguesPersonnel($num, $langues) {
        // Supprimer les langues existantes
        $reqDelete = PdoMudry::$monPdo->prepare('DELETE FROM parle WHERE Id_PERSONNEL = :num');
        $reqDelete->bindValue(':num', $num, PDO::PARAM_INT);
        $reqDelete->execute();
    
        // Ajouter les nouvelles langues
        $reqInsert = PdoMudry::$monPdo->prepare('INSERT INTO parle (Id_PERSONNEL, Id_LANGUE) VALUES (:num, :langue)');
        foreach ($langues as $langue) {
            $reqInsert->bindValue(':num', $num, PDO::PARAM_INT);
            $reqInsert->bindValue(':langue', $langue, PDO::PARAM_INT);
            $reqInsert->execute();
        }
    }
    // Fichier : modeles/PdoMudry.php

public function ajouterLangueAuPersonnel($num, $langueId)
{
    // Ajout de la langue dans la table 'parle'
    $query = 'INSERT INTO parle (Id_PERSONNEL, Id_LANGUE) VALUES (:num, :langueId)';
    $res = PdoMudry::$monPdo->prepare($query);
    $res->bindValue(':num', $num, PDO::PARAM_INT);  // Bind de l'ID du personnel
    $res->bindValue(':langueId', $langueId, PDO::PARAM_INT);  // Bind de l'ID de la langue
    $res->execute();
}

    
}

