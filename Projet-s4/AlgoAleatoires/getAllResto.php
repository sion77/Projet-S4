<?php
	/* Retourne un tableau contenant TOUS les restaurants
	* Auteur Julien
	*/
	function getAllResto() {
		// Etapes de connexion avec vérifications
		$idConnexion = mysql_connect('localhost', 'root', '');
		if(!$idConnexion)
			echo "Attention : problème de connexion avec le serveur.";
		else {
			$connexionReussie = mysql_select_db('restaugame', $idConnexion);
			if(!$connexionReussie)
				echo "Attention : problème de connexion à la base de données.";
				
			//On récupère tous les restaurants
			$requete = mysql_query("SELECT id FROM restaurant", $idConnexion); 
			if(!$requete)
				die("Requête invalide : " . mysql_error());
			else {
				//Création du tableau
				$lesRestos = array();
			
				//Remplissage du tableau
				while ($unResto = mysql_fetch_array($requete)) {
					$lesRestos[] = $unResto['id'];
				}
			
				return $lesRestos;
			}
		}
	}
?>