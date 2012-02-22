<?php
	/* Met à jour la qualité de la prestation d'un salarie
	* Auteur Julien
	*/
	function qualitePrestation($unSalarie) {
		$salaire = 0;
		$moy = 0;
		$qualitePrestation = 0.8;
		$idConnexion = connexionDB();
		
		//Requête qui récupère l'id du restaurant de l'employé
		$requete = mysql_query("SELECT idRestaurant FROM employe WHERE id = " . $unSalarie, $idConnexion);
		//Requête qui récupère le salaire de l'employé
		$requete2 = mysql_query("SELECT salaire FROM employe WHERE id = " . $unSalarie, $idConnexion);
		
		if(!$requete)
			die("Requête invalide : " . mysql_error());
		else {
			//On récupère la moyenne des menus du restaurant
			$leResto = mysql_fetch_row($requete);
			$moy = moyenneMenu($leResto);
				
		}
		if(!$requete2)
			die("Requête invalide : " . mysql_error());
		else
			$salaire = mysql_fetch_row($requete2);
		}
		
		//Détermination du minimum et du maximum pour le pourboire
		$minPourboire = 100 * ($moy/10);
		$maxPourboire = 200 * ($moy/10);
		//Détermination aléatoire du pourboire
		$bonusPourboire = rand($minPourboire, $maxPourboire);
		
		$qualitePrestation = 0;
		//On récupère la partie entière du salaire divisé par 100, pour déterminer l'exposant n dans la suite 1/x^n.
		$n = floor($salaire / 100);
		
		//Calculs successifs du coefficient. L'efficacité de la prestation du salarié diminue à chaque itération de la boucle.
		for ($i = 1; $i < $n; $i++) {
			$qualitePrestation = pow($salaire / (pow(2, $i) * $salaire), 1.4) + $qualitePrestation;
		}
		
		//Mise à jour dans la table employe
		$maj = mysql_query("UPDATE employe SET qualitePrestation = " . $qualitePrestation . " WHERE id = " $unSalarie, $idConnexion);
		if(!$maj)
			die("Requête invalide : " . mysql_error());
	}
?>