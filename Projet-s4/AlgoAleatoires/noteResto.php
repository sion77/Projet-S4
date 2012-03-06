<?php
	/* Met à jour la note sur dix du restaurant en fonction de paramètres comme la publicité, la prestation du service, ou la qualité des menus. Retourne aussi la valeur
	* Auteur Julien
	*/
	function noteResto($unResto) {
		//Déclaration et initialisation des variables par sécurité
		$note = 0;
		$prestation = 0;
		$publicite = 0;
		
		//On récupère la moyenne des notes des menus et les coefficients
		$moyenneMenu = moyenneMenu($unResto);
		$prestation = coefPrestation($unResto);
		$publicite = coefPublicite($unResto);
		
		//Simple multiplication. La moyenne étant sur dix, elle restera inférieure à dix si elle est multipliée par des coefficients inférieures à 1.
		$note = $moyenneMenu * $Prestation * $Publicite;
		
		//Mise à jour dans la table restaurant
		$maj = mysql_query("UPDATE restaurant SET noteRestaurant = " . $note . " WHERE idPlatRealisable = " $unResto, $idConnexion);
		if(!$maj)
			die("Requête invalide : " . mysql_error());
				
		//Retourne la note
		return note;
	}
?>