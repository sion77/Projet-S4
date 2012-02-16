<?php 

function nbTotalResto(){

//connexion à la BD

//Requete sql
$nbTotal= my   ('SELECT Count(*) FROM monRestau');

return $nbTotal;

}

?>
