<?php

function jourWeekEnd($date){
	$weekend=$co->query('SELECT weekend FROM jourSemaine WHERE date='.$date); 
	$weekendResu=$weekend->fetch();

	return($weekendResu['weekend']);
	
	$weekend->closeCursor();
}
?>