<?php
	/* Met � jour la note d'un menu � partir des plats qui le composent dans la base de donn�es et la renvoie
	* Auteur Julien
	*/
	function noteMenu($unMenu) {
		$idConnexion = connexionDB();
		
		// On r�cup�re la note de l'entr�e du menu.
		$requete1 = mysql_query("SELECT note FROM mesplats MP, menu M WHERE num = entree AND M.id = " . $unMenu, $idConnexion);
		// On r�cup�re la note du plat principal du menu.
		$requete1 = mysql_query("SELECT note FROM mesplats MP, menu M WHERE num = plat AND M.id = " . $unMenu, $idConnexion);
		// On r�cup�re la note du dessert du menu.
		$requete1 = mysql_query("SELECT note FROM mesplats MP, menu M WHERE num = dessert AND M.id = " . $unMenu, $idConnexion);
		
		if (!$requete1)
			die("Requete invalide :" . mysql_error);
		else {
			$noteEntree = mysql_fetch_row($requete1);
		}
		
		if (!$requete2)
			die("Requete invalide :" . mysql_error);
		else {
			$notePlat = mysql_fetch_row($requete2);
		}
		
		if (!$requete3)
			die("Requete invalide :" . mysql_error);
		else {
			$noteDessert = mysql_fetch_row($requete3);
		}
		
		//Simple calcul de moyenne
		$moy = $noteEntree + $notePlat + $noteDessert;
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