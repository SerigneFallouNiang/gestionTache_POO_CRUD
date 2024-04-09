<?php
require_once "tache.class.php";

$host ="localhost";
$user="root";
$pass= "";
$db = "gestionTache";
try{
    $connexion = new PDO("mysql:host=$host;dbname=$db",$user,$pass);    
    $libelle="";
    $description="";
    $dateEcheange="";
    $id_priorite="";
    $id_etat="";
    $tache = new Tache($connexion,$libelle,$description,$dateEcheange,$id_priorite,$id_etat);
    echo 'true';
}catch(PDOException $erreur){
    die ("erreur :: connexion impossible" . $erreur->getMessage());
}
