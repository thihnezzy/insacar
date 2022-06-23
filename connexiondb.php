<?php
            $servername = 'localhost';
            $username = 'root';
            $password = '';

            //On établit la connexion
            $conn = new mysqli($servername, $username, $password);

            //On vérifie la connexion
            if($conn->connect_error){
                die('Erreur : ' .$conn->connect_error);
            }
            

            try{
                $conn = new PDO("mysql:host=$servername;dbname=insacar", $username, $password);
                //On définit le mode d'erreur de PDO sur Exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
            }

            /*On capture les exceptions si une exception est lancée et on affiche
             les informations relatives à celle-ci*/
            catch(PDOException $e){
              echo "Erreur : " . $e->getMessage();
            }
        ?>