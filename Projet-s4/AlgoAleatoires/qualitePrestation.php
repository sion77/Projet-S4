<?php
	/* Met � jour la qualit� de la prestation d'un salarie
	* Auteur Julien
	*/
	function qualitePrestation($unSalarie) {
		$salaire = 0;
		$qualitePrestation = 0.5;
		$idConnexion = connexionDB();
		
		//Requ�te qui r�cup�re le salaire de l'employ�
		$requete2 = mysql_query("SELECT salaire FROM employe WHERE id = " . $unSalarie, $idConnexion);
		
		if(!$requete2)
			die("Requ�te invalide : " . mysql_error());
		else
			$salaire = mysql_fetch_row($requete2);
		}
		
		//D�termination du minimum et du maximum pour le pourboire
		$minPourboire = 100 * ($moy/10);
		$maxPourboire = 200 * ($moy/10);
		//D�termination al�atoire du pourboire
		$bonusPourboire = rand($minPourboire, $maxPourboire);
		
		$qualitePrestation = 0;
		//On r�cup�re la partie enti�re du salaire divis� par 100, pour d�terminer la puissance n dans la suite 1/2^n.
		$n = floor($salaire / 100);
		
		//Calculs successifs du coefficient. L'efficacit� de la prestation du salari� diminue � chaque it�ration de la boucle.
		for ($i = 1; $i < $n; $i++) {
			$qualitePrestation = pow($salaire / (pow(2, $i) * $salaire), 1.4) + $qualitePrestation;
		}
		
		//Mise � jour dans la table employe
		$maj = mysql_query("UPDATE employe SET qualitePrestation = " . $qualitePrestation . " WHERE id = " $unSalarie, $idConnexion);
		if(!$maj)
			die("Requ�te invalide : " . mysql_error());
	}
?>