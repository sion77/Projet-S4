<?php
	/* Calcule le coefficient de qualit� du service dans un restaurant. Cette valeur intervient dans la note du restaurant.
	* Auteur Julien
	*/
	function coefPrestation($unResto) {
		$coefPrestation = 0;
		$cpt = 0;
		
		// Etapes de connexion avec v�rifications
		$idConnexion = mysql_connect('localhost', 'root', '');
		if(!$idConnexion)
			echo "Attention : probl�me de connexion avec le serveur.";
		else {
			$connexionReussie = mysql_select_db('restaugame', $idConnexion);
			if(!$connexionReussie)
				echo "Attention : probl�me de connexion � la base de donn�es.";
		
			//On r�cup�re l'attribut qualitePrestation des salari�s du restaurant concern�
			$requete = mysql_query("SELECT qualitePrestation FROM employe WHERE idRestaurant = " . $unResto, $idConnexion);
			if (!$requete)
				die("Requ�te invalide : " . mysql_error());
			else {
				//Simple calcul de moyenne
				while ($row = mysql_fetch_row()){
					$coefPrestation = $coefPrestation + $row[0];
					$cpt = $cpt + 1;
				}
				$coefPrestation = $coefPrestation / $cpt;
				
				return $coefPrestation;
			}
		}
	}
?>