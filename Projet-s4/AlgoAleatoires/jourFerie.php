<?php

//Retourne vrai si le jour est férie, sinon faux
function jourFerie($leJour,$leMois){
	$ferie=mysql_query('SELECT COUNT(*) FROM ferie WHERE jourFerie='.$leJour.' AND moisFerie='.$leMois); 
	$ferieResu=mysql_fetch_row($ferie);
	if(ferieResu[0]==0) return false;
	else return true;
}
?>