<?php
session_start();
if(isset($_SESSION['id'])){
	if(!$_SESSION['gerent']){
        header('Location: accuiel.php');
    }else {
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

		if(isset($_POST['submit'])) {
			$username = $_POST["Username"];
            $password = $_POST["Password"];
        
            $connexion = $conn->prepare("SELECT * FROM gerant WHERE user_name= :username AND password = :password");
			$connexion->bindParam(':username', $_POST['Username']);

			$connexion->bindParam(':password', $_POST['Password']);
        
            $connexion->execute();
            $result = $connexion->fetch(PDO::FETCH_ASSOC);

			if ($connexion->execute()) {
				$result = $connexion->fetch(PDO::FETCH_ASSOC);
				if ($result) {
					// utilisateur connecté avec succès
					// rediriger vers la page d'accueil
					
					$_SESSION['id'] = $result['id_gerant'];
    				$_SESSION['gerent'] = true;
    				header("Location: accuiels.php");
    				exit();
				} else {
					// nom d'utilisateur ou mot de passe incorrect
					$error = "Nom d'utilisateur ou mot de passe incorrect";
				}
			} else {
				// erreur de connexion à la base de données
				$error = "Erreur de connexion à la base de données";
			}
		

        
           
        }

    	$sth = $conn->prepare("SELECT * FROM `gerant`");
        $sth->execute();
        $response = $sth->fetchAll();

       ?>




<!DOCTYPE html>
<html>
<head>
	<title>Médiathèque publique</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="media.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Login</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<form action="" method="POST" class="signin-form">
		      		<div class="form-group">
		      			<input type="text" name="Username" class="form-control" placeholder="Username" required>
		      		</div>
	            <div class="form-group">
	              <input id="password-field" name="Password" type="password" class="form-control" placeholder="Password" required>
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>
	            <div class="form-group">
    			<?php if (isset($error)) { ?>
        		<div class="alert alert-danger" role="alert">
            		<?php echo $error; ?>
        		</div>
    				<?php } ?>
				<input type="submit" name="submit" id='button' class="form-control btn btn-primary submit px-3" value="Sign In">
	            </div>
	            <div class="form-group d-md-flex">
	            	<div class="w-50">
		            	<label class="checkbox-wrap checkbox-primary text-white">Remember Me
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
									</label>
								</div>
								<div class="w-50 text-md-right">
									<a href="#" style="color: #fff">Forgot Password</a>
								</div>
	            </div>
	          </form>
		      </div>
				</div>
			</div>
		</div>
	</section>
   
            <!-- SCRIPTS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>