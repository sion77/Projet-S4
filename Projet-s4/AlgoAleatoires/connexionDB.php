<?php
	//Constantes
	define ('HOST', 'localhost');
	define ('USER', 'root');
	define ('PASSWORD', '');
	define ('DB', 'restaugame');
	
	/* Connexion à la base de données. Renvoie l'id de connexion.
	* Auteur Julien
	*/
	function connexionDB() {
		//Connexion au serveur
		$idConnexion = mysql_connect(HOST, USER, PASSWORD);
		
		if(!$idConnexion)
			//En cas d'erreur avec le serveur
			echo "Attention : problème de connexion avec le serveur.";
		else {
			//Connexion à la base de données
			$connexionReussie = mysql_select_db(DB, $idConnexion);
			
			if(!$connexionReussie)
				//En cas d'erreur avec la base de données
				echo "Attention : problème de connexion à la base de données.";
				
			return $idConnexion;
		}
	}
?>