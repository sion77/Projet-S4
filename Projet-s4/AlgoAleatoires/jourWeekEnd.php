<?php
//v�rifie si p�riode de week end
function jourWeekEnd($leJour,$leMois){
	
	if($leJour%6==0 || $leJour%7==0)	return true;
	else return false;
}
?>