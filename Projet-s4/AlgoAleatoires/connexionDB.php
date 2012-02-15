<?php
	
	try 
	{
		//$host = "localhost";
		// include(connexionBD.php);
		// Généralement la machine est localhost  
		// c'est-a-dire la machine sur laquelle le script est hébergé
		$user = "root";
		//$bdd = "maBase";
		$passwd = "mysql";
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$co = new PDO ('mysql:host=localhost;dbname=maBase', $user , $passwd, $pdo_options);
	}
	
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
?>