<?php
	/* Met � jour la qualit� de la prestation d'un salarie
	* Auteur Julien
	*/
	function qualitePrestation($unSalarie) {
		$salaire = 0;
		//Le salaire de r�f�rence est une variable qui est utilis� pour relativiser le salaire de l'employ� par rapport au restaurant dans lequel il travaille.
		$salaireReference = 0;
		$moy = 0;
		$idConnexion = connexionDB();
		
		//Requ�te qui r�cup�re l'id du restaurant de l'employ�
		$result = mysql_query("SELECT idRestaurant FROM employe WHERE id = " . $unSalarie, $idConnexion);
		//Requ�te qui r�cup�re le salaire de l'employ�
		$result2 = mysql_query("SELECT salaire FROM employe WHERE id = " . $unSalarie, $idConnexion);
		
		if(!$result)
			die("Requ�te invalide : " . mysql_error());
		else {
			while ($row = mysql_fetch_row()) {
				//On r�cup�re la moyenne des menus du restaurant
				$moy = moyenneMenu($row[0]);
				
				//D�termination d'un salaire de r�f�rence en fonction du "standing" des menus du restaurant
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
			die("Requ�te invalide : " . mysql_error());
		else
			while ($row2 = mysql_fetch_row()) {
				$salaire = $row2[0];
			}
		}
		
		//D�termination du minimum et du maximum pour le pourboire
		$minPourboire = 100 * ($moy/10);
		$maxPourboire = 200 * ($moy/10);
		//D�termination al�atoire du pourboire
		$bonusPourboire = rand($minPourboire, $maxPourboire);
		
		//Formule potentielle de la qualit� de la prestation (temporaire)
		$n = ($salaire + $bonusPourboire) / $salaireReference;
		
		//Mise � jour dans la table employe
		$maj = mysql_query("UPDATE employe SET qualitePrestation = " . $n . " WHERE id = " $unSalarie, $idConnexion);
		if(!$maj)
			die("Requ�te invalide : " . mysql_error());
	}
?>