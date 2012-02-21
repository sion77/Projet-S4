<?php
	/* Calcule la note sur dix du restaurant en fonction de paramètres comme la publicité, la prestation du service, ou la qualité des menus.
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
		
		return note;
	}
?>