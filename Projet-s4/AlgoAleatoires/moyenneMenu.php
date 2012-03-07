<?php
	/* Calcule la moyenne des notes des menus proposés par un restaurant
	* Auteur Julien
	*/
	function moyenneMenu($unResto) {
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
		
			//On récupère les notes des menus proposé par le restaurant concerné
			$requete = mysql_query("SELECT note FROM menu M, menurestaurant MR WHERE M.idMenu = MR.idMenu AND idRestaurant = " . $unResto, $idConnexion);
			if(!$requete)
				die("Requête invalide : " . mysql_error());
			else {
				//Simple calcul de moyenne
				while ($row = mysql_fetch_row()) {
					$moy = $moy + $row[0];
					$cpt = $cpt + 1;
				}
				$moy = $moy / $cpt;
				
				return $moy;
			}
		}
	}
?>