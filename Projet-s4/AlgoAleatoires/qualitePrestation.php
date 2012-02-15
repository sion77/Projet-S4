<?php
	/* Met à jour la qualité de la prestation d'un salarie
	* Auteur Julien
	*/
	function qualitePrestation($unSalarie) {
		$salaire = 0;
		//Le salaire de référence est une variable qui est utilisé pour relativiser le salaire de l'employé par rapport au restaurant dans lequel il travaille.
		$salaireReference = 0;
		$moy = 0;
		$idConnexion = connexionDB();
		
		//Requête qui récupère l'id du restaurant de l'employé
		$result = mysql_query("SELECT idRestaurant FROM employe WHERE id = " . $unSalarie, $idConnexion);
		//Requête qui récupère le salaire de l'employé
		$result2 = mysql_query("SELECT salaire FROM employe WHERE id = " . $unSalarie, $idConnexion);
		
		if(!$result)
			die("Requête invalide : " . mysql_error());
		else {
			while ($row = mysql_fetch_row()) {
				//On récupère la moyenne des menus du restaurant
				$moy = moyenneMenu($row[0]);
				
				//Détermination d'un salaire de référence en fonction du "standing" des menus du restaurant
				if ($moy < 2.5)
					$salaireReference = 1000;
				else if ($moy >= 2.5 && $note < 5)
					$salaireReference = 1300;
				else if ($moy >= 5 && $note < 7.5)
					$salaireReference = 1600;
				else
					$salaireReference = 2000;
			}
		}
		if(!$result2)
			die("Requête invalide : " . mysql_error());
		else
			while ($row2 = mysql_fetch_row()) {
				$salaire = $row2[0];
			}
		}
		
		//Détermination du minimum et du maximum pour le pourboire
		$minPourboire = 100 * ($moy/10);
		$maxPourboire = 200 * ($moy/10);
		//Détermination aléatoire du pourboire
		$bonusPourboire = rand($minPourboire, $maxPourboire);
		
		//Formule potentielle de la qualité de la prestation (temporaire)
		$n = ($salaire + $bonusPourboire) / $salaireReference;
		
		//Mise à jour dans la table employe
		$maj = mysql_query("UPDATE employe SET qualitePrestation = " . $n . " WHERE id = " $unSalarie, $idConnexion);
		if(!$maj)
			die("Requête invalide : " . mysql_error());
	}
?>