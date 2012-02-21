<?php

/* 
   fonction pour savoir que le jour actuel est férié ( à modifier)
   Auteurs Maxence,Thomas,Xavier
*/
function jourFerie($date){
	$ferie= $co->query('SELECT ferie FROM jourSemaine WHERE date='.$date); 
	$ferieResu=$ferie->fetch();

	return($ferieResu['ferie']);
	
	$ferie->closeCursor();
}
?>