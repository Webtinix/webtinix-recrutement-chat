<?php

    //Démarrage de la session
    session_start();
    $id_user = $_SESSION['id'];
    $pseudo = $_SESSION['pseudo'];

    //Connexion à la db
    $bdd = new PDO('mysql:host=localhost;dbname=un_espace_menbre','root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

    $liste = $bdd->query("SELECT id,pseudo FROM menbres");
    $liste = $liste->fetchAll();

?>

<!doctype html>
<html lang="fr">
  <head>
    <title>Chat</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../bootstrap.min.css">
    <link rel="stylesheet" href="style_chat.css">
  </head>
  <body>

  <!-- La partie de la liste -->

    <section class="UsersListe"> <!-- Case liste des utilisateurs-->
      <div class="users">
        <div><input type="text" placeholder="Autres utilisateurs"></div>
        <div class="liste">
          <?php
            foreach($liste as $row){

              if($row['id'] % 2 != 0){?><!-- Pour discutez avec une personne à la fois-->
                <h5><a href="#?id=<?= $row['id']?>&amp;pseudo=<?= $row['pseudo']?>&amp;"><?php echo $row['pseudo']; ?></a></h5>
          <?php
              }
              else{?>
                <h5 style="background-color: #112844;"><a href="#?id=<?= $row['id']?>&amp;pseudo=<?= $row['pseudo']?>&amp;"><?php echo $row['pseudo'];?></a></h5>
          <?php
              }
            }
          ?>
        </div>
        <div>
          <button type="button" class="btn btn-danger" onclick="deconnexion();">Déconnexion</button>
        </div>
      </div>
    </section>

    <!-- La partie de la messagerie -->

    <section class="main">
      <div class="messagerie">
        <div class="haut">
          <h1 style="font-weight: bold;">Chat</h1>
          <h3><?php echo $pseudo?></h3>
        </div>

        <div class="milieu">
          <div class="chat">
            <?php
                $sms= $bdd->prepare('SELECT id,pseudo,DATE_FORMAT(date_envoi, "%d/%m/%Y à %Hh%imin") As date_sms,le_message FROM lesMessages');
                $sms->execute();

                while($conversation = $sms->fetch()){?>

                <div class="conversation">
                  <h5><strong><?php echo $conversation['pseudo']; ?></strong></h5>
                  <p>
                    <?php echo $conversation['le_message']; ?>
                  </p>
                  <h6><?php echo $conversation['date_sms']?></h6>
                </div>

            <?php  
              }

              $sms->closeCursor();
            ?>
          </div>
        </div>

        <div class="bas">
          <form action="chatTraitement.php?id=<?= $id_user;?>&amp;pseudo=<?= $pseudo;?>&amp;" method="post">
            <input type="text" placeholder="Entrer un message" name="message">
            <button type="submit" class="btnEnvoi" name="envoi"></button>
          </form>
        </div>
      </div>
    </section>
    <script>

      function deconnexion (){
        document.location.replace('../connexion/connexion.php');
      }
    </script>
  </body>
</html>

<?php

  $bdd = null;

?>