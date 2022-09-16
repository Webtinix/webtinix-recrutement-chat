<?php

    if(isset($_COOKIE['pseudo']) AND isset($_COOKIE['pass'])){

        $bdd = new PDO('mysql:host=localhost;dbname=un_espace_menbre','root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            $pseudo= $_COOKIE['pseudo'];
            $pass= $_COOKIE['pass'];

            $req = $bdd->prepare("SELECT id,pass FROM  menbres WHERE pseudo=:pseudo");//verifier si le pseudo existe
            $req->execute(array(":pseudo" => $pseudo));
            $resultat = $req->fetch();

            $verificationPass = password_verify($pass, $resultat['pass']);

            if(!$resultat){// $resultat est censé renvoyé vrai c'est pas le cas c'est un mauvais pseudo
                echo"
                    <script>
                        document.location.replace('connexion/connexion.php');
                    </script>
                ";
            }
            else{

                if($verificationPass){//si le mot de passe est vérifier on se connecte users et créer une session
                    session_start();
                    $_SESSION['id'] = $resultat['id'];
                    $_SESSION['pseudo'] = $pseudo;

                    echo"
                        <script>
                            document.location.replace('chat/chat.php');
                        </script>
                    ";
                }
                else{
                    echo"
                    <script>
                        document.location.replace('connexion/connexion.php');
                    </script>
                    ";
                }
            }

        $bdd= null;
    }
    elseif(isset($_GET['id_user']) && $_GET['id_user'] > 0){}
    else{
        echo"
        <script>
            document.location.replace('connexion/connexion.php');
        </script>
        ";
    }

