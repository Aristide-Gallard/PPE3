<?php
session_start();

require_once("modeles/class.pdoMudry.inc.php");
require_once("modeles/fonctions.inc.php");

if(!isset($_REQUEST['uc']))
     $uc = 'accueil';
else
	$uc = $_REQUEST['uc'];

switch($uc)
{
     case 'accueil':
          {include("vues/v_accueil.php");break;}
}