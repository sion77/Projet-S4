<?php
	/* Renvoie un tableau contenant tous les menus proposé par un restaurant
	* Auteur Julien
	*/
	function tousLesMenusDUnResto($unResto) {
		// Etapes de connexion avec vérifications
		$idConnexion = mysql_connect('localhost', 'root', '');
		if(!$idConnexion)
			echo "Attention : problème de connexion avec le serveur.";
		else {
			$connexionReussie = mysql_select_db('restaugame', $idConnexion);
			if(!$connexionReussie)
				echo "Attention : problème de connexion � la base de donn�es.";
		
			$requete = mysql_query("SELECT idMenu FROM menurestaurant WHERE idRestaurant = " . $unResto, $idConnexion);
			if(!$requete)
				die("Requ�te invalide : " . mysql_error());
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
	}
?>
				