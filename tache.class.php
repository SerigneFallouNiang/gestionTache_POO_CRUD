<?php
class Tache {
 private $connexion;
 private $libelle;
 private $description;
 private $dateEcheange;
 private $id_priorite;
 private $id_etat;
 public function __construct($connexion,$libelle,$description,$dateEcheange,$id_priorite, $id_etat){
    $this->connexion=$connexion;
    $this->libelle=$libelle;
    $this->description=$description;
    $this->dateEcheange=$dateEcheange;
    $this->id_priorite=$id_priorite;
    $this->id_etat=$id_etat;
 }
 public function getLibelle(){
    return $this->libelle;
 }
 public function getDescription(){
    return $this->description;
 }
 public function getDateEcheange(){
    return $this->dateEcheange;
 }
 public function getid_propriete(){
    return $this->id_priorite;
 }
 public function getid_etat(){
    return $this->id_etat;
 }
 public function readTache(){
    try{
        $sql="SELECT * FROM Tache JOIN Etat ON Tache.id_etat=Etat.id";
      $stmt=$this->connexion->prepare($sql);
      $stmt->execute();
      $results=$stmt->fetchall(PDO::FETCH_ASSOC);
      return $results;
    }catch (PDOException $erreur) {
        die("Erreur !: " . $erreur->getMessage() . "<br/>");
    }
 }
}