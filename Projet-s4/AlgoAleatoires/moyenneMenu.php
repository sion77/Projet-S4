<?php
	/* Calcule la moyenne des notes des menus propos�s par un restaurant
	* Auteur Julien
	*/
	function moyenneMenu($unResto) {
		$moy = 0;
		$cpt = 0;
		//Connexion � la base de donn�es
		$idConnexion = connexionDB();
		
		//On r�cup�re les notes des menus propos� par le restaurant concern�
		$result = mysql_query("SELECT note FROM menu M, menuProp MP WHERE M.idMenu = MP.idMenu AND idRestaurant = " . $unResto, $idConnexion);
		if(!$result)
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