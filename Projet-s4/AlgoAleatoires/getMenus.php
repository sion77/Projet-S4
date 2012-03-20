<?php
	include("_Plat.php");
	include("_Menu.php");
	
	function getMenus($idResto) {
		unPrix = 0;
		objEntree = null;
		objPlat = null;
		objDessert = null;
		
		$lesMenus = tousLesMenusDUnResto();

		// Etapes de connexion avec vérifications
		$idConnexion = mysql_connect('localhost', 'root', '');
		if(!$idConnexion)
			echo "Attention : problème de connexion avec le serveur.";
		else {
			$connexionReussie = mysql_select_db('restaugame', $idConnexion);
			if(!$connexionReussie)
				echo "Attention : problème de connexion à la base de données.";
		
			$tabObjMenus = array();
			foreach ($lesMenus as $menu) {
				$requete = mysql_query("SELECT * FROM menu WHERE id = " . $menu, $idConnexion);
				if(!$requete)
					die("Requête invalide : " . mysql_error());
				else {
					if($row = mysql_fetch_array($requete) {
						$unPrix = $row['prix'];
						$uneEntree = $row['entree'];
						$unPlat = $row['plat'];
						$unDessert = $row['dessert'];
						
						$requete1 = mysql_query("SELECT nom FROM platrealisable, mesplats WHERE id = idPlatRealisable AND idPlatRealisable = " . $uneEntree, $idConnexion);
						if(!$requete1)
							die("Requête invalide : " . mysql_error());
						else {
							if($row1 = mysql_fetch_array($requete1))
								$nomEntree = $row1['nom'];
						}
						$requete2 = mysql_query("SELECT nom FROM platrealisable, mesplats WHERE id = idPlatRealisable AND idPlatRealisable = " . $unPlat, $idConnexion);
						if(!$requete2)
							die("Requête invalide : " . mysql_error());
						else {
							if($row2 = mysql_fetch_array($requete2))
								$nomPlat = $row2['nom'];
						}
						$requete3 = mysql_query("SELECT nom FROM platrealisable, mesplats WHERE id = idPlatRealisable AND idPlatRealisable = " . $unDessert, $idConnexion);
						if(!$requete3)
							die("Requête invalide : " . mysql_error());
						else {
							if($row3 = mysql_fetch_array($requete3))
								$nomDessert = $row3['nom'];
						}
						
						$ingredientsEntree = array();
						$quantitesEntree = array();
						$requeteA = mysql_query("SELECT idIngredient, quantiteIngredient FROM mesingredientplat MIP, ingredientplat IP WHERE MIP.idPlat = IP.idPlat AND idPlat = " . $uneEntree, $idConnexion);
						if(!$requeteA)
							die("Requête invalide : " . mysql_error());
						else {
							while($rowA = mysql_fetch_array()) {
								$ingredientsEntree[] = $rowA['idIngredient'];
								$quantitesEntree[] = $rowA['quantiteIngredient'];
							}
						}
						$ingredientsPlat = array();
						$quantitesPlat = array();
						$requeteB = mysql_query("SELECT idIngredient, quantiteIngredient FROM mesingredientplat MIP, ingredientplat IP WHERE MIP.idPlat = IP.idPlat AND idPlat = " . $unPlat, $idConnexion);
						if(!$requeteB)
							die("Requête invalide : " . mysql_error());
						else {
							while($rowB = mysql_fetch_array()) {
								$ingredientsPlat[] = $rowB['idIngredient'];
								$quantitesPlat[] = $rowB['quantiteIngredient'];
							}
						}
						$ingredientsDessert = array();
						$quantitesDessert = array();
						$requeteC = mysql_query("SELECT idIngredient, quantiteIngredient FROM mesingredientplat MIP, ingredientplat IP WHERE MIP.idPlat = IP.idPlat AND idPlat = " . $unDessert, $idConnexion);
						if(!$requeteC)
							die("Requête invalide : " . mysql_error());
						else {
							while($rowC = mysql_fetch_array()) {
								$ingredientsDessert[] = $rowC['idIngredient'];
								$quantitesDessert[] = $rowC['quantiteIngredient'];
							}
						}
						
						$objEntree = new Plat($uneEntree, $nomEntree, $ingredientsEntree, $quantitesEntree);
						$objPlat = new Plat($unPlat, $nomPlat, $ingredientsPlat, $quantitePlat);
						$objDessert = new Plat($unDessert, $nomDessert, $ingredientsDessert, $quantitesDessert);
						
						mysql_free_result($requete1);
						mysql_free_result($requete2);
						mysql_free_result($requete3);
						mysql_free_result($requeteA);
						mysql_free_result($requeteB);
						mysql_free_result($requeteC);
					}
					
					$tabObjMenus[] = new Menu($menu, $unPrix, $objEntree, $objPlat, $objDessert);
				}
				mysql_free_result($requete);
			}
			return tabObjMenus[];
		}
	}
?>