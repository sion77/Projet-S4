<?php
	/* Cr�e un plat dans la table mesplats, lui donne une note et la renvoie
	* Auteur Julien
	*/
	function notePlat($unPlat) {
		$moy = 0;
		$cpt = 0;
		
		// Etapes de connexion avec v�rifications
		$idConnexion = mysql_connect('localhost', 'root', '');
		if(!$idConnexion)
			echo "Attention : probl�me de connexion avec le serveur.";
		else {
			$connexionReussie = mysql_select_db('restaugame', $idConnexion);
			if(!$connexionReussie)
				echo "Attention : probl�me de connexion � la base de donn�es.";
		
			// On r�cup�re les notes des ingr�dients employ�s dans le plat.
			$requete = mysql_query("SELECT note FROM ingredient I, ingredientplat IP WHERE I.idTypeIngredient = IP.idTypeIngredient AND idPlat = " . $unPlat, $idConnexion);
			if (!$requete)
				die("Requete invalide :" . mysql_error());
			else {
				//Simple calcul de moyenne
				while ($row = mysql_fetch_row($requete)) {
					$moy = $moy + $row[0];
					$cpt = $cpt + 1;
				}
				$moy = $moy / $cpt;
			
				//Ajout du nouveau plat et de sa note dans la table mesplats
				$maj = mysql_query("INSERT INTO mesplats (num, idPlatRealisable, note) VALUES (" . $unPlat . ", " . $unPlat . ", " . $moy . ")", $idConnexion);
				if(!$maj)
					die("Requ�te invalide : " . mysql_error());
			
				//Retourne la note
				return $moy;
			}
		}
	}
?>