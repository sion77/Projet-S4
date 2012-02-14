heritiana.ratsimisetra@u-psud.fr
<?php
	define ('HOST', 'localhost');
	define ('USER', 'root');
	define ('PASSWORD', '');
	define ('DB', 'restaugame');
	
	/* Connexion à la base de données
	* Auteur Julien
	*/
	function connexionDB() {
		$idConnexion = mysql_connect(HOST, USER, PASSWORD);
		if(!$idConnexion)
			echo "Attention : problème de connexion avec le serveur.";
		else {
			$connexionReussie = mysql_select_db(DB, $idConnexion);
			if(!$connexionReussie)
				echo "Attention : problème de connexion à la base de données.";
			return $idConnexion;
		}
	}
	
	/* Calcule la moyenne des notes des menus proposés par un restaurant
	* Auteur Julien
	*/
	function moyenneMenu($unResto) {
		$moy = 0;
		$cpt = 0;
		$idConnexion = connexionDB();
		$result = mysql_query("SELECT note FROM menu M, menuProp MP WHERE M.idMenu = MP.idMenu AND idResto = " . $unResto, $idConnexion);
		if(!$result)
			die("Requête invalide : " . mysql_error());
		else {
			while ($row = mysql_fetch_row()){
				$moy = $moy + $row[0];
				$cpt = $cpt + 1;
			}
			$moy = $moy / $cpt;
			return $moy;
		}
	}
	
	function qualitePrestation
	
	function coefPrestation($unResto) {
		$coefPrestation = 0;
		$cpt = 0;
		$idConnexion = connexionDB();
		$result = mysql_query("SELECT qualitePrestation FROM employe WHERE idRestaurant = " . $unResto, $idConnexion);
		if (!$result)
			die("Requête invalide : " . mysql_error());
		else {
			while ($row = mysql_fetch_row()){
				$coefPrestation = $coefPrestation + $row[0];
				$cpt = $cpt + 1;
			}
			$coefPrestation = $coefPrestation / $cpt;
			return $coefPrestation;
		}
	}