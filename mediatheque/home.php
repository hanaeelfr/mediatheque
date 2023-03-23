<?php
session_start();
if(!isset($_SESSION['id'])){
    header('Location: login.php');
}else{
    if(!$_SESSION['gerent']){
        header('Location: accuiel.php');
    }
}

if(isset($_POST["deconnect"])){
    session_unset();
    session_destroy();
    header("Location:login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <link href="Style.css" rel="stylesheet" />
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
               <img src="img/logo.png" alt="logo"width="15%" >
                        <form action="accuiels.php" method='post'>
                        <input class='btn btn-outline-success' name='submit' type='submit' value="accuiel">
                        </form>
                        <form action="home.php" method='post'>
                    <input class='btn btn-outline-success' name='deconnect' type='submit' value="Déconcter">
                </form> 
            </div>

          
        </nav> 
        <h2 class="text-center text-danger-emphasis mb-5">les reservation</h2>



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

$sql = "SELECT * FROM reservation";
$stmt = $conn->prepare($sql);
$stmt->execute();
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo'<div>';
foreach ($reservations as $reservation) {
    ?>
    <form method = "POST" action = "" class=" row ">

            <div class=" col-md-2"> 
                <p class="" >Id-reservation : <span><?=$reservation['id_reservation']?></span></p>
            </div>

            <div class=" col-md-4"> 
                <p class="" >Date de Reservation : <span><?=$reservation['date_reservation']?></span></p>
            </div>

            <div class=" col-md-2"> 
                <p class="" >Id_adherent : <span><?=$reservation['id_adherent']?></span></p>
            </div>

            <div class=" col-md-2"> 
                <p class="" >Id_ouvrage : <span><?=$reservation['id_ouvrage']?></span></p>
            </div>

            <div class=" col-md-2"> 
                <button type="submit" class="btn btn-success btn">Accept</button>
            </div>

</form>
   <?php                     
}
echo '</div>';
?>
    
</body>
</html>