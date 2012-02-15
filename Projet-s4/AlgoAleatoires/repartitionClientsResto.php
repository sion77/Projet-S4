<?php

//retourne un tableau d'entier contenant le nombre de clients dans chaque restaurant de la base de données
function repartitionClientsResto() {	
	$result = mysql_query ("SELECT id FROM restaurant");
	while ($row = mysql_fetch_object ($result)) {
		nbClientsResto($row[0]);  // on récupère son nombre de clients via la fonction nbClientsResto
	}
}

?>