<?php
	/* Cr�e un menu dans la table menu, lui donne une note et la renvoie
	* Auteur Julien
	*/
	function noteMenu($unMenu) {
		// Etapes de connexion avec v�rifications
		$idConnexion = mysql_connect('localhost', 'root', '');
		if(!$idConnexion)
			echo "Attention : probl�me de connexion avec le serveur.";
		else {
			$connexionReussie = mysql_select_db('restaugame', $idConnexion);
			if(!$connexionReussie)
				echo "Attention : probl�me de connexion � la base de donn�es.";
		
			// On r�cup�re la note de l'entr�e du menu.
			$requete1 = mysql_query("SELECT note FROM mesplats MP, menu M WHERE num = entree AND M.id = " . $unMenu, $idConnexion);
			// On r�cup�re la note du plat principal du menu.
			$requete2 = mysql_query("SELECT note FROM mesplats MP, menu M WHERE num = plat AND M.id = " . $unMenu, $idConnexion);
			// On r�cup�re la note du dessert du menu.
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
				
			//Mise � jour dans la table mesplats
			$maj = mysql_query("UPDATE menu SET note = " . $moy . " WHERE id = " . $unMenu, $idConnexion);
			if(!$maj)
				die("Requ�te invalide : " . mysql_error());
					
			//Retourne la note
			return $moy;
		}
	}
?>