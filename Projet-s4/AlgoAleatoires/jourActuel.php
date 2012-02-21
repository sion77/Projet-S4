<?php

/*
   Permet d'obtenir le jour actuel (à modifier peut-être)
   Auteurs Xavier,Maxence,Thomas
*/
function jourActuel(&$leJour, &$leMois){
	$requete=mysql_query('SELECT jourActuel, moisActuel FROM jourActuel'); 
	$resultat = mysql_fetch_row($requete);

	$leJour=$resultat[0];
	$leMois=$resultat[1];
}
?>