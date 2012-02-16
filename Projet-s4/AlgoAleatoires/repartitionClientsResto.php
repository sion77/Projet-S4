<?php

//retourne un tableau d'entier contenant le nombre de clients dans chaque restaurant de la base de données

/* Auteur Maxence Xavier Thomas */

function repartitionClientsResto() {	
	$nbRestau=nbTotalResto(); //On recupère le nombre de restaurant

	for($i=0; $i<$nbRestau; $i++){  // pour chaque ID restaurant
		$tabNbClientResto[i]=nbClientsResto($i);  // on récupère son nombre de clients via la fonction nbClientsResto
	}
	
	return $tabNbClientResto;  // on retourne le tableau
}

?>
