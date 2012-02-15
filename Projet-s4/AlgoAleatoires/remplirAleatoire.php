

<?php 

	function remplirAleatoire($idRestau)
	{
		//3 critères
		$aleatoire;
		$aleatoireJour;
		$bonusJourFerie;
		
		
		//Critère aleatoire : random compris entre 0 et 5
		$aleatoire = rand(0,5);
		
		//On recupère la date
		jourActuel($leJour,$leMois);
		
		
		
		//On vérifie si le jour est un week end
		//la Note sera plus élevé en Week end
		if(jourWeekEnd($leJour,$leMois))
		{
			//Rand compris entre 2 et 3
			$aleatoireJour= rand(2,3);
		}
		else {
			//Rand compris entre 0 et 2
			$aleatoireJour= rand(0,2);
			}
	
		//Puis on vérifie si le jour est un jour férié
		if(jourFerie($leJour,$leMois))	$bonusJourFerie=2;
		else $bonusJourFerie=0;
		
		$noteTotal=$aleatoire+$aleatoireJour+$bonusJourFerie;
		
		//Remplit le tableau
		$requete =mysql_query('INSERT INTO restaurant(aleatoire) WHERE idRestaurant='.$idRestau.'VALUES('.$noteTotal.')');
		$resultat = mysql_fetch_row($requete);
		
	}
		
		