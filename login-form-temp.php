
<?php
session_start();
require_once 'connexiondb.php'; // On inclut la connexion à la base de données

// Si on tente de s'identifier
if(!empty($_POST['username']) && !empty($_POST['password']))
{


    // On initialise $existence_ft
    $existence_ft = '';


    // Si le fichier existe, on le lit
    if(file_exists('./antibrute/'.$_POST['username'].'.tmp'))
    {
        
        // On ouvre le fichier
        $fichier_tentatives = fopen('./antibrute/'.$_POST['username'].'.tmp', 'r+');

        // On récupère son contenu dans la variable $infos_tentatives
        $contenu_tentatives = fgets($fichier_tentatives);

        // On découpe le contenu du fichier pour récupérer les informations
        $infos_tentatives = explode(';', $contenu_tentatives);


        // Si la date du fichier est celle d'aujourd'hui, on récupère le nombre de tentatives
        if($infos_tentatives[0] == date('d/m/Y'))
        {
            $tentatives = $infos_tentatives[1];
        }
        // Si la date du fichier est dépassée, on met le nombre de tentatives à 0 et $existence_ft à 2
        else
        {
            $existence_ft = 2;
            $tentatives = 0; // On met la variable $tentatives à 0
        }


    }
    // Si le fichier n'existe pas encore, on met la variable $existence_ft à 1 et on met les $tentatives à 0
    else
    {
        $existence_ft = 1;
        $tentatives = 0;
    }


    // S'il y a eu moins de 30 identifications ratées dans la journée, on laisse passer
    if($tentatives < 3)
    {

        $query = "SELECT * FROM users WHERE login=? limit 1";
        $stmt = $conn->prepare($query);
        $stmt->execute(array($_POST['username']));
        $data_verif = $stmt->fetch();
        
        // Si le pseudo existe bien
        if(!empty($data_verif['login']))
        {
        
           // Si le mot de passe est bon
           if(password_verify(trim($_POST['password']),$data_verif['password']))
           {
                setcookie("login",$data_verif["login"],time()+3600);
                $_SESSION['email'] = $data_verif["login"] ;
                $_SESSION['name'] = $data_verif['name'] ;
                $_SESSION['last name'] = $data_verif['last name'] ;
                $_SESSION['address'] = $data_verif['address'] ;
                $_SESSION['phone'] = $data_verif['phone'] ;
                $_SESSION['card number'] = $data_verif['card number'];
                header('Location: ./my-account.php');
           }
           // Si le mot de passe est faux
           else
           {
               
               // Si le fichier n'existe pas encore, on le créé
               if($existence_ft == 1)
               {
                   $creation_fichier = fopen('antibrute/'.$data_verif['login'].'.tmp', 'a+'); // On créé le fichier puis on l'ouvre
                   fputs($creation_fichier, date('d/m/Y').';1'); // On écrit à l'intérieur la date du jour et on met le nombre de tentatives à 1
                   fclose($creation_fichier); // On referme
               }
               // Si la date n'est plus a jour
               elseif($existence_ft == 2)
               {
                   fseek($fichier_tentatives, 0); // On remet le curseur au début du fichier
                   fputs($fichier_tentatives, date('d/m/Y').';1 '); // On met à jour le contenu du fichier (date du jour;1 tentatives)
               }
               else
               {

                   // Si la variable $tentatives est sur le point de passer à 30, on en informe l'administrateur du site
                   /*if($tentatives == 2)
                   {
                       $email_administrateur = 'hamza.jaait@insa-cvl.fr';
 
                       $sujet_notification = '[Site] Un compte membre a atteint son quota';
 
                       $message_notification = 'Un des comptes a atteint le quota de mauvais mots de passe journalier :';
                       $message_notification .= $data_verif['username'];
 
                       mail($email_administrateur, $sujet_notification, $message_notification);
                   }*/

                   fseek($fichier_tentatives, 11); // On place le curseur juste devant le nombre de tentatives
                   fputs($fichier_tentatives, $tentatives + 1); // On ajoute 1 au nombre de tentatives
               }


           $msg_err = 'Mot de passe incorrect' ;
           }

        }
        // Si le pseudo n'existe pas
        else
        {
            $msg_err = 'Pseudonyme incorrect';
        }


    }
    // S'il y a déjà eu 10 tentatives dans la journée, on affiche un message d'erreur
    else
    {
        $msg_err = 'Trop de tentatives d\'authentification aujourd\'hui';
    }


 
    // Si on a ouvert un fichier, on le referme (eh oui, il ne faut pas l'oublier)
    if($existence_ft != 1)
    {
    fclose($fichier_tentatives);
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
    <!-- MDB -->
    <title>Log In</title>
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
            border: none;
            padding: 0;
            margin: 0;
        }
        
        .background-image {
            background-image: url(./assets/car-model.jpg);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        
        @media(max-width: 991px) {
            .background-image {
                margin: 0;
                padding: 0;
                background-image: none;
                background-color: var(--pure-white);
            }
        }
    </style>
</head>

<body>
    <section class="pt-5">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100 ">
                <div class="col-xl-10 border-0 ">
                    <div class="card rounded-3 text-black ">
                        <div class="row g-0 ">
                            <div class="col-lg-6 ">
                                <div class="card-body p-md-5 mx-md-4 ">
                                    <div class="text-center ">
                                        <h4 class="mt-1 mb-5 pb-1 fw-bold">INSA CAR LOGIN</h4>
                                    </div>
                                    

                                    <form name = "fo"  action = "login-form-temp.php" class="fw-bold" method=POST>
                                        <p class="h5 pb-3 ">Please login to your account</p>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="username">Username</label>
                                            <input type="email" name = "username" id="username" class="form-control " placeholder="Email address" required="required"/>
                                        </div>

                                        <div class="form-outline mb-4 ">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" name = "password" id="password" class="form-control required="required"" />
                                            <br>
                                            <p id="err_msg" class="text-danger"><?php if(isset($msg_err)){ 
                                                echo($msg_err);}
                                                ?></p>
                                        </div>
                                        <div class="d-flex flex-column text-center pt-1 mb-5 pb-1 ">
                                            <button class="btn btn-warning btn-block fa-lg mb-3 " name = "submit" type="submit">
                                              Log in
                                            </button>
                                            <a class="text-muted" href="#!">Forgot password?</a>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4 ">
                                            <p class="mb-0 me-2 ">Don't have an account?</p>
                                            <a href="./register-form.html">
                                                <button type="button" class="btn btn-outline-danger fw-bold ">
                                                <a href="register-form.php">Create New</a> 
                                              </button>
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center border-0 background-image ">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4 ">
                                    <!-- TODO: add caption -->
                                    <!-- <h4 class="mb-4 ">We are more than just a company</h4>
                    <p class="small mb-0 ">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                      sed do eiusmod tempor incididunt ut labore et dolore magna
                      aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                      ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>


