<?php

    $bdd = new PDO('mysql:host=localhost;dbname=un_espace_menbre','root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

    if(isset($_POST['submit'])){

        if(!empty($_POST['pseudo']) AND !empty($_POST['pass']) AND !empty($_POST['pass_c']) AND  !empty($_POST['email'])){
            $pseudo = $_POST['pseudo'];
            $pass = $_POST['pass'];
            $pass_c = $_POST['pass_c'];
            $email = $_POST['email'];


            $doublon = $bdd->prepare("SELECT * FROM menbres WHERE pseudo=:pseudo");//verification des doublons
            $doublon->execute(array(":pseudo" => $pseudo));
            $result = $doublon->rowCount();

            if($result == 0){//verifie si le pseudo existe
                if($pass == $pass_c){//verifie que le pwd est bien comfirmé
                    $pass_hacke = password_hash($pass, PASSWORD_DEFAULT);//hacké le pwd
                    $req= $bdd->prepare("INSERT INTO menbres(pseudo,pass,email,date_inscription) VALUES (:pseudo,:pass,:email,NOW())");
                    $req->execute(
                        array(
                            ":pseudo"=>$pseudo,
                            ":pass"=>$pass_hacke,
                            ":email"=>$email
                        )
                    );
                    echo"
                    <script>
                        alert('Inscription Réussi');
                        document.location.replace('../connexion/connexion.php');
                    </script>
                    ";
                }else{
                    echo"
                    <script>
                        alert('Le mot de passe n\'a pas été bien comfirmé');
                        document.location.replace('inscription.php');
                    </script>
                    ";
                }
            }
            else{
                echo"
                    <script>
                        alert('Ce pseudo est déja utilisé');
                        document.location.replace('inscription.php');
                    </script>
                ";
            }
        }
        else{
            echo"
            <script>
                alert('Remplissez tous les champs');
                document.location.replace('inscription.php');
            </script>
            ";
        }
    }

    $bdd = null;
?>