<?php

	//Attribue le nombre de clients dans tous les restaurants
	function repartitionClientsResto()
	{
		//On recupère le nombre de restaurant
		$nbRestau=nbTotalResto();

		for($i=0; $i<$nbRestau; $i++)
		{
			nbClientsResto($i);
		}


	}

?>
