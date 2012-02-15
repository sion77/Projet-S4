<?php

//retourne un tableau d'entier contenant le nombre de clients dans chaque restaurant de la base de données
function repartitionClientsResto() {	
	$result = $co-> query ('SELECT id FROM restaurant');
	while ($row = $result->fetch()) {
		nbClientsResto($row['id']);  // on récupère son nombre de clients via la fonction nbClientsResto
	}
	$result->closeCursor(); // Termine le traitement de la requete
}

?>