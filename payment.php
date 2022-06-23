<?php
require_once 'connexiondb.php';
logged_only();
if (!function_exists('str_contains')) {
    function str_contains($haystack, $needle) {
        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
    }
}
$single_quote = "'";
$double_quote = '"';
$XOR = 'XOR(';
$c1 = '<';
$c2 = '>' ;
$c3 = '/';
if (isset($_GET['car']))
{
    if ( str_contains($_GET['car'],$single_quote) || str_contains($_GET['car'],$double_quote) || str_contains($_GET['car'],$XOR) || str_contains($_GET['car'],$c1) || str_contains($_GET['car'],$c2) || str_contains($_GET['car'],$c3) )
        {
            $car_name = "";
        }
    else
    {
        $car_name = $_GET['car'];
    }

    $query = "SELECT * FROM car WHERE model = ? limit 1" ;
    $stmt = $conn->prepare($query);
    $stmt->execute(array($car_name));
    $data = $stmt->fetch();
    
    $ppd = $data['price'];
    $marque = $data['brand']; 
    $model = $data['model'];
    $year = $data['year'];
    $kilometrage = "5000 Km";
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
<html lang="fr"> 
        <head> 
                <title>INSA CAR - Payment</title>
                <?php require("header.html") ?>
                <link  rel="stylesheet" href="css/style_inner_payment.css">
                <script  src="https://js.stripe.com/v3/"></script>
                <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
                <link rel="shortcut icon" href="https://www.insa-centrevaldeloire.fr/sites/default/files/favicon_0.ico" type="image/vnd.microsoft.icon" />
                <script type="text/javascript">
                function daydiff()
                {
                    var t1=document.getElementById('retrieve').value;
                    t1=t1.split('-');
                    dt_t1=new Date(t1[0],t1[1],t1[2]);
                    dt_t1_tm=dt_t1.getTime();
                    var t2=document.getElementById('return').value;
                    t2=t2.split('-');
                    dt_t2=new Date(t2[0],t2[1],t2[2]);
                    dt_t2_tm=dt_t2.getTime();
                    var one_day = 24*60*60*1000;
                    var result = (dt_t2_tm-dt_t1_tm)/one_day;
                    var text=result.toString();
                    document.getElementById("dd").value = text;
                    return result;
                }
                function button_activate()
                {
                    var b = document.getElementById('checkout-button');
                    b.disabled=false;
                }
                function button_desactivate()
                {
                    var dis = document.getElementById('display');
                    dis.disabled=true
                    var b = document.getElementById('checkout-button');
                    b.disabled=true;
                }
                function price_calculator(daydifference)
                {
                    //alert(daydifference);
                    var ppd = <?php echo $ppd; ?>;
                    var price = Math.ceil(daydifference*ppd);
                    var dis = document.getElementById('display');
                    if(isNaN(price))
                    {
                        dis.innerHTML= "At least one date has not been specified OR you did not access this page through the catalogue.";
                    }
                    else if(daydifference<=0)
                    {
                        dis.innerHTML= "The return date shall not take place before your retrieve date. Also please, do not select the same date on both fields.";
                    }
                    else{
                        dis.innerHTML= price+"€" ;
                        dis.style.display = 'inline';
                        dis.disable=false;
                        button_activate();
                        return price;
                    }
                }
                </script>
        </head> 
        <body> 
        <div class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-md sticky-to navbar-light bg-light pt-1">
        <a class="navbar-brand" href="home" data-target="index:not(.show)" data-toggle="collapse" data-parent="#page-content">Home</a>
        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="catalogue" data-target="#page2:not(.show)" data-toggle="collapse">Catalogue</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login" data-target="#page3:not(.show)" data-toggle="collapse">Account</a>
                </li>
            </ul>
        </div>
    </nav>
    <main id="page-content" class="container-fluid py-3 overflowauto">
        <div class="position-">
            <div id="home" class="collapse show" data-parent="#page-content">
                <div class="row h-100">
                    <aside class="col-md-3">
                        <div class="mt-4 mb-3 pt-4 sticky-top" id="sidemenu">
                            <div class="pt-1">
                                <ul class="nav nav-pills flex-md-column flex-row justify-content-between bg-light">
                                    <li class="nav-item"><a href="#info" class="nav-link active">Information</a></li>
                                    <li class="nav-item"><a href="#rent" class="nav-link">Rent/Price</a></li>
                                    <li class="nav-item"><a href="#payment" class="nav-link">Payment</a></li>
                                </ul>
                            </div>
                        </div>
                    </aside>
                    <main class="col py-5">
                        <div class="row">
                            <div class="col">
                                <ul class="nav nav-tabs small" role="tablist">
                                    <li class="nav-item"><a class="nav-link text-uppercase active" data-toggle="tab" href="#tab1" role="tab">Selected Car</a></li>
                                </ul>
                                <div class="tab-content py-3">
                                    <div class="tab-pane active" id="tab1" role="tabpanel">
                                        <p class="lead text-center mb-3">INSACAR - CAR RENT</p>
                                        <div class="anchor" id="info"></div>
                                        <h4>Information</h4>
                                                <div class="col-md-4">
                                                <p>Equipements et options : ABS, Antipatinage (ASR), Airbags frontaux + latéraux, Projecteurs Xénon ou bi-Xénon, Contrôle de stabilité (ESP), Régulateur de vitesse, Allumage automatique des feux, Rétroviseurs électriques, Suspension sport, Direction assistée, Banquette AR 1/3 - 2/3, Vitres électriques, Volant multifonctions, Siégés sport cuir, Climatisation automatique multizones, Fermeture centralisée, Vitres teintées. </p>
                                                </div>  

                                                <div class="col-md-4" id="ads">
                                                <div class="card rounded">
                                                <div class="card-image">
                                                        <span class="card-notify-badge">Low KMS</span>
                                                        <span class="card-notify-year"><?php if(!empty($year)){echo($year);} ?></span>
                                                        <img class="img-fluid" src= '<?php echo ('./assets/cars_total/'.$car_name.'.png'); ?>' alt="Alternate Text" />
                                                        
                                                </div>
                                                <div class="card-image-overlay m-auto">
                                                        <span class="card-detail-badge"><?php if(!empty($price))
                                                        {echo($price);} ?></span>
                                                        <span class="card-detail-badge"><?php if(!empty($model)){echo($model);} ?></span>
                                                        <span class="card-detail-badge"><?php if(!empty($kilometrage)){echo($kilometrage);} ?></span>
                                                </div>
                                                <div class="card-body text-center">
                                                        <div class="ad-title m-auto">
                                                        <h5><?php if(!empty($marque)){echo($marque);} ?></h5>
                                                        </div>
                                                </div>
                                                </div>
                                        </div>
                                        <div class="anchor" id="rent"></div>
                                        <h4>Rent/Price</h4>
                                        <br/>
                                        <label for="retrieve">Retrieve date:</label>

                                            <input type="date" id="retrieve"  name="take" onclick="button_desactivate()" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>"/>

                                        <label for="return">Return date:</label>

                                            <input type="date" id="return"  name="give" onclick="button_desactivate()" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>"/>
                                        <br/>
                                        <hr>
                                        <div class="anchor" id="payment"></div>
                                        <h4>Payment</h4>
                                        <br/>
                                        <br/>
                                        <p><a class="btn btn-primary btn-lg" id="btn" role="button" onclick="price_calculator(daydiff())">GET THE PRICE</a></p>
                                        <br>
                                        <p>Total : <div id="display" disabled></div>
                                        <br/><br/>
                                            <form action="./checkout.php" method="POST">
                                                <input type="hidden" name="price" value="<?php echo $ppd; ?>">
                                                <input type="hidden" id="dd" name="daydifference" value="">
                                                <button type="submit" id="checkout-button" disabled>Checkout</button>
                                            </form>
                                        <hr>
                                    </div>
                        </main>
        <?php require("footer.html") ?>
</div>
        </body> 
</html> 