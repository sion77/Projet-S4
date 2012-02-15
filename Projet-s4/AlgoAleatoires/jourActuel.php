<?php
function jourActuel(&$leJour, &$leMois){
	$requete=mysql_query('SELECT jourActuel, moisActuel FROM jourActuel'); 
	$resultat = mysql_fetch_row($requete);

	$leJour=$resultat[0];
	$leMois=$resultat[1];
}
?>