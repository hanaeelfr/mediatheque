<?php
session_start();
if(!isset($_SESSION['id'])){
    header('Location: login.php');
}else{
    if(!$_SESSION['gerent']){
        header('Location: accuiel.php');
    }
}
    $servername = "localhost";
    $username = "root";
    $password = "";

    try
        {
            $conn = new PDO("mysql:host=$servername;dbname=mediatheque", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
        }
        catch(PDOException $e) 
        {
            echo "Connection failed: " . $e->getMessage();
        }


        if(isset($_POST['submit']))
        {
        $Titre = $_POST["Titre"];
        $auteur = $_POST["auteur"];
        $ImgName = $_FILES['Img']['name'];
        $Etat = $_POST["etat"];
        $Type = $_POST["type"];
        $Dateedition = $_POST["Date"];
        $Dateachat = $_POST["date_achat"];
        $Nombrepages = $_POST["nombre_pages"];
       


    $Ajouter = $conn->prepare("INSERT INTO `ouvrage`( `titre`, `nom_auteur`, `image`, `etat`, `type`, `date_edition`, `date_achat`, `nombre_pages`) VALUES('$Titre', '$auteur', '$ImgName', '$Etat', '$Type','$Dateedition', '$Dateachat', '$Nombrepages')");

    
    // echo $Titre;

    $Ajouter->execute();
        }



        if(isset($_POST['Modifier']))
        {
            $ID = $_POST["id"];
            $Titre = $_POST["ModifierTitre"];
            $auteur = $_POST["Modifierauteur"];
            $ImgName = $_FILES['ModifierImg']['name'];
            $Etat = $_POST["Modifieretat"];
            $Type = $_POST["Modifiertype"];
            $Dateedition = $_POST["Modifierdate"];
            $Dateachat = $_POST['Modifierdateach'];
            $Nombrepages = $_POST["Modifiernombre_pages"];

            move_uploaded_file($_FILES['ModifierImg']['tmp_name'], "./".$ImgName);

            $Modifier = $conn->prepare("UPDATE `ouvrage` SET titre = '$Titre', nom_auteur = '$auteur', image = '$ImgName', etat = '$Etat', type = '$Type', date_edition = '$Dateedition', date_achat = '$Dateachat',nombre_pages=$Nombrepages WHERE id_ouvrage = '$ID'");

            $Modifier->execute();
        }



        if(isset($_POST['Supprimer']))
        {
            $ID = $_POST["id"];

            $Supprimer = $conn->prepare("DELETE FROM `ouvrage` WHERE id_ouvrage = '$ID'");
            $Supprimer->execute();
        }

		

    	$sth = $conn->prepare("SELECT * FROM `ouvrage`");
        $sth->execute();
        $ouvrage = $sth->fetchAll();

       ?>








<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>page d'accueil</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <link href="Style.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
               <img src="img/logo.png" alt="logo"width="15%" >
               
                        <form action="inscription.php" method='post'>
                        <input class='btn' name='submit' type='submit' value="inscrire">
                        </form> 
                        <form action="home.php" method='post'>
                        <input class='btn' name='submit' type='submit' value="profil">
                        </form> 

                    
                
            </div>

            <div class="btn-cont">
<button type="button" id="Ajouter" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
  +Ajouter des ouvrages
</button>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title fs-5" id="exampleModalLabel">Ajouter neuvelle ouvrage</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="Titre">Titre</label><br>
            <input name="Titre" id="Titre" type="text">
        </div>

        <div class="mb-3">                    
            <label for="auteur">Nom de l'auteur</label><br>
            <input name="auteur" id="auteur" type="text">
        </div>

        <div class="mb-3">
            <label for="Image">Ajoutez une photo</label><br>
            <input name="Img" id="Image" type="file">                
        </div>
        
        

        <div class="mb-3">
            <label for="etat">Etat</label><br>
            <input name="etat" id="Etat" type="text">
        </div>
        
        <div class="mb-3">
            <label for="type">Type de l'ouvrage</label><br>
            <input name="type" id="type" type="text">                
        </div>
        
        <div class="mb-3">
            <label for="Date">Date_edition</label><br>
            <input name="Date" id="date" type="date">
        </div>
        
        <div class="mb-3">
            <label for="date_achat">date_achat</label><br>
            <input name="date_achat" id="datea" type="date">
        </div>

        <div class="mb-3">
            <label for="nombre_pages">nombre_pages</label><br>
            <input name="nombre_pages" id="nombre" type="number">
        </div>
        
      </div>
      <div class="modal-footer" >
        <button type="button" id="modal-ajouter" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit"  class="btn btn-primary" name="submit" value="Ajouter">
        
    </form>
      </div>
    </div>
  </div>
</div>

   

          
        </nav>
        <!-- Header-->
        <header >
            <div class="container px-4 px-lg-5 my-5">
                <img src="img/mediatheque-1.jpg" alt="background"id="background" >
                <style>
                    #background{
                        width: 100%;
                        height: 400px;
                    }
                </style>
                
            </div>
        </header>
        <!-- Section-->
        <section>
        <div class='cardes'>

            <?php
                foreach($ouvrage as $ligne){
                    echo "
                    
                    <div class='max-w-sm bg-white cards border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700'>
                        <a href='#'>
                            <img class='rounded-t-lg' src=img/".$ligne["image"]." alt='' />
                        </a>
                        <div class='p-5'>
                                <h5 class='mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white'>".$ligne["titre"]."</h5>
                            <p class='mb-3 font-normal text-gray-700 dark:text-gray-400'>".$ligne["nom_auteur"]."</p>
                    
                                    <button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target=#".$ligne["id_ouvrage"].">
                                    Modifier
                                  </button>
                                  
                                  
                                  <div class='modal fade' id=".$ligne["id_ouvrage"]." tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                      <div class='modal-content'>
                                        <div class='modal-header'>
                                          <h2 class='modal-title fs-5' id='exampleModalLabel'>Modification l'ouvrage</h2>
                                          <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                        </div>
                                        <div class='modal-body'>
                                  
                                           <form action='' method='POST' enctype='multipart/form-data'>
                                  
                                          <label for='Titre'>Titre</label>
                                          <input name='ModifierTitre' id='Titre' type='text' value=".$ligne["titre"]." >
                                          
                                          <label for='auteur'>Nom de l'auteur</label>
                                          <input name='Modifierauteur' id='auteur' type='text' value=".$ligne["nom_auteur"].">

                                          <label for='Image'>Ajoutez une photo</label>
                                          <input name='ModifierImg' id='Image' type='file' value=".$ligne["image"].">
                                          
                                          <label for='etat'>Etat</label>
                                          <input name='Modifieretat' id='etat' type='text' value=".$ligne["etat"].">
                                  
                 
                                          <label for='type'>Type de l'ouvrage</label>
                                          <input name='Modifiertype' id='type' type='text' value=".$ligne["type"].">
                                  
                                          <label for='Date'>Date_edition</label>
                                          <input name='Modifierdate' id='date' type='date' value=".$ligne["date_edition"].">
                                  
                                          <label for='date_achat'>Date_achat</label>
                                          <input name='Modifierdateach' id='datea' type='date' value=".$ligne["date_achat"].">

                                          <label for='nombre_pages'>nombre_pages</label>
                                          <input name='Modifiernombre_pages' id='nombre' type='number' value=".$ligne["nombre_pages"].">
                                        
                                          <label for='id'>ID</label>
                                          <input type='number' name='id' id='ID'  value=".$ligne["id_ouvrage"].">
                                  
                                          
                                          
                                        </div>
                                        <div class='modal-footer'>
                                          <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                          <input type='submit'class='btn btn-primary'name='Modifier' class='btn btn-secondary' value='Modifier'>
                                  
                                          
                                      </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  
                                  
                                  <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#Supprimer".$ligne["id_ouvrage"]."'>
                                    Supprimer
                                  </button>
                                  
                                  
                                  <div class='modal fade' id='Supprimer".$ligne["id_ouvrage"]."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                      <div class='modal-content'>
                                        <div class='modal-header'>
                                          <h2 class='modal-title fs-5' id='exampleModalLabel'>Suppression d'annonce</h2>
                                          <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                        </div>
                                        <div class='modal-body'>
                                  
                                            <form action='' method='POST' enctype='multipart/form-data'>
                                  
                                  
                                          <label for='ID'>Etes-vous sur de vouloir supprimer l'ouvrage ?</label>
                                          <input type='number' name='id' id='ID'  value=".$ligne["id_ouvrage"].">
                                  
                                          
                                          
                                        </div>
                                        <div class='modal-footer'>
                                          <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                          <input class='btn btn-danger' type='submit' name='Supprimer' value='Supprimer'>
                                  
                                          
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                                      </div>


                        </div>
                        

                        ";

                   
                }

             ?>
                                     </div>

<input type="hidden" name="">
        </section>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>