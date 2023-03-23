<?php
session_start();
if(!isset($_SESSION['id'])){
        header('Location: connexion.php');
}else {
    if($_SESSION['gerent']){
        header('Location: login.php');
    }
}
    if(isset($_POST["deconnect"])){
        session_unset();
        session_destroy();
        header("Location:connexion.php");
        exit;
    }

    ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <link href="Style.css" rel="stylesheet" />
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
               <img src="img/logo.png" alt="logo"width="15%" >
               <form action="accuiel.php" method='post'>
                    <input class='btn btn-outline-success' name='submit' type='submit' value="Accuiel">
                </form>  
               <form action="profile.php" method='post'>
                    <input class='btn btn-outline-success' name='deconnect' type='submit' value="Déconcter">
                </form> 
                    
        </div>
</nav>
    <?php

$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=mediatheque", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$adherent_id = $_SESSION['id'];
// Récupérer les informations de l'adhérent
$stmt = $conn->prepare("SELECT nom, prenom, score FROM adherent WHERE id_adherent = :id_adherent");
$stmt->bindParam(':id_adherent', $adherent_id);
$stmt->execute();
$adherent= $stmt->fetch(PDO::FETCH_ASSOC);

// Afficher les informations de l'adhérent
echo "<h2 class='text-center text-danger-emphasis'>mon profil</h2>";
echo "<p class='ms-4'>Nom :  ".$adherent['nom']."</p>";
echo "<p class='ms-4'>Prénom : ".$adherent['prenom']."</p>";
echo "<p class='ms-4'>Score : ".$adherent['score']."</p>";

// Récupérer les réservations de l'adhérent
$stmt = $conn->prepare("SELECT * FROM reservation INNER JOIN ouvrage on ouvrage.id_ouvrage = reservation.id_ouvrage WHERE id_adherent = :id_adherent");
$stmt->bindParam(':id_adherent', $adherent_id);
$stmt->execute();
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Afficher les réservations de l'adhérent
if (count($reservations) > 0) {
    foreach ($reservations as $reservation) {
        echo " <div class='max-w-sm bg-white cards border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700'>
        <a href='#'>
            <img class='rounded-t-lg' src=img/".$reservation["image"]." alt='' />
        </a>
        <div class='p-5'>
                <h5 class='mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white'>".$reservation["titre"]."</h5>
            <p class='mb-3 font-normal text-gray-700 dark:text-gray-400'>".$reservation["nom_auteur"]."</p>
       
    
            
        </div>
        </div>

        ";
    }
 
} else {
    echo "<p class='text-center text-danger-emphasis'> Vous n'avez pas encore de réservations.</p>";
}
?>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
               
