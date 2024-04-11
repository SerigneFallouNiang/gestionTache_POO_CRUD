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
        $sql="SELECT *,Tache.id AS Tache FROM Tache JOIN Etat ON Tache.id_etat=Etat.id";
      $stmt=$this->connexion->prepare($sql);
      $stmt->execute();
      $results=$stmt->fetchall(PDO::FETCH_ASSOC);
      return $results;
    }catch (PDOException $erreur) {
        die("Erreur !: " . $erreur->getMessage() . "<br/>");
    }
 }
public function deleteTache($id){
    try{
        $sql="DELETE FROM Tache WHERE id= :id ";
        $stmt=$this->connexion->prepare($sql);
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->execute();
        header("location: accueil.php");
        exit();
    } catch (PDOException $erreur) {
        die("Erreur lors de la suppression !: " . $erreur->getMessage() . "<br/>");
    }
}

public function addTache($libelle,$description,$dateEcheange,$id_priorite,$id_etat){
    try{
        $sql= "INSERT INTO Tache (libelle,description,dateEcheange,id_priorite,id_etat) VALUES (:libelle,:description,:dateEcheange,:id_priorite,:id_etat)";
        $stmt=$this->connexion->prepare($sql);
        $stmt->bindParam(':libelle',$libelle);
        $stmt->bindParam(':description',$description);
        $stmt->bindParam(':dateEcheange',$dateEcheange);
        $stmt->bindParam(':id_priorite',$id_priorite,PDO::PARAM_INT);
        $stmt->bindParam(':id_etat',$id_etat,PDO::PARAM_INT);
        $stmt->execute();
        header("location: accueil.php");
        exit();
    }catch (PDOException $erreur) {
        die("Erreur !: " . $erreur->getMessage() . "<br/>");
    }
}
public function update($id,$libelle,$description,$dateEcheange,$id_priorite,$id_etat){
try{
    $sql="UPDATE  Tache SET libelle = :libelle , description=:description, dateEcheange=:dateEcheange,id_priorite=:id_priorite , id_etat=:id_etat WHERE id = :id ";
    $stmt=$this->connexion->prepare($sql);
    $stmt->bindParam(':id',$id,PDO::PARAM_INT);
    $stmt->bindParam(':libelle',$libelle);
    $stmt->bindParam(':description',$description);
    $stmt->bindParam(':dateEcheange',$dateEcheange);
    $stmt->bindParam(':id_priorite',$id_priorite,PDO::PARAM_INT);
    $stmt->bindParam(':id_etat',$id_etat,PDO::PARAM_INT);
    $stmt->execute();
    header("location:accueil.php");
    exit();
}catch(PDOException $erreur){
die("Erreur Update !: " . $erreur->getMessage() . "<br/>");
}
    }
}