<?php
session_start();

require_once("modeles/class.pdoMudry.inc.php");
require_once("modeles/fonctions.inc.php");

if(!isset($_REQUEST['uc']))
     $uc = 'accueil';
else
	$uc = $_REQUEST['uc'];

$pdo = PdoMudry::getPdoMudry() ;
switch($uc)
{
     case 'accueil':
          {include("vues/v_accueil.php");break;}
     case 'connexion':
          {include("controleurs/c_gestionConnexion.php");break;}
}