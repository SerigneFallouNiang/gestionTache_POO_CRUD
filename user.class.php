<?php
class User {
    private $connexion;
    private $nom;
    private $prenom;
    private $email;
    private $password;
    public function __construct($connexion,$nom,$prenom,$email,$password){
            $this->connexion=$connexion;
            $this->nom=$nom;
            $this->prenom=$prenom;
            $this->email=$email;
            $this->password=$password;
    }
    public function addUser($nom,$prenom,$email,$password){
        try{
            $sql="INSERT INTO User (nom,prenom,email,password) VALUES (:nom , :prenom , :email , :password)";
            $stmt=$this->connexion->prepare($sql);
            $stmt->bindParam(':nom',$nom);
            $stmt->bindParam(':prenom',$prenom);
            $stmt->bindParam(':email',$email);
            $stmt->bindParam(':password',$password);
            $stmt->execute();
            header("location:accueil.php");
            exit();
        }catch(PDOException $erreur){
            die("Erreur d'inscription" .$erreur->getMessage());
        }
    }
}