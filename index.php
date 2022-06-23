<?php
    class Route {

        private function simpleRoute($file, $route){
    
            
            //replacing first and last forward slashes
            //$_REQUEST['uri'] will be empty if req uri is /
    
            if(!empty($_REQUEST['uri'])){
                $route = preg_replace("/(^\/)|(\/$)/","",$route);
                $reqUri =  preg_replace("/(^\/)|(\/$)/","",$_REQUEST['uri']);
            }else{
                $reqUri = "/";
            }
    
            if($reqUri == $route){
                $params = [];
                include($file);
                exit();
    
            }
    
        }
    
        function add($route,$file){
    
            $params = [];
            $paramKey = [];
            preg_match_all("/(?<={).+?(?=})/", $route, $paramMatches);
            if(empty($paramMatches[0])){
                $this->simpleRoute($file,$route);
                return;
            }

            foreach($paramMatches[0] as $key){
                $paramKey[] = $key;
            }
    
            if(!empty($_REQUEST['uri'])){
                $route = preg_replace("/(^\/)|(\/$)/","",$route);
                $reqUri =  preg_replace("/(^\/)|(\/$)/","",$_REQUEST['uri']);
            }else{
                $reqUri = "/";
            }
    
            //exploding route address
            $uri = explode("/", $route);
            $indexNum = []; 
    
            foreach($uri as $index => $param){
                if(preg_match("/{.*}/", $param)){
                    $indexNum[] = $index;
                }
            }
    
            $reqUri = explode("/", $reqUri);
    
            foreach($indexNum as $key => $index){
    
                if(empty($reqUri[$index])){
                    return;
                }
                $params[$paramKey[$key]] = $reqUri[$index];
    
                $reqUri[$index] = "{.*}";
            }
    
            $reqUri = implode("/",$reqUri);
    
            $reqUri = str_replace("/", '\\/', $reqUri);
    
            if(preg_match("/$reqUri/", $route))
            {
                include($file);
                exit();
            }
        }
    
        function notFound($file){
            include($file);
            exit();
        }
        function Tester($file){
            include($file);
            echo"$file";
            exit();
        }
    }
    

//Route instance
$route = new Route();

//route address and home.php file location

$route->add("/ProjetApplication", "landing-page.php");

$route->add("login", "login-form.php");
$route->add("register", "register-form.php");
$route->add("profile", "myaccount.php");
$route->add("catalogue", "catalogue.php");
$route->add("profile-edit", "account-parameter.php");
$route->add("order", "payment.php");
$route->add("order/success","success.html");
$route->add("order/cancel","cancel.html");





//$route->notFound("404.php");

?>
