<?php

//retourne le nombre de clients dans un restaurant et prend en paramètre l'ID d'un restaurant
// et remplit la table repartition qui contient le nombre de riche, moyen riche et pauvre pour le restaurant en paramètre


{

//recupère le nombre de clients dans la base
$nbPauvre=mysql_query('SELECT nbPauvre From nbClients');
$nbMoyen=mysql_query('SELECT nbMoyen FROM nbClients');
$nbRiche=mysql_query('SELECT nbRiche FROM nbClients');

$nbPauvreResu=mysql_fetch_row($nbPauvre);
$nbMoyenResu=mysql_fetch_row($nbMoyen);
$nbRicheResu=mysql_fetch_row($nbRiche);

$nbPopTotal=$nbPauvreResu[0]+$nbMoyenResu[0]+$nbRicheResu[0];

//On recupère la note du resto dans la base
$noteResto=mysql_query('SELECT note FROM monRestau WHERE idRestau='.$leRestau);
$noteRestoResu=mysql_fetch_row($noteResto);

//On recupère le nombre total de note
$noteTotal=mysql_query('SELECT SUM(note) from restaurant');
$noteTotalResu=mysql_fetch_row($noteTotal);

//On récupère la note aléatoire
$noteAleatoire=mysql_query('SELECT aleatoire FROM restaurant WHERE idRestau='.$leRestau);
$noteAleatoireResu=mysql_fetch_row($noteAleatoire);

//On récupère le nombre total aleatoire
$nbTotalAleatoire=mysql_query('SELECT SUM (aleatoire) From restaurant');
$nbTotalAleatoireResu=mysql_fetch_row($nbTotalAleatoire);

$riches = ((0.8*$noteRestoResu[0])+(0.2*$noteAleatoireResu[0]))/(($noteTotalResu[0]*0.8)+($nbTotalAleatoireResu[0]*0.2));
$moyens= ((0.5*$noteRestoResu[0])+(0.5*$noteAleatoireResu[0]))/(($noteTotalResu[0]*0.5)+($nbTotalAleatoireResu[0]*0.5));
$pauvres= ((0.3*$noteRestoResu[0])+(0.7*$noteAleatoireResu[0]))/(($noteTotalResu[0]*0.3)+($nbTotalAleatoireResu[0]*0.7));

//On récupère le nombre de clients par catégorie pour le restaurant et on le tronque
$clientRiche=round($nbRicheResu[0]*$riches);
$clientMoyen=round($nbMoyenResu[0]*$moyens);
$clientPauvre=round($nbPauvreResu[0]*$pauvres);

//Remplit la table
$requete=mysql_query('INSERT INTO repartition(nbPauvres,nbRiches,nbMoyens) VALUES ('.$clientRiche.','.$clientMoyen.','.$clientPauvre.') WHERE idRestaurant='.$leRestau) 
or die("Impossible d'insérer des lignes dans la base de données!");

}
?>