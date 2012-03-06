<?php
	/* Calcule la moyenne des notes des menus proposés par un restaurant
	* Auteur Julien
	* (Devenu inutile depuis le retrait des notes des menus)
	*/
	function moyenneMenu($unResto) {
		$moy = 0;
		$cpt = 0;
		//Connexion à la base de données
		$idConnexion = connexionDB();
		
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
?>