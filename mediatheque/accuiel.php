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
            // echo "Connected successfully";
        }
        catch(PDOException $e) 
        {
            echo "Connection failed: " . $e->getMessage();
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
               
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="titre" aria-label="Search">
                        <input class="form-control me-2" type="search" placeholder="type" aria-label="Search">
                        <button class="btn btn-outline-success me-2" type="submit">Search</button>
                        </form>
                        <form action="profile.php" method='post'>
                        <input class='btn btn-outline-success' name='submit' type='submit' value="Profil">
                    </form> 

                    
                
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
                       
                            <form action='detail.php' method='get'>
                                    <input type='hidden' name='id'  value=".$ligne["id_ouvrage"].">
                                    <input class='col-7 mt-auto align-right btn btn-outline-dark' name='submit' type='submit' value='plus de details'> 
                                    </form>
                            
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