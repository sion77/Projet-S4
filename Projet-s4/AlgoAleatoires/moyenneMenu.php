<?php
	/* Calcule la moyenne des notes des menus propos�s par un restaurant
	* Auteur Julien
	* (Devenu inutile depuis le retrait des notes des menus)
	*/
	function moyenneMenu($unResto) {
		$moy = 0;
		$cpt = 0;
		//Connexion � la base de donn�es
		$idConnexion = connexionDB();
		
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
?>