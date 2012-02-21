<?php

/*
     Retourne le nombre total de restaurant présent dans la base de données
     Auteur Xavier,Thomas,Maxence
*/
function nbTotalResto(){
	$nbTotal=mysql_query('SELECT Count(*) FROM restaurant'); // compte le nombre de restaurant.
	$nbTotalResu=mysql_fetch_row($nbTotal);

	return $nbTotalResu[0];
}

?>