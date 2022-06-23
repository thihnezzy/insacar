<?php
   logged_only();
   if(isset($_SESSION["email"]))
   {
        $firstname = $_SESSION["name"];
        $lastname = $_SESSION["last name"];
    }
    
    function logged_only(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        if(!isset($_SESSION['email'])){
            header('Location: login-form-temp.php');
            exit();
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="https://www.insa-centrevaldeloire.fr/sites/default/files/favicon_0.ico" type="image/vnd.microsoft.icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://kit.fontawesome.com/33e40bbd30.js" crossorigin="anonymous"></script>
    <title>INSA Car</title>
</head>

<body onload="document.body.style.opacity='1'">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top " id="mainNavbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <h2 class="fw-bold">Logo</h2>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mob-navbar" aria-label="Toggle">
          <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse" id="mob-navbar">
                <ul class="navbar-nav mb-2 mb-lg-0 mx-auto ms-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Our Services</a
              >
              <ul class="dropdown-menu animate slideIn" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Buy a car</a></li>
                    <li><a class="dropdown-item" href="#">Reserve a car</a></li>
                    <li>
                        <a class="dropdown-item" href="#">Car renting</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="#">Explore More</a></li>
                </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modal">Contact Us</a>
                </li>
                </ul>
                <ul class="navbar-nav p-lg-0 ">
                    <li class="d-flex nav-item px-lg-2 py-md-2">
                            <a class="nav-link fs-5 fw-bold" type="submit"></a>
                    </li>
                    <li class="d-flex nav-item px-lg-2 py-md-2">
                            <a href="./account-parameter.php" class="nav-link parameters"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
  <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
  <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
</svg></a>
                    </li>
                </ul>


            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top " id="mainNavbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="./landing-page.php">
                <h2 class="logo-insa">INSA'CAR</h2>
            </a>ascasc
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mob-navbar" aria-label="Toggle">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mob-navbar">
                <ul class="navbar-nav mb-2 mb-lg-0 mx-auto ms-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Our Services</a>
                        <ul class="dropdown-menu animate slideIn" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Buy a car</a></li>
                            <li><a class="dropdown-item" href="#">Reserve a car</a></li>
                            <li>
                                <a class="dropdown-item" href="#">Car renting</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="#">Explore More</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#modal" data-bs-toggle="modal" data-bs-target="#modal">Contact Us</a>
                    </li>
                </ul>
                <ul class="navbar-nav p-lg-0 ">
                    <li class="d-flex nav-item px-lg-2 py-md-2">
                    <a class="nav-link fs-5 fw-bold" type="submit"><?php echo  "$firstname $lastname"; ?></a>
                    </li>
                    <li class="d-flex nav-item px-lg-2 py-md-2">
                    <a href="./account-parameter.php" class="nav-link parameters"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
  <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
  <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
</svg></a>
                    </li>
                </ul>


            </div>
        </div>
    </nav>
    <!-- BANNER -->
    <section class="main-container">
        <article class="index-intro">
            <div class="container ">
                <div class="jumbotron d-flex mx-0 my-0 justify-content-end align-items-center h-100">
                    <div class="container-fluid pb-0 ms-1 pt-5" id="banner-caption">
                        <blockquote class="col-md-12 fs-1 fw-bolder">WITH <span class="logo-insa">INSA'CAR</span> </blockquote>
                        <blockquote class="col-md-12 fs-1 fw-bolder">STOP DREAMING, JUST DRIVE!</blockquote>
                        <a href="#offer-gallery" id="see-our-offer" class="my-0">
                            <button class="btn btn-outline-info fw-bold text-white w-100 text-nowrap" type="button">SEE OUR OFFER</button>
                        </a>

                    </div>
                </div>


            </div>
        </article>
    </section>



    <!-- GALLERY SLIDER -->
    <section class="container-fluid">
        <div class="row">
            <h1 class="text-center text-white">OUR SERVICE</h1>
        </div>
        <div class="row align-items-center justify-content-center">

            <div class="col-lg-6 text-white text-center ms-5">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Maxime laudantium sint mollitia ipsam quisquam autem. Voluptatibus, molestiae fugit ipsum vero architecto, maxime repellat, ut corporis esse alias quos saepe odit. Nihil minima eligendi, earum
                quia deleniti harum sed sunt quidem fugiat inventore unde facere ab beatae consequuntur sit ea iste alias pariatur dolore nostrum natus. Eveniet quas enim hic ea. Ducimus numquam in deleniti doloremque, eum maiores pariatur quibusdam quasi
                voluptates debitis commodi unde corporis reprehenderit doloribus repellat vitae aperiam qui expedita velit provident exercitationem excepturi possimus explicabo sint. Doloribus? Mollitia quod fugiat ullam repellendus neque et veritatis
                consequuntes.
            </div>
            <div class="col-lg-6 text-center">
                <img src="./assets/car-model.jpg" alt="car model" class="img-fluid w-50 h-100">
            </div>
        </div>
    </section>

    <section class="main-container">
        <div class="col-lg-8 container text-center" id="offer-gallery">
            <div class="row mr-0 ml-0 justify-content-center">
                <!-- <div class="row mx-0 my-0 justify-content-center" id="slider-row"> -->
                <div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-img">
                                        <img src="./assets/berline-car.png" class="img-fluid" alt="berline car" />
                                    </div>
                                    <div class="card-img-more">
                                        <a href="./catalogue.php?type=suv" class="car-info-link">
                                            <button class="btn btn-outline-light fw-bold text-nowrap text-uppercase">Rent a sedan</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-img">
                                        <img src="./assets/cabriolet.png" class="img-fluid" alt="cabriolet car" />
                                    </div>
                                    <div class="card-img-more">
                                        <a href="./catalogue.php?type=cabriolet" class="car-info-link">
                                            <button class="btn btn-outline-light fw-bold text-nowrap text-uppercase">Rent a convertible</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-img">
                                        <img src="./assets/utilitaire-car.png" class="img-fluid" alt="utilitaire car" />
                                    </div>
                                    <div class="card-img-more">
                                        <a href="./catalogue.php?type=utilitaire" class="car-info-link">
                                            <button class="btn btn-outline-light fw-bold text-nowrap text-uppercase">Utility rental</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-img">
                                        <img src="./assets/car7+.png" class="img-fluid " alt="more than 7 seats car" />
                                    </div>
                                    <div class="card-img-more">
                                        <a href="./catalogue.php?type=7places" class="car-info-link">
                                            <button class="btn btn-outline-light fw-bold text-nowrap text-uppercase">Rent a 7-seater or +</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-img">
                                        <img src="./assets/luxe.png" class="img-fluid" alt="luxurious car" />
                                    </div>

                                    <div class="card-img-more">
                                        <a href="./catalogue.php?type=luxe" class="car-info-link">
                                            <button class="btn btn-outline-light fw-bold text-nowrap text-uppercase">Rent a luxury car</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-img">
                                        <img src="./assets/suv.png" class="img-fluid" alt="suv car" />
                                    </div>

                                    <div class="card-img-more">
                                        <a href="./catalogue.php?type=suv" class="car-info-link">
                                            <button class="btn btn-outline-light fw-bold text-nowrap text-uppercase fs-lg-4">Rent an suv</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-img">
                                        <img src="./assets/electric-car.png" class="img-fluid" alt="electric car" />
                                    </div>

                                    <div class="card-img-more">
                                        <a href="/catalogue.php?type=ve" class="car-info-link">
                                            <button class="btn btn-outline-light fw-bold text-nowrap text-uppercase">Rent an electric car</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev bg-transparent w-aut" href="#recipeCarousel" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </a>
                    <a class="carousel-control-next bg-transparent w-aut" href="#recipeCarousel" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!--TODO: FOOTER -->
    <div class="container my-5 p-0 m-0" id="wrap-footer">
        <footer style="background-color: #c7c7c7;">
            <div class="container p-4">
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-4">
                        <h5 class="mb-3 text-dark fw-bold">Footer content</h5>
                        <p>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iste atque ea quis molestias. Fugiat pariatur maxime quis culpa corporis vitae repudiandae aliquam voluptatem veniam, est atque cumque eum delectus sint!
                        </p>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <h5 class="mb-3 text-dark fw-bold">More info</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1">
                                <a href="#!" style="color: #4f4f4f;">FAQ</a>
                            </li>
                            <li class="mb-1">
                                <a href="#!" style="color: #4f4f4f;">Classes</a>
                            </li>
                            <li class="mb-1">
                                <a href="#!" style="color: #4f4f4f;">Pricing</a>
                            </li>
                            <li>
                                <a href="#!" style="color: #4f4f4f;">Safety</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <h5 class="mb-4 fw-bold">Our social network</h5>
                        <ul class="list-unstyled d-flex justify-content-around me-4">
                            <li class="ms-4">
                                <a class="link-dark" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
      </svg></a></li>
                            <li class="ms-4">
                                <a class="link-dark" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-meta" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8.217 5.243C9.145 3.988 10.171 3 11.483 3 13.96 3 16 6.153 16.001 9.907c0 2.29-.986 3.725-2.757 3.725-1.543 0-2.395-.866-3.924-3.424l-.667-1.123-.118-.197a54.944 54.944 0 0 0-.53-.877l-1.178 2.08c-1.673 2.925-2.615 3.541-3.923 3.541C1.086 13.632 0 12.217 0 9.973 0 6.388 1.995 3 4.598 3c.319 0 .625.039.924.122.31.086.611.22.913.407.577.359 1.154.915 1.782 1.714Zm1.516 2.224c-.252-.41-.494-.787-.727-1.133L9 6.326c.845-1.305 1.543-1.954 2.372-1.954 1.723 0 3.102 2.537 3.102 5.653 0 1.188-.39 1.877-1.195 1.877-.773 0-1.142-.51-2.61-2.87l-.937-1.565ZM4.846 4.756c.725.1 1.385.634 2.34 2.001A212.13 212.13 0 0 0 5.551 9.3c-1.357 2.126-1.826 2.603-2.581 2.603-.777 0-1.24-.682-1.24-1.9 0-2.602 1.298-5.264 2.846-5.264.091 0 .181.006.27.018Z"/>
          </svg></a>
                            </li>
                            <li class="ms-4">
                                <a class="link-dark" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
            <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
          </svg></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                © 2022 Copyright:
                <a class="text-dark" href="#">insacar.fr</a>
            </div>
            <!-- Copyright -->
        </footer>

    </div>

    <!-- CONTACT US SENDING MESSAGE -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="email-box-title">SEND US A MESSAGE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Here it goes the contact form -->
                <div class="modal-body">
                    <form action="https://formsubmit.co/c96f3a3cc25f6b9d9b00a392e9257551" method="POST" class="fw-bold">
                        <div class="form-group my1">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" placeholder="Enter name" required />
                        </div>
                        <div class="form-group my-2">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required />
                        </div>
                        <div class="form-group my-2">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" aria-describedby="emailHelp" placeholder="Enter subject" required />
                        </div>
                        <div class="form-group my-1">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                        </div>
                        <div class="mx-auto my-5">
                            <button type="submit" class="btn btn-secondary text-right" data-bs-dismiss="modal">
                            Close
                        </button>
                            <button type="submit" class="btn btn-primary text-right">
                                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                            Send
                        </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="./js/app.js"></script>
</body>

</html>