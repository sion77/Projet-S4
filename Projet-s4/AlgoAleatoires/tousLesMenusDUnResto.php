<?php
	/* Renvoie un tableau contenant les menus d'un restaurant
	* Auteur Julien
	*/
	function tousLesMenusDUnResto($unResto) {
		//Connexion � la base de donn�es
		$idConnexion = connexionDB();
		
		$requete = mysql_query("SELECT idMenu FROM menurestaurant WHERE idRestaurant = " . $unResto, $idConnexion);
		if(!requete)
			die("Requ�te invalide : " . mysql_error());
		else {
			//Cr�ation du tableau
			$lesMenus = array();
			
			//Remplissage du tableau
			while ($unMenu = mysql_fetch_array($requete)) {
				$lesMenus[] = $unMenu['idMenu'];
			}
			
			return $lesMenus;
		}
	}
?>
				