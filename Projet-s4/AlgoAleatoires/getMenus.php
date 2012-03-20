<?php
	include("_Plat.php");
	include("_Menu.php");
	include("tousLesMenusDUnResto.php");
	
	/* Retourne un tableau d'objets Menu. Découpage possible en plusieurs fonctions pour plus de lisibilité. 
	* Auteur Julien
	*/
	function getMenus($idResto) {
		// Déclaration de certaines variables à l'extérieur des blocs
		$unPrix = 0;
		$objEntree = null;
		$objPlat = null;
		$objDessert = null;
		
		// Récupération des id des menus d'un resto à travers une fonction précédemment écrite
		$lesMenus = tousLesMenusDUnResto($idResto);

		// Etapes de connexion avec vérifications
		$idConnexion = mysql_connect('localhost', 'root', '');
		if(!$idConnexion)
			echo "Attention : problème de connexion avec le serveur.";
		else {
			$connexionReussie = mysql_select_db('restaugame', $idConnexion);
			if(!$connexionReussie)
				echo "Attention : problème de connexion à la base de données.";
		
			$tabObjMenus = array();
			// Pour tous les menus du restaurant...
			foreach ($lesMenus as $menu) {
				// on récupère les attributs
				$requete = mysql_query("SELECT * FROM menu WHERE id = " . $menu, $idConnexion);
				if(!$requete)
					die("Requête invalide : " . mysql_error());
				else {
					if($row = mysql_fetch_array($requete)) {
						$unPrix = $row['prix'];
						$uneEntree = $row['entree'];
						$unPlat = $row['plat'];
						$unDessert = $row['dessert'];
						
						// On récupère le nom de l'entrée
						$requete1 = mysql_query("SELECT nomPlat FROM platrealisable, mesplats WHERE id = idPlatRealisable AND idPlatRealisable = " . $uneEntree, $idConnexion);
						if(!$requete1)
							die("Requête 1 invalide : " . mysql_error());
						else {
							if($row1 = mysql_fetch_array($requete1))
								$nomEntree = $row1['nomPlat'];
						}
						
						// On récupère le nom du plat principal
						$requete2 = mysql_query("SELECT nomPlat FROM platrealisable, mesplats WHERE id = idPlatRealisable AND idPlatRealisable = " . $unPlat, $idConnexion);
						if(!$requete2)
							die("Requête 2 invalide : " . mysql_error());
						else {
							if($row2 = mysql_fetch_array($requete2))
								$nomPlat = $row2['nomPlat'];
						}
						
						// On récupère le nom de dessert
						$requete3 = mysql_query("SELECT nomPlat FROM platrealisable, mesplats WHERE id = idPlatRealisable AND idPlatRealisable = " . $unDessert, $idConnexion);
						if(!$requete3)
							die("Requête 3 invalide : " . mysql_error());
						else {
							if($row3 = mysql_fetch_array($requete3))
								$nomDessert = $row3['nomPlat'];
						}
						
						// Création d'un tableau pour les id des ingrédients de chaque plat et d'un autre pour les quantités entrant en vigueur dans la recette du plat
						$ingredientsEntree = array();
						$quantitesEntree = array();
						// On récupère les ingrédients et les quantités
						$requeteA = mysql_query("SELECT idIngredient, quantiteIngredient FROM mesingredientplat MIP, ingredientplat IP WHERE MIP.idPlat = IP.idPlat AND MIP.idPlat = " . $uneEntree, $idConnexion);
						if(!$requeteA)
							die("Requête A invalide : " . mysql_error());
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
							die("Requête B invalide : " . mysql_error());
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
							die("Requête C invalide : " . mysql_error());
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
						
						// Libération des résultats des requêtes successives
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
				
				// Libération des résultats de la requête sur un menu
				mysql_free_result($requete);
			}
			return $tabObjMenus;
		}
	}
?>