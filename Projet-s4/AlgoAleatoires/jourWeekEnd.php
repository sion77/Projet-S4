<?php
/*
   Fonction qui permet de savoir que le jour actuel est un week-end (à modifier)
   Auteurs Maxence,Thomas,Xavier
*/
function jourWeekEnd($date){
	$weekend=$co->query('SELECT weekend FROM jourSemaine WHERE date='.$date); 
	$weekendResu=$weekend->fetch();

	return($weekendResu['weekend']);
	
	$weekend->closeCursor();
}
?>