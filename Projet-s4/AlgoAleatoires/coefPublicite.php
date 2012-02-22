<?php
	/* Calcule le coefficient de publicite (supérieure à 0.8) en fonction des dépenses en publicité. Cette valeur intervient dans la note du restaurant.
	* Auteur Julien
	*/
	function coefPublicite($unResto){
		//Le coefficient aura une valeur initiale pour les restaurants n'ayant pas dépensé de l'argent dans la publicité.
		//Etant inférieur à 1, il s'agit donc d'un malus si aucune communication n'est faite.
		//Il s'agit aussi d'une valeur par défaut s'il y a une erreur dans la requête.
		$coefPublicite = 0.3;
		$depenses = 0;
		$n = 1;
		$idConnexion = connexionDB();
		
		//On récupère la valeur de la dépense en communication du restaurant
		//$requete = mysql_query("SELECT publicite FROM restaurant WHERE id = " . $unResto, $idConnexion);
		if (!$requete)
			die("Requête invalide : " . mysql_error());
		else {
			$depenses = mysql_fetch_row($requete);
						
			$coefPublicite = 0;
			//On récupère la partie entière des dépenses divisée par 100, pour déterminer l'exposant n dans la suite 1/x^n.
			$n = floor($depenses / 1000);
			
			//Calculs successifs du coefficient. L'efficacité des dépenses en publicité diminue à chaque itération de la boucle.
			for ($i = 1; $i < $n; $i++) {
				$coefPublicite = pow($depenses / (pow(2, $i) * $depenses), 1.4) + $coefPublicite;
			}
			
			return $coefPublicite;
		}
	}
?>