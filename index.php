<?php
session_start();

require_once("modeles/class.pdoMudry.inc.php");
require_once("modeles/fonctions.inc.php");
require_once("vues/v_entete.php");
include("vues/v_header.php");

if (!isset($_REQUEST['uc']))
     $uc = 'accueil';
else
     $uc = $_REQUEST['uc'];

$pdo = PdoMudry::getPdoMudry();

switch($uc)
{
     case 'accueil':
          {include("vues/v_accueil.php");break;}
     case 'flotte':
          {include("controleurs/c_gestionFlotte.php");break;}
     case 'vol':
          {include("controleurs/c_gestionVol.php");break;}
     case 'Personnel':
          {include("controleurs/c_gestionPersonnel.php");break;}
     case 'connexion':
          {include("controleurs/c_gestionConnexion.php");break;}
     case 'equipage' :
          {include("controleurs/c_gestionEquipage.php");break;}
}