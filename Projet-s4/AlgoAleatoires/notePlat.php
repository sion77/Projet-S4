<?php
	/* Calcule la note d'un plat à partir de ses ingrédients
	* Auteur Julien
	*/
	function notePlat($idPlat) {
		$moy = 0;
		$cpt = 0;
		$idConnexion = connexionDB();
		
		// On récupère les notes des ingrédients employés dans le plat.
		$requete = mysql_query("SELECT note FROM ingredient I, ingredientplat IP WHERE I.idTypeIngredient = IP.idTypeIngredient AND idPlat = " . $idPlat, $idConnexion);
		if (!$requete)
			die("Requete invalide :" . mysql_error);
		else {
			//Simple calcul de moyenne
			while ($row = mysql_fetch_row()) {
				$moy = $moy + $row[0];
				$cpt = $cpt + 1;
			}
			$moy = $moy / $cpt;
			
			return $moy;
		}
	}
?>