<?php
	/* Met � jour la note d'un plat � partir de ses ingr�dients dans la base de donn�es et la renvoie
	* Auteur Julien
	*/
	function notePlat($unPlat) {
		$moy = 0;
		$cpt = 0;
		$idConnexion = connexionDB();
		
		// On r�cup�re les notes des ingr�dients employ�s dans le plat.
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
			
			//Mise � jour dans la table mesplats
			$maj = mysql_query("UPDATE mesplats SET note = " . $moy . " WHERE idPlatRealisable = " $unPlat, $idConnexion);
			if(!$maj)
				die("Requ�te invalide : " . mysql_error());
				
			//Retourne la note
			return $moy;
		}
	}
?>