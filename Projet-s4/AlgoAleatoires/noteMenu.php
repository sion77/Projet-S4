<?php
	/* Crée un menu dans la table menu, lui donne une note et la renvoie
	* Auteur Julien
	*/
	function noteMenu($unMenu) {
		// Etapes de connexion avec vérifications
		$idConnexion = mysql_connect('localhost', 'root', '');
		if(!$idConnexion)
			echo "Attention : problème de connexion avec le serveur.";
		else {
			$connexionReussie = mysql_select_db('restaugame', $idConnexion);
			if(!$connexionReussie)
				echo "Attention : problème de connexion à la base de données.";
		
			// On récupère la note de l'entrée du menu.
			$requete1 = mysql_query("SELECT note FROM mesplats MP, menu M WHERE num = entree AND M.id = " . $unMenu, $idConnexion);
			// On récupère la note du plat principal du menu.
			$requete2 = mysql_query("SELECT note FROM mesplats MP, menu M WHERE num = plat AND M.id = " . $unMenu, $idConnexion);
			// On récupère la note du dessert du menu.
			$requete3 = mysql_query("SELECT note FROM mesplats MP, menu M WHERE num = dessert AND M.id = " . $unMenu, $idConnexion);
			
			if (!$requete1)
				die("Requete invalide :" . mysql_error());
			else {
				$noteEntree = mysql_fetch_row($requete1);
			}
			
			if (!$requete2)
				die("Requete invalide :" . mysql_error());
			else {
				$notePlat = mysql_fetch_row($requete2);
			}
			
			if (!$requete3)
				die("Requete invalide :" . mysql_error());
			else {
				$noteDessert = mysql_fetch_row($requete3);
			}
			
			//Simple calcul de moyenne
			$moy = $noteEntree[0] + $notePlat[0] + $noteDessert[0];
			$moy = $moy / 3;
				
			//Mise à jour dans la table mesplats
			$maj = mysql_query("UPDATE menu SET note = " . $moy . " WHERE id = " . $unMenu, $idConnexion);
			if(!$maj)
				die("Requête invalide : " . mysql_error());
					
			//Retourne la note
			return $moy;
		}
	}
?>