<?php
	/* Crée un plat dans la table mesplats, lui donne une note et la renvoie
	* Auteur Julien
	*/
	function notePlat($unPlat) {
		$moy = 0;
		$cpt = 0;
		
		// Etapes de connexion avec vérifications
		$idConnexion = mysql_connect('localhost', 'root', '');
		if(!$idConnexion)
			echo "Attention : problème de connexion avec le serveur.";
		else {
			$connexionReussie = mysql_select_db('restaugame', $idConnexion);
			if(!$connexionReussie)
				echo "Attention : problème de connexion à la base de données.";
		
			// On récupère les notes des ingrédients employés dans le plat.
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
					die("Requête invalide : " . mysql_error());
			
				//Retourne la note
				return $moy;
			}
		}
	}
?>