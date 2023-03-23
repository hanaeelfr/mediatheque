<?php
session_start();
if(!isset($_SESSION['id'])){
    header('Location: connexion.php');
}else{
    if($_SESSION['gerent']){
        header('Location: accuiels.php');
    }
}
    $servername = "localhost";
    $username = "root";
    $password = "";

    try
        {
            $conn = new PDO("mysql:host=$servername;dbname=mediatheque", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
        }
        catch(PDOException $e) 
        {
            echo "Connection failed: " . $e->getMessage();
        }

		
        $id = $_GET['id'];
        $sth = $conn->prepare("SELECT * FROM `ouvrage` WHERE id_ouvrage=:id");
        $sth->bindParam(':id', $id);
        $sth->execute();
        $ouvrage = $sth->fetch();
       ?>

 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <link href="Style.css" rel="stylesheet" />
    <title>detail</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
    <img src="img/logo.png" alt="logo"width="15%" > 
    </div>
</nav>

<div class="d-flex justify-content-center mt-5 ">
    <div class="ms-3">
        <img  src='img/<?php echo $ouvrage['image']; ?>' style='width:100%'>
    </div>
    <div>
    <h1><?php echo $ouvrage['titre']; ?></h1>
    <h5><?php echo $ouvrage['nom_auteur']; ?></h5>
    <p><?php echo $ouvrage['etat']; ?></p>
    <p>Typpe : <?php echo $ouvrage['type']; ?></p>
    <p>date d'edition : <?php echo $ouvrage['date_edition']; ?></p>
    <p>date d'achat : <?php echo $ouvrage['date_achat']; ?></p>
    <p>nombre de pages : <?php echo $ouvrage['nombre_pages']; ?></p>
    <div class="d-flex" >
        <form action='accuiel.php' method='post'>
        <button class='btn btn-outline-dark me-2'>Retour a la page d'accueil</button>
        </form>
        <form  action='reservation.php' method='post'>
<input type="hidden" name="id_ouvrage" value="<?php echo $ouvrage['id_ouvrage']; ?>">
        <input class='btn btn-outline-success' name='submit' type='submit' value="Réserver">
    </form>

        
        
    </div>
    </div>
</div>
                

             
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>