<?php

function jourFerie($date){
	$ferie= $co->query('SELECT ferie FROM jourSemaine WHERE date='.$date); 
	$ferieResu=$ferie->fetch();

	return($ferieResu['ferie']);
	
	$ferie->closeCursor();
}
?>