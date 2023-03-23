<?php
session_start();
if(!isset($_SESSION['id'])){
    header('Location: login.php');
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
    //    echo "Connected successfully";
    }
    catch(PDOException $e) 
    {
        echo "Connection failed: " . $e->getMessage();
    }


    

    session_start();
    
if (isset($_POST['submit'])){
    // ------------test1
    $adherent_id = $_SESSION['id'];
    $id_ouvrage = $_POST['id_ouvrage'];
    $sqlres = "SELECT * FROM ouvrage WHERE id_ouvrage = '$id_ouvrage'";
    $stmt = $conn->prepare($sqlres);
    $stmt->execute();
    $ouvrage = $stmt->fetch(PDO::FETCH_ASSOC);

if ($ouvrage['etat'] == 'déchiré') {
    header('Location: detail.php?id=' . $id_ouvrage . '&response=déchiré');
    exit();
}
    // ------------test2
    // Vérifier si l'adhérent a des pénalités
    $stmt = $conn->prepare("SELECT score FROM adherent WHERE id_adherent = :id_adherent");
    $stmt->bindParam(':id_adherent', $adherent_id);
    $stmt->execute();
    $adherent = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($adherent['score'] > 0) {
        // L'adhérent a des pénalités, afficher un message d'erreur
        header("Location: detail.php?id=$id_ouvrage&error=score");
        exit();
    }
    
    // ------------test3
    $date_res = "SELECT COUNT(*) AS count FROM `reservation` WHERE id_adherent = :id_adr AND TIMESTAMPDIFF(hour,date_reservation,CURRENT_TIMESTAMP) < 24 AND id_reservation NOT IN (SELECT id_reservation FROM emprunt);";
    $stmt = $conn->prepare($date_res);
    $stmt->bindValue(':id_adr', $adherent_id);
    $stmt->execute();
    $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
    $reservation = $fetch["count"];

    // ------------test5ID_adhérent
   $sql_borrowing ="SELECT COUNT(*) AS counte FROM `emprunt` JOIN `reservation` r ON r.id_reservation = emprunt.id_reservation WHERE r.id_adherent = :id_adr AND date_retour IS NULL " ;
   $stmt = $conn->prepare($sql_borrowing);
   $stmt->bindValue(':id_adr', $adherent_id);
   $stmt->execute();
   $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
   $emprunt = $fetch["counte"];

    if($emprunt + $reservation >=3){
        if ($pénalité >= 3){
            header('Location: detail.php?id=' . $id_ouvrage . '&response=reserve');
            exit();
        }
    }

    $sqlres= "INSERT INTO `reservation`( `id_adherent`, `id_ouvrage`) VALUES (:id_adr, :idouv)";
    $stmt = $conn->prepare($sqlres);
    $stmt->bindValue(':id_adr', $adherent_id);
    $stmt->bindValue(':idouv', $id_ouvrage);
    $stmt->execute();
    header("Location: detail.php?id=$id_ouvrage&response=ok");
    exit();
};
?>
