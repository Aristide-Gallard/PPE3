<?php
session_start();

require_once("modele/class.pdoMudry.inc.php");
require_once("modele/fonctions.inc.php");

if(!isset($_REQUEST['uc']))
     $uc = 'accueil';
else
	$uc = $_REQUEST['uc'];
