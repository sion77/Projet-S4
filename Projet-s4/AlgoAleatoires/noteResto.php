<?php
	/* Calcule la note sur dix du restaurant en fonction de param�tres comme la publicit�, la prestation du service, ou la qualit� des menus.
	* Auteur Julien
	*/
	function noteResto($unResto) {
		//D�claration et initialisation des variables par s�curit�
		$note = 0;
		$prestation = 0;
		$publicite = 0;
		
		//On r�cup�re la moyenne des notes des menus et les coefficients
		$moyenneMenu = moyenneMenu($unResto);
		$prestation = coefPrestation($unResto);
		$publicite = coefPublicite($unResto);
		
		//Simple multiplication. La moyenne �tant sur dix, elle restera inf�rieure � dix si elle est multipli�e par des coefficients inf�rieures � 1.
		$note = $moyenneMenu * $Prestation * $Publicite;
		
		return note;
	}
?>