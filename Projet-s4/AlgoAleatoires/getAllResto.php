<?php
	/* Retourne un tableau contenant TOUS les restaurants
	* Auteur Julien
	*/
	function getAllResto() {
		// Etapes de connexion avec v�rifications
		$idConnexion = mysql_connect('localhost', 'root', '');
		if(!$idConnexion)
			echo "Attention : probl�me de connexion avec le serveur.";
		else {
			$connexionReussie = mysql_select_db('restaugame', $idConnexion);
			if(!$connexionReussie)
				echo "Attention : probl�me de connexion � la base de donn�es.";
				
			//On r�cup�re tous les restaurants
			$requete = mysql_query("SELECT id FROM restaurant", $idConnexion); 
			if(!$requete)
				die("Requ�te invalide : " . mysql_error());
			else {
				//Cr�ation du tableau
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