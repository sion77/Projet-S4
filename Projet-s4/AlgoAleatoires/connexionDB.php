<?php
	//Constantes
	define ('HOST', 'localhost');
	define ('USER', 'root');
	define ('PASSWORD', '');
	define ('DB', 'restaugame');
	
	/* Connexion � la base de donn�es. Renvoie l'id de connexion.
	* Auteur Julien
	*/
	function connexionDB() {
		//Connexion au serveur
		$idConnexion = mysql_connect(HOST, USER, PASSWORD);
		
		if(!$idConnexion)
			//En cas d'erreur avec le serveur
			echo "Attention : probl�me de connexion avec le serveur.";
		else {
			//Connexion � la base de donn�es
			$connexionReussie = mysql_select_db(DB, $idConnexion);
			
			if(!$connexionReussie)
				//En cas d'erreur avec la base de donn�es
				echo "Attention : probl�me de connexion � la base de donn�es.";
				
			return $idConnexion;
		}
	}
?>