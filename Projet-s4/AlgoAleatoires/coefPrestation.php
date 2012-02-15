<?php
	/* Calcule le coefficient de qualité du service dans un restaurant. Cette valeur intervient dans la note du restaurant.
	* Auteur Julien
	*/
	function coefPrestation($unResto) {
		$coefPrestation = 0;
		$cpt = 0;
		$idConnexion = connexionDB();
		
		//On récupère l'attribut qualitePrestation des salariés du restaurant concerné
		$requete = mysql_query("SELECT qualitePrestation FROM employe WHERE idRestaurant = " . $unResto, $idConnexion);
		if (!$requete)
			die("Requête invalide : " . mysql_error());
		else {
			//Simple calcul de moyenne
			while ($row = mysql_fetch_row()){
				$coefPrestation = $coefPrestation + $row[0];
				$cpt = $cpt + 1;
			}
			$coefPrestation = $coefPrestation / $cpt;
			
			return $coefPrestation;
		}
	}
?>