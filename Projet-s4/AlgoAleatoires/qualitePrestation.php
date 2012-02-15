<?php
	/* Met � jour la qualit� de la prestation d'un salarie
	* Auteur Julien
	*/
	function qualitePrestation($unSalarie) {
		$salaire = 0;
		//Le salaire de r�f�rence est une variable qui est utilis� pour relativiser le salaire de l'employ� par rapport au restaurant dans lequel il travaille.
		$salaireReference = 0;
		$moy = 0;
		$qualitePrestation = 0.7;
		$idConnexion = connexionDB();
		
		//Requ�te qui r�cup�re l'id du restaurant de l'employ�
		$requete = mysql_query("SELECT idRestaurant FROM employe WHERE id = " . $unSalarie, $idConnexion);
		//Requ�te qui r�cup�re le salaire de l'employ�
		$requete2 = mysql_query("SELECT salaire FROM employe WHERE id = " . $unSalarie, $idConnexion);
		
		if(!$requete)
			die("Requ�te invalide : " . mysql_error());
		else {
			//On r�cup�re la moyenne des menus du restaurant
			$moy = mysql_fetch_row($requete);
				
			//D�termination d'un salaire de r�f�rence en fonction du "standing" des menus du restaurant
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
			die("Requ�te invalide : " . mysql_error());
		else
			$salaire = mysql_fetch_row($requete2);
		}
		
		//D�termination du minimum et du maximum pour le pourboire
		$minPourboire = 100 * ($moy/10);
		$maxPourboire = 200 * ($moy/10);
		//D�termination al�atoire du pourboire
		$bonusPourboire = rand($minPourboire, $maxPourboire);
		
		//Calculs successifs du coefficient. L'efficacit� du salaire diminue � chaque intervalle.
		//Premier intervalle : Grande efficacit� et on comble facilement le malus.
		if ($moy > 2)
			$qualitePrestation = (($salaire + $bonusPourboire) / ($salaireReference * 5)) + $qualitePrestation;
		if ($moy > 4)
			$qualitePrestation = (($salaire + $bonusPourboire) / ($salaireReference * 10)) + $qualitePrestation;
		if ($moy > 6)
			$qualitePrestation = (($salaire + $bonusPourboire) / ($salaireReference * 15)) + $qualitePrestation;
		//Dernier intervalle : Efficacit� limit�e mais toujours existante
		if ($moy > 8)
			$qualitePrestation = (($salaire + $bonusPourboire) / ($salaireReference * 30)) + $qualitePrestation;
		
		//Mise � jour dans la table employe
		$maj = mysql_query("UPDATE employe SET qualitePrestation = " . $qualitePrestation . " WHERE id = " $unSalarie, $idConnexion);
		if(!$maj)
			die("Requ�te invalide : " . mysql_error());
	}
?>