<?php


    if(isset($_POST['envoi'])){

        $id_user = (int) $_GET['id'];
        $pseudo = $_GET['pseudo'];

        if(!empty($_POST['message'])){

            $le_message= $_POST['message'];

            $bdd = new PDO('mysql:host=localhost;dbname=un_espace_menbre','root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            $req= $bdd->prepare("INSERT INTO lesmessages(pseudo,date_envoi,le_message,id_user) VALUES (:pseudo,NOW(),:le_message,:id_user)");
            $req->execute(
                array(
                    ":pseudo"=>$pseudo,
                    ":le_message"=>$le_message,
                    ":id_user"=>$id_user
                )
            );

            session_start();
            $_SESSION['id'] = $id_user;
            $_SESSION['pseudo'] = $pseudo;
            echo"
                <script>
                    document.location.replace('chat.php');
                </script>
            ";
        }
        else{

            session_start();
            $_SESSION['id'] = $id_user;
            $_SESSION['pseudo'] = $pseudo;
            echo"
                <script>
                    document.location.replace('chat.php');
                </script>
            ";
        }
    }
?>