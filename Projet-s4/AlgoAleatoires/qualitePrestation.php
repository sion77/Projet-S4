<?php
	/* Met à jour la qualité de la prestation d'un salarie
	* Auteur Julien
	*/
	function qualitePrestation($unSalarie) {
		$salaire = 0;
		//Le salaire de référence est une variable qui est utilisé pour relativiser le salaire de l'employé par rapport au restaurant dans lequel il travaille.
		$salaireReference = 0;
		$moy = 0;
		$qualitePrestation = 0.7;
		$idConnexion = connexionDB();
		
		//Requête qui récupère l'id du restaurant de l'employé
		$requete = mysql_query("SELECT idRestaurant FROM employe WHERE id = " . $unSalarie, $idConnexion);
		//Requête qui récupère le salaire de l'employé
		$requete2 = mysql_query("SELECT salaire FROM employe WHERE id = " . $unSalarie, $idConnexion);
		
		if(!$requete)
			die("Requête invalide : " . mysql_error());
		else {
			//On récupère la moyenne des menus du restaurant
			$moy = mysql_fetch_row($requete);
				
			//Détermination d'un salaire de référence en fonction du "standing" des menus du restaurant
			if ($moy <= 2)
				$salaireReference = 1000;
			else if ($moy > 2 && $qualitePrestationote <= 4)
				$salaireReference = 1300;
			else if ($moy > 4 && $qualitePrestationote <= 8)
				$salaireReference = 1600;
			else
				$salaireReference = 2000;
		}
		if(!$requete)
			die("Requête invalide : " . mysql_error());
		else
			$salaire = mysql_fetch_row($requete2);
		}
		
		//Détermination du minimum et du maximum pour le pourboire
		$minPourboire = 100 * ($moy/10);
		$maxPourboire = 200 * ($moy/10);
		//Détermination aléatoire du pourboire
		$bonusPourboire = rand($minPourboire, $maxPourboire);
		
		//Calculs successifs du coefficient. L'efficacité du salaire diminue à chaque intervalle.
		//Premier intervalle : Grande efficacité et on comble facilement le malus.
		if ($moy > 2)
			$qualitePrestation = (($salaire + $bonusPourboire) / ($salaireReference * 5)) + $qualitePrestation;
		if ($moy > 4)
			$qualitePrestation = (($salaire + $bonusPourboire) / ($salaireReference * 10)) + $qualitePrestation;
		if ($moy > 6)
			$qualitePrestation = (($salaire + $bonusPourboire) / ($salaireReference * 15)) + $qualitePrestation;
		//Dernier intervalle : Efficacité limitée mais toujours existante
		if ($moy > 8)
			$qualitePrestation = (($salaire + $bonusPourboire) / ($salaireReference * 30)) + $qualitePrestation;
		
		//Mise à jour dans la table employe
		$maj = mysql_query("UPDATE employe SET qualitePrestation = " . $qualitePrestation . " WHERE id = " $unSalarie, $idConnexion);
		if(!$maj)
			die("Requête invalide : " . mysql_error());
	}
?>