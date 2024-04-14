<?php
require_once "tache.class.php";
require_once "user.class.php";

$host ="localhost";
$user="root";
$pass= "";
$db = "gestionTache";
try{
    $connexion = new PDO("mysql:host=$host;dbname=$db",$user,$pass);  
    // $tache = new Tache($connexion);  
     $libelle="";
    $description="";
    $dateEcheange='';
    $id_priorite="";
    $id_etat="";
    $id_user="";
    $tache = new Tache ($connexion,$libelle,$description,$dateEcheange,$id_priorite,$id_etat,$id_user);

    //instanciation des User
    $nom="";
    $prenom="";
    $email="";
    $password="";
    $user= new User ($connexion,$nom,$prenom,$email,$password);




}catch(PDOException $erreur){
    die ("erreur :: connexion impossible" . $erreur->getMessage());
}
