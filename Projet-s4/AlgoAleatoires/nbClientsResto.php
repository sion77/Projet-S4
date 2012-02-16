<?php

//Attribut le nombre de clients dans un restaurant
function nbClientsResto($leRestau)
{

//recupère le nombre de clients dans la base
$nbPauvre=('SELECT nbPauvre From nbClients');
//écrire fonction mysql
$nbMoyen=('SELECT nbMoyen FROM nbClients');
$nbRiche=('SELECT nbRiche FROM nbClients');
$nbPopTotal=$nbPauvre+$nbMoyen+$nbRiche;

//On recupère la note du resto dans la base
$noteResto=('SELECT note FROM monRestau WHERE idRestau='.$leRestau);

//On recupère le nombre total de note
$noteTotal=('SELECT SUM(note) From monRestau'); 

//On récupère le nombre aléatoire
$noteAleatoire=('SELECT aleatoire FROM monRestau WHERE idRestau='.$leRestau);

//On récupère le nombre total aleatoire
$nbTotalAleatoire=('SELECT SUM (aleatoire) From monRestau');

$riches = ((0.8*$noteResto)+(0.2*$noteAleatoire))/(($noteTotal*0.8)+($nbTotalAleatoire*0.2));
$moyens= ((0.5*$noteResto)+(0.5*$noteAleatoire))/(($noteTotal*0.5)+($nbTotalAleatoire*0.5));
$pauvres= ((0.3*$noteResto)+(0.7*$noteAleatoire))/(($noteTotal*0.3)+($nbTotalAleatoire*0.7));

//On récupère le nombre de clients par catégorie pour le restaurant
$clientRiche=$nbRiche*$riches;
$clientMoyen=$nbMoyen*$moyens;
$clientPauvre=$nbPauvre*$pauvres;

//Remplit la table
$requete=('INSERT INTO repartition(nbPauvre,nbRiche,nbMoyen) VALUES ('.$clientRiche.','.$clientMoyen.','.$clientPauvre.') WHERE id='.$leRestau);


}


?>

 
