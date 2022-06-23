<?php
     session_start();
     require_once 'connexiondb.php'; // Fichier PHP contenant la connexion à votre BDD
     if (!function_exists('str_contains')) {
        function str_contains($haystack, $needle) {
            return $needle !== '' && mb_strpos($haystack, $needle) !== false;
        }
    }

    if (isset($_SESSION['email'])){
        header('Location: my-account.php');
        exit();
    }

    if(!empty($_POST))
    {
        $valid = true;

        if (isset($_POST['first-name'])){
            $prenom = valid_donnees($_POST['first-name']); // on récupère le prénom
        }
        if (isset($_POST['last-name'])){
            $nom = valid_donnees($_POST['last-name']); // On récupère le nom
        }
        if (isset($_POST['email'])){
            $mail = valid_donnees($_POST['email']); // On récupère le mail
        }
        if (isset($_POST['telephone-number'])){
            $phone = valid_donnees($_POST['telephone-number']); // On récupère le telephone
        }
        if (isset($_POST['address'])){
            $adresse = valid_donnees($_POST['address']); // On récupère l'adresse
        }
        if (isset($_POST['student-card-number'])){
            $num_etudiant = valid_donnees($_POST['student-card-number']); // On récupère le numéro de carte étudiant
        }
        if (isset($_POST['mdp'])){
            $mdp = valid_donnees($_POST['mdp']);
            $hash_mdp = password_hash($mdp,PASSWORD_DEFAULT);                            // On récupère le mot de passe
        }


        // Vérification du nom
        if(empty($nom)){
            $valid = false;
        }

        // Vérification du prenom
        if(empty($prenom)){
            $valid = false;
        }

        // Vérification du prenom
        if(empty($num_etudiant)){
            $valid = false;
        }
       

        // Vérification de l'email
        if(empty($mail)){
            $valid = false;
        }
        // Vérification du telephone
        if(empty($phone)){
            $valid = false;
        }
        // Vérification du mdp
        if(empty($mdp)){
            $valid = false;
        }



        // Vérif du format de l'email
        if(!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $mail)){
            $valid = false;
            $er_mail = "Le mail n'est pas valide";
        }
 
        // Verif mdp
        if(empty($mdp)) {
            $valid = false;
            $er_mdp = "Le mot de passe ne peut pas être vide";
        }

            // Si tout est bon on insere dans la BDD
            if($valid){
                
                $array = array($mail,$hash_mdp,$prenom,$nom,$num_etudiant,$adresse,$phone);

                    $single_quote = "'";
                    $double_quote = '"';
                    $XOR = 'XOR(';
                    for ($i = 0; $i < sizeof($array); $i++)
                        {
                            if ( str_contains($array[$i],$single_quote))
                            {
                                echo $array[$i]. '<br>';
                                $array[$i] = "";
                                echo 'item apres = '. $array[$i]. '<br>';
                            }
                        if ( str_contains($array[$i],$double_quote))
                            {
                                echo $array[$i]. '<br>';
                                $array[$i]= "";
                                echo 'item apres = '. $array[$i]. '<br>';
                            }
                        if ( str_contains($array[$i],$XOR))
                            {
                                echo $array[$i]. '<br>';
                                $array[$i] = "";
                                echo 'item apres = '. $array[$i]. '<br>';
                            }

                        }


                    $sql = ("INSERT INTO `users`(`login`, `password`, `name`, `last name`, `card number`, `address`, `phone`) VALUES ('$array[0]','$array[1]','$array[2]','$array[3]','$array[4]','$array[5]','$array[6]') ");
                    $st = $conn->prepare($sql);
                    $st->execute();

                
               
    
                header('Location: login-form-temp.php');
                exit;
            }

    }
        
    function valid_donnees($donnees){
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);
        return $donnees;
    }
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <link rel="shortcut icon" href="https://www.insa-centrevaldeloire.fr/sites/default/files/favicon_0.ico" type="image/vnd.microsoft.icon" />
    <title>Register</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap");
        @import url("https://fonts.googleapis.com/css2?family=Open+Sans&family=Vollkorn:ital,wght@0,600;1,500&display=swap");
         :root {
            --pure-white: #fff;
            --black: #171613;
            --light-black: #171613de;
            --light-grey: #c7c7c7;
            --grey: #949493;
            --hover-white: rgba(255, 255, 255, 0.099);
            --background-carousel: linear-gradient(#28313b, #8e9399);
            --carousel-bottom: #485461;
            --type-body: Open Sans, Helvetica, Arial, sans-serif;
        }

        body {
            font-family: var(--type-body);
            background-color: var(--light-black);
        }

    </style>
</head>

<body>
    <section class="container">
        <!-- TODO:Change href here -->
        <form action="" class="container py-5 h-100" method="POST">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card card-registration my-4">
                        <div class="row g-0">
                            <div class="col-xl-6 d-none d-xl-block">
                                <img src="./assets/poster-register.jpg" alt="car poster" class="img-fluid" style="position: relative; height: 100%; border: none;" />
                            </div>
                            <div class="col-xl-6">
                                <div class="card-body p-md-5 text-black fw-bold">
                                    <h3 class="mb-5 text-uppercase text-center fw-bold">insa car registration form</h3>

                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="first-name">First name *</label>
                                                <input type="text" id="first-name" name="first-name" class="form-control form-control-lg" required pattern="^[A-Za-z '-]+$" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="last-name">Last name *</label>
                                                <input type="text" id="last-name" name="last-name" class="form-control form-control-lg"  required pattern="^[A-Za-z '-]+$" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="address">Address</label>
                                        <input type="text" id="address" name="address" class="form-control form-control-lg" />

                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="student-number">Student card *</label>
                                        <input type="text" id="student-card-number" name="student-card-number" class="form-control form-control-lg" required />

                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="telephone-number">Telephone number *</label>
                                        <input type="text" id="telephone-number" name="telephone-number" class="form-control form-control-lg" required/>

                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="email">Email address *</label>
                                        <input type="email" id="email" name="email" class="form-control form-control-lg" required />

                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="password">Password *</label>
                                        <input type="password" id="mdp" name="mdp" class="form-control form-control-lg" required/>
                                        <p><?php if(isset($err_msg)){
                                            echo($err_msg);
                                            } 
                                            ?></p>
                                    </div>
                                    <div class="d-flex justify-content-end pt-3">
                                        <a href="./login-form-temp.php"><button type="button" class="btn btn-light btn-lg">Login</button></a>
                                        <button type="submit" class="btn btn-warning btn-lg ms-2">Register</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>

</html>

