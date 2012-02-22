<?php
	/* Renvoie un tableau contenant les menus d'un restaurant
	* Auteur Julien
	*/
	function tousLesMenusDUnResto($unResto) {
		//Connexion à la base de données
		$idConnexion = connexionDB();
		
		$requete = mysql_query("SELECT idMenu FROM menurestaurant WHERE idRestaurant = " . $unResto, $idConnexion);
		if(!requete)
			die("Requête invalide : " . mysql_error());
		else {
			//Création du tableau
			$lesMenus = array();
			
			//Remplissage du tableau
			while ($unMenu = mysql_fetch_array($requete)) {
				$lesMenus[] = $unMenu['idMenu'];
			}
			
			return $lesMenus;
		}
	}
?>
				