<?php

    $bdd = new PDO('mysql:host=localhost;dbname=un_espace_menbre','root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

    if(isset($_POST['submit'])){

        if(!empty($_POST['pseudo']) AND !empty($_POST['pass'])){
            $pseudo= $_POST['pseudo'];
            $pass= $_POST['pass'];

            $req = $bdd->prepare("SELECT id,pass FROM  menbres WHERE pseudo=:pseudo");//verifier si le pseudo existe
            $req->execute(array(":pseudo" => $pseudo));
            $resultat = $req->fetch();

            $verificationPass = password_verify($pass, $resultat['pass']);

            if(!$resultat){// $resultat est censé renvoyé vrai c'est pas le cas c'est un mauvais pseudo
                echo"
                    <script>
                        alert('Pseudo ou mot de passe incorrect');
                        document.location.replace('connexion.php');
                    </script>
                ";
            }
            else{
                if($verificationPass){//si le mot de passe est vérifier on se connecte users et créer une session
                    session_start();
                    $_SESSION['id'] = $resultat['id'];
                    $_SESSION['pseudo'] = $pseudo;
                    if(isset($_POST['connectAuto'])){// au cas ou le checkbox est coché on crée des cookies pour les info du users
                        setcookie('pseudo',$pseudo,time()+2*24*3600,null,null,false,true);
                        setcookie('pass',$pass['pass'],time()+2*24*3600,null,null,false,true);
                        //après on se connecte
                        echo"
                            <script>
                                alert('Vous êtes connecté');
                                document.location.replace('../chat/chat.php');
                            </script>
                        ";
                    }
                    else{
                        echo"
                            <script>
                                alert('Vous êtes connecté');
                                document.location.replace('../chat/chat.php');
                            </script>
                        ";
                    }
                }
                else{
                    echo"
                    <script>
                        alert('Pseudo ou mot de passe incorrect');
                        document.location.replace('connexion.php');
                    </script>
                ";
                }
            }
        }//Au cas ou les champs sont vident
        else{
            echo"
            <script>
                alert('Saissisez vos informations');
                document.location.replace('connexion.php');
            </script>
                ";
        }
        $bdd= null;
    }

?>