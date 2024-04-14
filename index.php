<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "config.php";
  extract($_POST);
    
    try {
        // Préparez votre requête SQL pour récupérer l'utilisateur en fonction de l'email et du mot de passe
        $sql = "SELECT * FROM User WHERE email = :email AND password = :password";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            // Si l'utilisateur est trouvé, récupérez son identifiant et stockez-le dans la session
            $_SESSION["email"] = $email;
            $_SESSION["password"] = $password;
            $_SESSION["nom"] = $result["nom"]; 
            $_SESSION["prenom"] = $result["prenom"]; 
            $_SESSION["id"] = $result["id"];
            header("Location: accueil.php");
            exit;
            
        } else {
            // Si l'utilisateur n'est pas trouvé, affichez un message d'erreur ou redirigez vers une page d'erreur
            echo "Identifiants incorrects. Veuillez réessayer.";
        }
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
<style>
    @import url('https://fonts.googleapis.com/css?family=Noto+Sans:400,400i,700,700i&subset=greek-ext');

body{
	background-image: url("https://images.pexels.com/photos/891252/pexels-photo-891252.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260");
	background-position: center;
    background-origin: content-box;
    background-repeat: no-repeat;
    background-size: cover;
	min-height:100vh;
	font-family: 'Noto Sans', sans-serif;
}
.text-center{
	color:#fff;	
	text-transform:uppercase;
    font-size: 23px;
    margin: -50px 0 80px 0;
    display: block;
    text-align: center;
}
.box{
	position:absolute;
	left:50%;
	top:50%;
	transform: translate(-50%,-50%);
    background-color: rgba(0, 0, 0, 0.89);
	border-radius:3px;
	padding:70px 100px;
}
.input-container{
	position:relative;
	margin-bottom:25px;
}
.input-container label{
	position:absolute;
	top:0px;
	left:0px;
	font-size:16px;
	color:#fff;	
    pointer-event:none;
	transition: all 0.5s ease-in-out;
}
.input-container input{ 
  border:0;
  border-bottom:1px solid #555;  
  background:transparent;
  width:100%;
  padding:8px 0 5px 0;
  font-size:16px;
  color:#fff;
}
.input-container input:focus{ 
 border:none;	
 outline:none;
 border-bottom:1px solid #e74c3c;	
}
.btn{
	color:#fff;
	background-color:#e74c3c;
	outline: none;
    border: 0;
    color: #fff;
	padding:10px 20px;
	text-transform:uppercase;
	margin-top:50px;
	border-radius:2px;
	cursor:pointer;
	position:relative;
}
.input-container input:focus ~ label,
.input-container input:valid ~ label{
	top:-12px;
	font-size:12px;
	
}

</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<div class="box">
    <form action="" method="post">
        <span class="text-center">login</span>
    <div class="input-container">
        <input type="email" name="email" required=""/>
        <label>Email :</label>        
    </div>
    <div class="input-container">        
        <input type="password"  name="password" required=""/>
        <label>Password :</label>
    </div>
        <!-- <button type="button" ></button> -->
        <input type="submit" name="submit" class="btn" value="submit">
    </form>  
	<a style="color: #fff;" href="addUser.php">s'inscrire</a>  
</div>
</body>
</html>
