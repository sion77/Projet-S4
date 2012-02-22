<?php
	/* Calcule le coefficient de publicite (sup�rieure � 0.8) en fonction des d�penses en publicit�. Cette valeur intervient dans la note du restaurant.
	* Auteur Julien
	*/
	function coefPublicite($unResto){
		//Le coefficient aura une valeur initiale pour les restaurants n'ayant pas d�pens� de l'argent dans la publicit�.
		//Etant inf�rieur � 1, il s'agit donc d'un malus si aucune communication n'est faite.
		//Il s'agit aussi d'une valeur par d�faut s'il y a une erreur dans la requ�te.
		$coefPublicite = 0.3;
		$depenses = 0;
		$n = 1;
		$idConnexion = connexionDB();
		
		//On r�cup�re la valeur de la d�pense en communication du restaurant
		//$requete = mysql_query("SELECT publicite FROM restaurant WHERE id = " . $unResto, $idConnexion);
		if (!$requete)
			die("Requ�te invalide : " . mysql_error());
		else {
			$depenses = mysql_fetch_row($requete);
						
			$coefPublicite = 0;
			//On r�cup�re la partie enti�re des d�penses divis�e par 100, pour d�terminer l'exposant n dans la suite 1/x^n.
			$n = floor($depenses / 1000);
			
			//Calculs successifs du coefficient. L'efficacit� des d�penses en publicit� diminue � chaque it�ration de la boucle.
			for ($i = 1; $i < $n; $i++) {
				$coefPublicite = pow($depenses / (pow(2, $i) * $depenses), 1.4) + $coefPublicite;
			}
			
			return $coefPublicite;
		}
	}
?>