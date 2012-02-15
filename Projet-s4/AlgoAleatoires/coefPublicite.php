<?php
	/* Calcule le coefficient de publicite (sup�rieure � 0.8) en fonction des d�penses en publicit�. Cette valeur intervient dans la note du restaurant.
	* Auteur Julien
	*/
	function coefPublicite($unResto){
		//Le coefficient aura une valeur initiale pour les restaurants n'ayant pas d�pens� de l'argent dans la publicit�.
		//Etant inf�rieur � 1, il s'agit donc d'un malus si aucune communication n'est faite.
		$coefPublicite = 0.8;
		$depenses = 0;
		$idConnexion = connexionDB();
		
		//On r�cup�re la valeur de la d�pense en communication du restaurant
		$requete = mysql_query("SELECT publicite FROM restaurant WHERE id = " . $unResto, $idConnexion);
		if (!$result)
			die("Requ�te invalide : " . mysql_error());
		else {
			$depenses = mysql_fetch_row($requete);
			
			//Calculs successifs du coefficient. L'efficacit� des d�penses en publicit� diminue � chaque intervalle, jusqu'� avoir un effet limit� au del� de 50 000 euros.
			//Premier intervalle : Grande efficacit� et on comble facilement le malus.
			if ($depenses > 0)
				$coefPublicite = ($depenses / 40000) + $coefPublicite;
			if ($depenses > 10000)
				$coefPublicite = (($depenses - 10000) / 100000) + $coefPublicite;
			if ($depenses > 25000)
				$coefPublicite = (($depenses - 25000) / 200000) + $coefPublicite;
			//Dernier intervalle : Efficacit� limit�e mais toujours existante
			if ($depenses > 50000)
				$coefPublicite = (($depenses - 50000) / 1000000) + $coefPublicite;
				
			return $coefPublicite;
		}
	}
?>