<?php
	/* Met à jour la note d'un plat à partir de ses ingrédients dans la base de données et la renvoie
	* Auteur Julien
	*/
	function notePlat($unPlat) {
		$moy = 0;
		$cpt = 0;
		$idConnexion = connexionDB();
		
		// On récupère les notes des ingrédients employés dans le plat.
		$requete = mysql_query("SELECT note FROM ingredient I, ingredientplat IP WHERE I.idTypeIngredient = IP.idTypeIngredient AND idPlat = " . $unPlat, $idConnexion);
		if (!$requete)
			die("Requete invalide :" . mysql_error);
		else {
			//Simple calcul de moyenne
			while ($row = mysql_fetch_row()) {
				$moy = $moy + $row[0];
				$cpt = $cpt + 1;
			}
			$moy = $moy / $cpt;
			
			//Mise à jour dans la table mesplats
			$maj = mysql_query("UPDATE mesplats SET note = " . $moy . " WHERE idPlatRealisable = " $unPlat, $idConnexion);
			if(!$maj)
				die("Requête invalide : " . mysql_error());
				
			//Retourne la note
			return $moy;
		}
	}
?>