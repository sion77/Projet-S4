<?php
	/* Calcule le coefficient de publicite (supérieure à 0.8) en fonction des dépenses en publicité. Cette valeur intervient dans la note du restaurant.
	* Auteur Julien
	*/
	function coefPublicite($unResto){
		//Le coefficient aura une valeur initiale pour les restaurants n'ayant pas dépensé de l'argent dans la publicité.
		//Etant inférieur à 1, il s'agit donc d'un malus si aucune communication n'est faite.
		$coefPublicite = 0.8;
		$depenses = 0;
		$idConnexion = connexionDB();
		
		//On récupère la valeur de la dépense en communication du restaurant
		$requete = mysql_query("SELECT publicite FROM restaurant WHERE id = " . $unResto, $idConnexion);
		if (!$result)
			die("Requête invalide : " . mysql_error());
		else {
			$depenses = mysql_fetch_row($requete);
			
			//Calculs successifs du coefficient. L'efficacité des dépenses en publicité diminue à chaque intervalle, jusqu'à avoir un effet limité au delà de 50 000 euros.
			//Premier intervalle : Grande efficacité et on comble facilement le malus.
			if ($depenses > 0)
				$coefPublicite = ($depenses / 40000) + $coefPublicite;
			if ($depenses > 10000)
				$coefPublicite = (($depenses - 10000) / 100000) + $coefPublicite;
			if ($depenses > 25000)
				$coefPublicite = (($depenses - 25000) / 200000) + $coefPublicite;
			//Dernier intervalle : Efficacité limitée mais toujours existante
			if ($depenses > 50000)
				$coefPublicite = (($depenses - 50000) / 1000000) + $coefPublicite;
				
			return $coefPublicite;
		}
	}
?>