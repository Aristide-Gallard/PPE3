<?php
function initPersonnel()
{
	if(!isset($_SESSION['Personnel']))
	{
		$_SESSION['Personnel']= array();
	}
}
/**
 * Supprime le panier
 *
 * Supprime la variable de type session 
 */

/**
 * Ajoute un produit au panier
 *
 * Teste si l'identifiant du produit est déjà dans la variable session 
 * ajoute l'identifiant à la variable de type session dans le cas où
 * où l'identifiant du produit n'a pas été trouvé
 * @param $idProduit : identifiant de produit
 * @return vrai si le produit n'était pas dans la variable, faux sinon 
*/
function creerPersonnel($id_Personnel)
{
	
	$ok = true;
	if(in_array($id_Personnel,$_SESSION['Personnel']))
	{
		$ok = false;
	}
	else
	{
		$_SESSION['personnel'][]= $id_Personnel;
	}
	return $ok;
}
?>