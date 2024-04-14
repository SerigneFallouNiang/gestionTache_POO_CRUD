<?php
class Tache {
 private $connexion;
 private $libelle;
 private $description;
 private $dateEcheange;
 private $id_priorite;
 private $id_etat;
 private $id_user;
 public function __construct($connexion,$libelle,$description,$dateEcheange,$id_priorite, $id_etat,$id_user){
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
 public function readTache($id_user){
    try{
        $sql="SELECT *,Tache.id AS Tache ,Tache.id_user AS User FROM Tache 
        JOIN Etat ON Tache.id_etat=Etat.id  WHERE Tache.id_user = :id_user ORDER BY libelleE ASC";
      $stmt=$this->connexion->prepare($sql);
      $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
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

public function addTache($libelle,$description,$dateEcheange,$id_priorite,$id_etat,$id_user){
    try{
        $sql= "INSERT INTO Tache (libelle,description,dateEcheange,id_priorite,id_etat, id_user) VALUES (:libelle,:description,:dateEcheange,:id_priorite,:id_etat, :id_user)";
        $stmt=$this->connexion->prepare($sql);
        $stmt->bindParam(':libelle',$libelle);
        $stmt->bindParam(':description',$description);
        $stmt->bindParam(':dateEcheange',$dateEcheange);
        $stmt->bindParam(':id_priorite',$id_priorite,PDO::PARAM_INT);
        $stmt->bindParam(':id_etat',$id_etat,PDO::PARAM_INT);
        $stmt->bindParam(':id_user',$id_user,PDO::PARAM_INT);
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