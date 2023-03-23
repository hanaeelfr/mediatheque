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

    try {
        $conn = new PDO("mysql:host=$servername;dbname=mediatheque", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    if(isset($_POST['submit'])) {
        $nom = $_POST['Nom'];
        $prenom = $_POST['Prenom'];
        $adresse = $_POST['Adresse'];
        $email = $_POST['Email'];
        $phone = $_POST['Tele']; 
        $cin = $_POST['CIN'];  
        $date = $_POST['Date'];  
        $user_name = $_POST['Username'];
        $password = $_POST['Password']; 
            
        $sql = "INSERT INTO `adherent`(`nom`, `prenom`, `adresse`, `email`, `telephone`, `CIN`, `date_de_naissance`, `type`, `user_name`, `password`) VALUES (:nom, :prenom, :adresse, :email, :telephone, :cin, :date_de_naissance, :type, :user_name, :password)";
        $Ajouter = $conn->prepare($sql);
        $Ajouter->bindParam(':nom', $nom);
        $Ajouter->bindParam(':prenom', $prenom);
        $Ajouter->bindParam(':adresse', $adresse);
        $Ajouter->bindParam(':email', $email);
        $Ajouter->bindParam(':telephone', $phone);
        $Ajouter->bindParam(':cin', $cin);
        $Ajouter->bindParam(':date_de_naissance', $date);
        $Ajouter->bindValue(':type', ''); // Valeur à définir
        $Ajouter->bindParam(':user_name', $user_name);
        $Ajouter->bindParam(':password', $password);
        $Ajouter->execute();
    }
    
    $sth = $conn->prepare("SELECT * FROM `adherent`");
    $sth->execute();
    $response = $sth->fetchAll();
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Style.css">
    <title>l'inscription</title>
</head>
<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
               <img src="img/logo.png" alt="logo"width="15%" > 
            </div>
            <form action="accuiels.php" method='post'>
              <input class='btn btn-outline-dark' name='submit' type='submit' value="retoure a la page d'accuiel">
            </form> 
        </nav>
        <section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Création des compts</h3>
           
            <form action="inscription.php" method="POST">

              <div class="row">
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input type="text" id="firstName" name="Nom" class="form-control form-control-lg" />
                    <label class="form-label" for="firstName">Nom</label>
                  </div>

                </div>
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input type="text" id="lastName" name="Prenom" class="form-control form-control-lg" />
                    <label class="form-label" for="lastName">Prenom</label>
                  </div>

                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-4 d-flex align-items-center">

                  <div class="form-outline datepicker w-100">
                    <input type="text" name="Adresse" class="form-control form-control-lg" id="birthdayDate" />
                    <label for="birthdayDate" class="form-label">Adresse</label>
                  </div>
                  
 
                </div>
                <div class="col-md-6 mb-4 pb-2">

                  <div class="form-outline">
                    <input type="email" id="emailAddress" name="Email" class="form-control form-control-lg" />
                    <label class="form-label" for="emailAddress">Email</label>
                  </div>

                </div>

                <div class="col-md-6 mb-4 pb-2">

                  <div class="form-outline">
                    <input type="tel" id="phoneNumber" name="Tele" class="form-control form-control-lg" pattern="[0]{1}[5-8]{1}[0-9]{8}">
                    <label class="form-label" for="phoneNumber">Téléphone</label>
                  </div>

                </div>

                <div class="col-md-6 mb-4 d-flex align-items-center">

                  <div class="form-outline datepicker w-100">
                    <input type="text" name="CIN" class="form-control form-control-lg" id="birthdayDate" />
                    <label for="birthdayDate" class="form-label">CIN</label>
                  </div>
                  
 
                </div>
                <div class="col-md-6 mb-4 d-flex align-items-center">

                  <div class="form-outline datepicker w-100">
                    <input type="date" name="Date" class="form-control form-control-lg" id="birthdayDate" />
                    <label for="birthdayDate" class="form-label">Date de naissance</label>
                  </div>
                  
 
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4 d-flex align-items-center">

                    <div class="form-outline datepicker w-100">
                        <input type="text" name="Username" class="form-control form-control-lg" id="birthdayDate" />
                        <label for="birthdayDate" class="form-label">nom d'utilisateur</label>
                    </div>
                    
    
                    </div>
                    <div class="col-md-6 mb-4 d-flex align-items-center">

                    <div class="form-outline datepicker w-100">
                        <input type="password" name="Password" class="form-control form-control-lg" id="birthdayDate" />
                        <label for="birthdayDate" class="form-label">mot de passe</label>
                    </div>
                    
    
                    </div>
                </div> 

                
                <div class="row">
                <div class="col-md-6 mb-4 d-flex align-items-center">

                  <select class="select form-control-lg">
                    <option value="">Choose option</option>
                    <option value="etudient"> Etudient</option>
                    <option value="fonctionnaires">fonctionnaires</option>
                    <option value="femmes au foyer">femmes au foyer</option>
                  </select>

                </div>
              </div>

              <div class="mt-4 pt-2">
              <input class="col-7 mt-auto align-right btn btn-outline-dark" id='button' name="submit" type="submit" value="Submit"> 

              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


 <!-- Bootstrap core JS-->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
</body>
</html>