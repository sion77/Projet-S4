<?php
	/* Calcule la moyenne des notes des menus propos�s par un restaurant
	* Auteur Julien
	*/
	function moyenneMenu($unResto) {
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
		
			//On r�cup�re les notes des menus propos� par le restaurant concern�
			$requete = mysql_query("SELECT note FROM menu M, menurestaurant MR WHERE M.idMenu = MR.idMenu AND idRestaurant = " . $unResto, $idConnexion);
			if(!$requete)
				die("Requ�te invalide : " . mysql_error());
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