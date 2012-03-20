<?php
	include("_Plat.php");
	include("_Menu.php");
	include("tousLesMenusDUnResto.php");
	
	/* Retourne un tableau d'objets Menu. D�coupage possible en plusieurs fonctions pour plus de lisibilit�. 
	* Auteur Julien
	*/
	function getMenus($idResto) {
		// D�claration de certaines variables � l'ext�rieur des blocs
		$unPrix = 0;
		$objEntree = null;
		$objPlat = null;
		$objDessert = null;
		
		// R�cup�ration des id des menus d'un resto � travers une fonction pr�c�demment �crite
		$lesMenus = tousLesMenusDUnResto($idResto);

		// Etapes de connexion avec v�rifications
		$idConnexion = mysql_connect('localhost', 'root', '');
		if(!$idConnexion)
			echo "Attention : probl�me de connexion avec le serveur.";
		else {
			$connexionReussie = mysql_select_db('restaugame', $idConnexion);
			if(!$connexionReussie)
				echo "Attention : probl�me de connexion � la base de donn�es.";
		
			$tabObjMenus = array();
			// Pour tous les menus du restaurant...
			foreach ($lesMenus as $menu) {
				// on r�cup�re les attributs
				$requete = mysql_query("SELECT * FROM menu WHERE id = " . $menu, $idConnexion);
				if(!$requete)
					die("Requ�te invalide : " . mysql_error());
				else {
					if($row = mysql_fetch_array($requete)) {
						$unPrix = $row['prix'];
						$uneEntree = $row['entree'];
						$unPlat = $row['plat'];
						$unDessert = $row['dessert'];
						
						// On r�cup�re le nom de l'entr�e
						$requete1 = mysql_query("SELECT nomPlat FROM platrealisable, mesplats WHERE id = idPlatRealisable AND idPlatRealisable = " . $uneEntree, $idConnexion);
						if(!$requete1)
							die("Requ�te 1 invalide : " . mysql_error());
						else {
							if($row1 = mysql_fetch_array($requete1))
								$nomEntree = $row1['nomPlat'];
						}
						
						// On r�cup�re le nom du plat principal
						$requete2 = mysql_query("SELECT nomPlat FROM platrealisable, mesplats WHERE id = idPlatRealisable AND idPlatRealisable = " . $unPlat, $idConnexion);
						if(!$requete2)
							die("Requ�te 2 invalide : " . mysql_error());
						else {
							if($row2 = mysql_fetch_array($requete2))
								$nomPlat = $row2['nomPlat'];
						}
						
						// On r�cup�re le nom de dessert
						$requete3 = mysql_query("SELECT nomPlat FROM platrealisable, mesplats WHERE id = idPlatRealisable AND idPlatRealisable = " . $unDessert, $idConnexion);
						if(!$requete3)
							die("Requ�te 3 invalide : " . mysql_error());
						else {
							if($row3 = mysql_fetch_array($requete3))
								$nomDessert = $row3['nomPlat'];
						}
						
						// Cr�ation d'un tableau pour les id des ingr�dients de chaque plat et d'un autre pour les quantit�s entrant en vigueur dans la recette du plat
						$ingredientsEntree = array();
						$quantitesEntree = array();
						// On r�cup�re les ingr�dients et les quantit�s
						$requeteA = mysql_query("SELECT idIngredient, quantiteIngredient FROM mesingredientplat MIP, ingredientplat IP WHERE MIP.idPlat = IP.idPlat AND MIP.idPlat = " . $uneEntree, $idConnexion);
						if(!$requeteA)
							die("Requ�te A invalide : " . mysql_error());
						else {
							while($rowA = mysql_fetch_array($requeteA)) {
								$ingredientsEntree[] = $rowA['idIngredient'];
								$quantitesEntree[] = $rowA['quantiteIngredient'];
							}
						}
						
						$ingredientsPlat = array();
						$quantitesPlat = array();
						$requeteB = mysql_query("SELECT idIngredient, quantiteIngredient FROM mesingredientplat MIP, ingredientplat IP WHERE MIP.idPlat = IP.idPlat AND MIP.idPlat = " . $unPlat, $idConnexion);
						if(!$requeteB)
							die("Requ�te B invalide : " . mysql_error());
						else {
							while($rowB = mysql_fetch_array($requeteB)) {
								$ingredientsPlat[] = $rowB['idIngredient'];
								$quantitesPlat[] = $rowB['quantiteIngredient'];
							}
						}
						
						$ingredientsDessert = array();
						$quantitesDessert = array();
						$requeteC = mysql_query("SELECT idIngredient, quantiteIngredient FROM mesingredientplat MIP, ingredientplat IP WHERE MIP.idPlat = IP.idPlat AND MIP.idPlat = " . $unDessert, $idConnexion);
						if(!$requeteC)
							die("Requ�te C invalide : " . mysql_error());
						else {
							while($rowC = mysql_fetch_array($requeteC)) {
								$ingredientsDessert[] = $rowC['idIngredient'];
								$quantitesDessert[] = $rowC['quantiteIngredient'];
							}
						}
						
						// Initialisation des objets
						$objEntree = new Plat($uneEntree, $nomEntree, $ingredientsEntree, $quantitesEntree);
						$objPlat = new Plat($unPlat, $nomPlat, $ingredientsPlat, $quantitesPlat);
						$objDessert = new Plat($unDessert, $nomDessert, $ingredientsDessert, $quantitesDessert);
						
						// Lib�ration des r�sultats des requ�tes successives
						mysql_free_result($requete1);
						mysql_free_result($requete2);
						mysql_free_result($requete3);
						mysql_free_result($requeteA);
						mysql_free_result($requeteB);
						mysql_free_result($requeteC);
					}
					
					// Remplissage du tableau d'objets Menu
					$tabObjMenus[] = new Menu($menu, $unPrix, $objEntree, $objPlat, $objDessert);
				}
				
				// Lib�ration des r�sultats de la requ�te sur un menu
				mysql_free_result($requete);
			}
			return $tabObjMenus;
		}
	}
?>